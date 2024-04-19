<?php

namespace App\Http\Controllers\Api;

use App\Models\booking;
use App\Models\rider;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\RidersResource;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $riders = usuario::with('rider')->where('user_type_id', 2)->get();
            $response = RidersResource::collection($riders);
        } catch (\Throwable $th) {
           $response = response()->json(['error' => 'Error al mostrar los usuarios: ' . $th->getMessage()], 500);
        }
        return $response;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        DB::beginTransaction();
        try {
            $usuario = new usuario();
            $usuario->user_name=$request->user_name;
            $pwd =bcrypt($request->password);
            $usuario->pswd=$pwd;
            $usuario->dni_cif=$request->dni_cif;
            $usuario->real_name=$request->real_name;
            $usuario->isActive=1;
            $usuario->imgProfile=$request->imgProfile;
            // falta gestionar que coja el file , ya se hara, de momento coge un varchar

            $usuario->user_type_id=2;

            $usuario->save();
            $rider = new rider();


            $rider->id_rider = $usuario->id_user;
            $rider->surname1 = $request->surname1;
            $rider->surname2 = $request->surname2;
            $rider->mail = $request->mail;
            $rider->phone_number = $request->phone;


            $rider->save();
            DB::commit();
            $response = response()
            ->json(['Rider creado'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json(['error' => 'Error al crear el rider: ' . $th->getMessage()], 500);
        }



        return $response;


    }

    /**
     * Display the specified resource.
     */
    public function show(rider $rider)
    {
        try {
            $rider = usuario::with('rider')->find($rider->id_rider);
            return  new RidersResource($rider);

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al mostrar el usuario: ' . $th->getMessage()], 500);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rider $rider)
    {
        DB::beginTransaction();
        try {
            $usuario = usuario::find($rider->id_rider);
            $usuario->user_name=$request->user_name;

            $usuario->dni_cif=$request->dni_cif;
            $usuario->real_name=$request->real_name;

            $usuario->imgProfile=$request->imgProfile;
            // falta gestionar que coja el file , ya se hara, de momento coge un varchar



            $usuario->save();




            $rider->surname1 = $request->surname1;
            $rider->surname2 = $request->surname2;
            $rider->mail = $request->mail;
            $rider->phone_number = $request->phone;


            $rider->save();
            DB::commit();
            $response = response()
            ->json(['updateado'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();

            $response= response()->json(['error' => 'Error al updatear el rider: ' . $th->getMessage()], 500);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rider $rider)
    {
        DB::beginTransaction();
        try {
            $usuario = usuario::find($rider->id_rider);

            $rider->delete();
            $usuario->delete();
            DB::commit();
            return response()->json(['Usuario eliminado'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Error al eliminar el usuario: ' . $th->getMessage()], 500);
        }
    }




    public function deliverysByRider($rider){
        try {

            $currentMonth = date('m');
            $currentYear = date('Y');


            $bookingsCount = Booking::where('id_rider_fk', $rider)
                ->whereYear('curr_Date', $currentYear)
                ->whereMonth('curr_Date', $currentMonth)
                ->where('id_status_fk', '3')
                ->count();

            $response = response()->json( $bookingsCount, 200);
        } catch (\Throwable $th) {
            $response = response()->json(['error' => 'Error al mostrar los bookings: ' . $th->getMessage()], 500);
        }

        return $response;
    }




    public function consecutiveDeliveries($rider){
        try {
            $bookings = Booking::where('id_rider_fk', $rider)
                ->where('id_status_fk', '3')
                ->orderBy('curr_Date', 'asc')
                ->pluck('curr_Date')
                ->toArray();

            $consecutiveDays = 0;
            $count = count($bookings);

            $bookingmonths = array_map(function ($booking) {
                return date('m', strtotime($booking));
            }, $bookings);

           $bookingdays = array_map(function ($booking) {
                return date('d', strtotime($booking));
            }, $bookings);

            for ($i = 0; $i < $count - 1; $i++) {
                $current = $bookingdays[$i];
                $next = $bookingdays[$i + 1];

                if ($next - $current == 1) {
                    $consecutiveDays++;
                }
            }



            $response = response()->json($consecutiveDays, 200);
        } catch (\Throwable $th) {
            $response = response()->json(['error' => 'Error al mostrar los bookings: ' . $th->getMessage()], 500);
        }

        return $response;
    }


    public function deliverysxMonth($rider)
    {
        try {
            $bookingsByMonth = [];


            for ($month = 1; $month <= 12; $month++) {

                $bookingsCount = Booking::where('id_rider_fk', $rider)
                ->whereRaw('MONTH(curr_Date) = ?', [$month])
                                                  ->count();

                // Agregar el resultado al array
                $bookingsByMonth[] = $bookingsCount;
            }

            $response = response()->json($bookingsByMonth, 200);
        } catch (\Throwable $th) {
            $response = response()->json(['error' => 'Error al mostrar los bookings: ' . $th->getMessage()], 500);
        }

        return $response;
    }

    public function calculateMonthlyChangeR($rider)
    {
        try {

            $currentYear = date('Y');
            $currentMonth = date('m');


            $previousMonth = $currentMonth - 1;
            $previousYear = $currentYear;
            if ($previousMonth == 0) {
                $previousMonth = 12;
                $previousYear--;
            }


            $currentMonthCount = booking::where('id_rider_fk', $rider)
                                      ->whereRaw('MONTH(curr_date) = ?', [$currentMonth])
                                      ->whereRaw('YEAR(curr_date) = ?', [$currentYear])
                                      ->count();


            $previousMonthCount = booking::where('id_rider_fk', $rider)
                                       ->whereRaw('MONTH(curr_date) = ?', [$previousMonth])
                                       ->whereRaw('YEAR(curr_date) = ?', [$previousYear])
                                       ->count();


            if ($previousMonthCount == 0) {
                if ($currentMonthCount == 0) {
                    $changePercentage = 0;
                } else {
                    $changePercentage = 100;
                }
            } else {
                $changePercentage = (($currentMonthCount - $previousMonthCount) / $previousMonthCount) * 100;
            }

            $response = response()->json($changePercentage, 200);
        } catch (\Throwable $th) {
            $response = response()->json(['error' => 'Error calculating monthly change: ' . $th->getMessage()], 500);
        }

        return $response;
    }


}
