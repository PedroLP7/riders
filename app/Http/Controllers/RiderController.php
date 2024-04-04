<?php

namespace App\Http\Controllers;

use App\Models\rider;
use App\Models\Usuario;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riders = Usuario::with('rider')->where('user_type_id', 2)->get();
        return view('adminZone.Riders.index', compact('riders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(rider $rider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rider $rider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rider $rider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rider $rider)
    {
        //
    }
}
