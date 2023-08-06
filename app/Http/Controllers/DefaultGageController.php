<?php

namespace App\Http\Controllers;

use App\Http\Requests\DefaultGageRequest;
use App\Http\Resources\DefaultGageResource;
use App\Models\DefaultGage;
use App\Traits\HandlesDatabaseErrors;
use Illuminate\Http\JsonResponse;

class DefaultGageController extends Controller
{
    use HandlesDatabaseErrors;

    public function get_all_defaults_gages(): JsonResponse
    {
        try {
            $defaultGages = DefaultGage::all();
            return response()->json($defaultGages);
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function store_default_gage(DefaultGageRequest $defaultgageRequest)
    {
        try {
            $defaultGage = DefaultGage::create([
                'id' => $defaultgageRequest->id,
                'title' => $defaultgageRequest->title,
                'description' => $defaultgageRequest->description,
                'category' => $defaultgageRequest->category,
                'cost' => $defaultgageRequest->cost,
            ]);

            return response()->json($defaultGage);
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function show_default_gage(DefaultGage $defaultGage): JsonResponse
    {
        try {
            return response()->json($defaultGage);
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function update_default_gage(DefaultGageRequest $defaultGageRequest, DefaultGage $defaultGage): JsonResponse
    {
        try {
            $defaultGage->update($defaultGageRequest->validated());
            return response()->json(new DefaultGageResource($defaultGage));
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function destroy_default_gage(DefaultGage $defaultGage): JsonResponse
    {
        try {
            $defaultGage->delete();
            return response()->json(new DefaultGageResource($defaultGage));
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }
}
