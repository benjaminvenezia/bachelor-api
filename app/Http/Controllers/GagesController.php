<?php

namespace App\Http\Controllers;

use App\Models\Gage;
use Illuminate\Http\Request;

class GagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $gages = Gage::all();
            return response()->json($gages);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gage  $gage
     * @return \Illuminate\Http\Response
     */
    public function show(Gage $gage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gage  $gage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gage $gage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gage  $gage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gage $gage)
    {
        //
    }
}
