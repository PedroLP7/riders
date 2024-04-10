<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\rider;
use App\Models\booking;
use App\Clases\Utilidad;


use App\Models\provider;
use App\Models\charity_menu;
use Illuminate\Http\Request;
use App\Models\booking_status;
use App\Http\Resources\BookingResource;
use Illuminate\Database\QueryException;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::where('id_status_fk', 1)
                  ->orWhere('id_status_fk', 2)

                  ->get();

        return view('adminZone.Bookings.index', compact('bookings'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $riders = rider::all();
        $providers = provider::with('menus')->get();
        $status = booking_status::all();
        $menus = charity_menu::all();

        return view('adminZone.Bookings.create',compact('riders','providers','status','menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $booking = new Booking();
        $booking->id_rider_fk = $request->input('id_rider_fk');
        $booking->id_provider_fk = $request->input('id_provider_fk');
        $booking->id_menu_fk = $request->input('id_menu_fk');
        $booking->menu_quantity = $request->input('menu_quantity');
        $booking->id_status_fk = $request->input('id_status_fk');
        $fecha_actual = Carbon::now()->format('Y:m:d');

        $booking->curr_date = $fecha_actual;

        try {
            $booking->save();
            $response = redirect('/admin/bookings/');


        } catch (QueryException $th) {

            $response = redirect('/admin/bookings/create');
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(booking $booking)
    {


        $riders = rider::all();
        $providers = provider::with('menus')->get();
        $status = booking_status::all();








        return view('adminZone.Bookings.edit', compact('booking', 'riders', 'providers', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, booking $booking)
    {


        $booking->id_rider_fk = $request->input('id_rider');




        // foreach ($booking->provider->menus as $charity_menu) {
        //     $quantity = $charity_menu->pivot->quantity;

        //    $prueba = $booking->menu_quantity = $request->input('quantity');
        //     if ($prueba > $quantity) {
        //         // dd($quantity,$prueba);
        //         session()->flash('error', 'No puedes pedir más menús de los que tiene el proveedor , se te han asignado todos los que tiene disponibles :)');
        //         $booking->menu_quantity = $quantity;
        //         $charity_menu->pivot->quantity = 0;
        //         $charity_menu->pivot->save();


        //     }else{
        //         $booking->menu_quantity = $request->input('quantity');
        //        $charity_menu->pivot->quantity = $quantity - $prueba;
        //         $charity_menu->pivot->save();
        //     }

        // }



        // $booking->menu_quantity = $request->input('quantity');



        $booking->id_status_fk = $request->input('id_status');

        try {
            $booking->save();
            $response = redirect('/admin/bookings/');
        } catch (\Throwable $th) {
            session()->flash('error',"error al editar el booking: ".$th->getMessage());
            $response = redirect('/admin/bookings/edit/')->withInput();

        }
        return $response;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(booking $booking)
    {
        try{
            $booking->delete();
            $response = redirect('/admin/bookings/');
        }catch(\Throwable $th){
            session()->flash('error',"error al eliminar el booking: ".$th->getMessage());
            $response = redirect('/admin/bookings/');
        }
        return $response;
    }
}
