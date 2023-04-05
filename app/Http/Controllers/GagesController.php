<?php

namespace App\Http\Controllers;

use App\Http\Requests\GageRequest;
use App\Http\Resources\GageResource;
use App\Models\Gage;
use App\Traits\Helper;
use App\Traits\HandlesDatabaseErrors;
use Illuminate\Http\JsonResponse;


class GagesController extends Controller
{

    use Helper;
    use HandlesDatabaseErrors;

    public function index(): JsonResponse
    {
        $idPartner = Helper::getPartnerId();
        $userId = Helper::getUserId();

        try {
            $gages = GageResource::collection(
                Gage::whereIn('user_id', [$idPartner, $userId])->get()
            );

            return response()->json($gages);
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function store(GageRequest $gageRequest): JsonResponse
    {
        try {
            $gageRequest->validated($gageRequest->all());
    
            $partnerId = Helper::getPartnerId();
    
            if ($partnerId !== null) {
                $gage = Gage::create([
                    'id' => $gageRequest->id,
                    'title' => $gageRequest->title,
                    'description' => $gageRequest->description,
                    'category' => $gageRequest->category,
                    'cost' => $gageRequest->cost,
                    'is_done' => $gageRequest->is_done,
                    'date_string' => $gageRequest->date_string,
                    'day' => $gageRequest->day,
                    'month' => $gageRequest->month,
                    'year' => $gageRequest->year,
                    'user_id' => $partnerId,
                ]);

            } else {
                throw new \Exception('Impossible de créer un gage car aucun partenaire n\'a été trouvé pour l\'utilisateur actuellement authentifié.');
            }
            
            return response()->json(new GageResource($gage));
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e, 500, $e->getMessage());
        }
    }
    

    // public function show(Gage $gage): JsonResponse
    // {
    //     //
    // }


    // public function update(Request $request, Gage $gage): JsonResponse
    // {
    //     //
    // }

    // public function destroy(Gage $gage): JsonResponse
    // {
    //     //
    // }
}
