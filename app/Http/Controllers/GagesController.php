<?php

namespace App\Http\Controllers;

use App\Http\Requests\GageRequest;
use App\Http\Resources\GageResource;
use App\Http\Resources\GroupResource;
use App\Models\Gage;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GagesController extends Controller
{

    /**
     * Return the id of the current user Group.
     *
     * @return void
     */
    public function getCurrentGroupId(): int|string
    {
        $group = GroupResource::collection(
            Group::where('user_id1', Auth::user()->id)->get(),
        );

        if (count($group) == 0) {
            $group = GroupResource::collection(
                Group::where('user_id2', Auth::user()->id)->get(),
            );
        }

        return $group[0]->id;
    }

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

        $partner = User::where('personalCode', Auth::user()->otherCode)->first();

        $gage = Gage::create([
            'id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'is_done' => $request->is_done,
            'date_string' => $request->date_string,
            'day' => $request->day,
            'month' => $request->month,
            'year' => $request->year,
            'timestamp' => $request->timestamp,
            'user_id' => $partner->id,
        ]);

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
