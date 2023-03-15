<?php

namespace App\Http\Controllers;

use App\Models\DefaultGage;
use App\Models\DefaultTask;
use Illuminate\Http\Request;

class DefaultGageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $defaultGages = DefaultGage::all();
        return $defaultGages;
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
     * @param  \App\Models\DefaultTask  $defaultTask
     * @return \Illuminate\Http\Response
     */
    public function show(DefaultTask $defaultTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DefaultTask  $defaultTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DefaultTask $defaultTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DefaultTask  $defaultTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(DefaultTask $defaultTask)
    {
        //
    }
}