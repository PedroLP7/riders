<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\charity_menu;
use Illuminate\Http\Request;

class CharityMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $charity_menu = charity_menu::all();
        return response()->json($charity_menu);
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
    public function show(charity_menu $charity_menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, charity_menu $charity_menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(charity_menu $charity_menu)
    {
        //
    }
}
