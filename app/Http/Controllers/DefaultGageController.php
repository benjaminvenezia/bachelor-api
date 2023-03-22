<?php

namespace App\Http\Controllers;

use App\Http\Resources\DefaultGageResource;
use App\Models\DefaultGage;
use Illuminate\Http\Request;

class DefaultGageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_all_defaults_gages()
    {
        try {
            $defaultGages = DefaultGage::all();
            return $defaultGages;
        } catch (\Exception $e) {
            $errorMessage = 'Une erreur s\'est produite lors de la récupération des données.';
            $errorCode = 500;

            if ($e instanceof \Illuminate\Database\QueryException) {
                $errorMessage = 'Une erreur s\'est produite lors de l\'exécution de la requête SQL.';
                $errorCode = 400;
            }
            return response()->json(['error' => $errorMessage, 'details' => $e->getMessage()], $errorCode);
        }
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_default_gage(Request $request)
    {
        try {
            $defaultGage = DefaultGage::create([
                'id' => $request->id,
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'cost' => $request->cost,
            ]);

            return $defaultGage;
        } catch (\Exception $e) {
            $errorMessage = 'Une erreur s\'est produite lors de la création du gage par défaut.';
            $errorCode = 500;

            if ($e instanceof \Illuminate\Database\QueryException) {
                $errorMessage = 'Une erreur s\'est produite lors de l\'exécution de la requête SQL.';
                $errorCode = 400;
            }

            return response()->json(['error' => $errorMessage, 'details' => $e->getMessage()], $errorCode);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DefaultGage  $defaultGage
     * @return \Illuminate\Http\Response
     */
    public function show_default_gage(DefaultGage $defaultGage)
    {
        try {
            return $defaultGage;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DefaultGage  $defaultGage
     * @return \Illuminate\Http\Response
     */
    public function update_default_gage(Request $request, DefaultGage $defaultGage)
    {
        try {
            $defaultGage->update($request->all());

            return new DefaultGageResource($defaultGage);
        } catch (\Exception $e) {
            return $this->error('Update error', $e->getMessage(), 500);
        }
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DefaultGage  $defaultGage
     * @return \Illuminate\Http\Response
     */
    public function destroy_default_gage(DefaultGage $defaultGage)
    {
        try {
            $defaultGage->delete();
            return new DefaultGageResource($defaultGage);
        } catch (\Exception $e) {
            return $this->error('destroy error', $e->getMessage(), 500);
        }
    }
}
