<?php

namespace App\Http\Controllers;

use App\Http\Requests\DefaultSuggestionRequest;
use App\Models\DefaultSuggestion;
use App\Traits\HandlesDatabaseErrors;
use Illuminate\Http\JsonResponse;

class DefaultSuggestionController extends Controller
{
    use HandlesDatabaseErrors;

    public function store_default_suggestion(DefaultSuggestionRequest $suggestionRequest): JsonResponse
    {

        try {
            $validatedData = $suggestionRequest->validated();

            $defaultSuggestion = DefaultSuggestion::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'category' => $validatedData['category'],
                'path_icon' => $validatedData['path_icon'],
            ]);

            return response()->json($defaultSuggestion);
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }
}
