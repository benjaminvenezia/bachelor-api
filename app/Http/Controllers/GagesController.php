<?php

namespace App\Http\Controllers;

use App\Http\Requests\GageRequest;
use App\Http\Resources\GageResource;
use App\Http\Resources\GroupResource;
use App\Models\Gage;
use App\Models\Group;
use App\Models\User;
use App\Traits\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GagesController extends Controller
{

    use Helper;

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
    public function store(GageRequest $request)
    {
        $request->validated($request->all());

        $partnerId = Helper::getCurrentPartnerId();

        if ($partnerId !== null) {
            $gage = Gage::create([
                'id' => $request->id,
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'cost' => $request->cost,
                'is_done' => $request->is_done,
                'date_string' => $request->date_string,
                'day' => $request->day,
                'month' => $request->month,
                'year' => $request->year,
                'user_id' => $partnerId,
            ]);
        } else {
            return response()->json([
                'error' => [
                    'message' => 'Impossible de créer un gage car aucun partenaire n\'a été trouvé pour l\'utilisateur actuellement authentifié.',
                ],
            ], 400);
        }

        return new GageResource($gage);
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
