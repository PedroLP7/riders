<?php

namespace App\Http\Controllers\Api;

use App\Models\booking;
use App\Models\delivery;
use App\Models\usuario;
use App\Models\provider;
use App\Models\charity_menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;


class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $providers= usuario::with('provider')->where('user_type_id', 3)->get();
            $response = ProviderResource::collection($providers);
        } catch (\Throwable $th) {
           $response = response()->json(['error' => 'Error al mostrar los usuarios: ' . $th->getMessage()], 500);
        }
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

            $usuario->user_type_id=3;

            $usuario->save();
           $provider = new provider();


            $provider->id_provider = $usuario->id_user;
            $provider->adress = $request->adress;


            $provider->save();
            DB::commit();
            $response = response()
            ->json(['Provider creado'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json(['error' => 'Error al crear el rider: ' . $th->getMessage()], 500);
        }



        return $response;

    }

    /**
     * Display the specified resource.
     */
    public function show(provider $provider)
    {
        try {
            $provider = Usuario::with(['provider.menus' => function ($query) {
                $query->where('isActive', '1');
            }])->find($provider->id_provider);

            return  new ProviderResource($provider);

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al mostrar el usuario: ' . $th->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, provider $provider)
    {
        DB::beginTransaction();
        try {
            $usuario = usuario::find($provider->id_provider);
            $usuario->user_name=$request->user_name;

            $usuario->dni_cif=$request->dni_cif;
            $usuario->real_name=$request->real_name;





            $usuario->save();




            $provider->adress = $request->adress;



            $provider->save();
            DB::commit();
            $response = response()
            ->json(['updateado'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();

            $response= response()->json(['error' => 'Error al updatear el provider: ' . $th->getMessage()], 500);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(provider $provider)
    {
        DB::beginTransaction();
        try {
            $usuario = usuario::find($provider->id_provider);

            $provider->delete();
            $usuario->delete();
            DB::commit();
            return response()->json(['Usuario eliminado'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Error al eliminar el usuario: ' . $th->getMessage()], 500);
        }
    }
    public function updateQuantity($quantity, $providerId, $menuId)
    {
        try {
            // Find the provider and menu
            $provider = Provider::findOrFail($providerId);
            $menu = charity_menu::findOrFail($menuId);

            if (!$provider->menus()->where('id_m', $menu->id_menu)->exists()) {
                throw new \Exception('Menu not associated with the provider');
            }
            // Get the current quantity from the pivot table
            $currentQuantity = $provider->menus()->where('id_m', $menu->id_menu)->first()->pivot->quantity;

            // Calculate the new quantity

            $newQuantity = $currentQuantity - $quantity;
            if ($newQuantity < 0){
                throw new \Exception('No puede reservar más paquetes de los que hay disponibles');
            }
            // Update the quantity through the pivot table
            $provider->menus()->updateExistingPivot($menu->id_menu, ['quantity' => $newQuantity]);

            // Return a success response
            return response()->json(['message' => 'Quantity updated successfully']);
        } catch (\Exception $e) {
            // Return an error response if an exception is caught
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function bookingsByProvider($provider)
    {
        $now = Carbon::now();





        $dateString = $now->format('Y-m-d');

        $startDate = $now->subDays(30);


        try {
            $count = Booking::where('id_provider_fk', $provider)
            ->whereBetween('curr_date', [$startDate, $dateString])
            ->count();
            $response = response()->json($count, 200);

        } catch (\Throwable $th) {
            $response = response()->json(['error' => 'Error al mostrar los bookings: ' . $th->getMessage()], 500);

        }

        return $response;

    }




    public function getKG( $provider){

        try {
            $count = Booking::where('id_provider_fk', $provider)->count();
            $kg = $count * 0.5;
            $response = response()->json($kg, 200);

        } catch (\Throwable $th) {
            $response = response()->json(['error' => 'Error al mostrar los bookings: ' . $th->getMessage()], 500);

        }
        return $response;
    }



    public function deliverysByProvider($provider)
    {
        try {
            $bookingsByMonth = [];

            // Iterar sobre cada mes del año
            for ($month = 1; $month <= 12; $month++) {
                // Obtener el número de reservas para el proveedor en ese mes
                $bookingsCount = Booking::where('id_provider_fk', $provider)
                ->whereRaw('MONTH(curr_Date) = ?', [$month])
                                                  ->count();

                // Agregar el resultado al array
                $bookingsByMonth[$month] = $bookingsCount;
            }

            $response = response()->json($bookingsByMonth, 200);
        } catch (\Throwable $th) {
            $response = response()->json(['error' => 'Error al mostrar los bookings: ' . $th->getMessage()], 500);
        }

        return $response;
    }




}
