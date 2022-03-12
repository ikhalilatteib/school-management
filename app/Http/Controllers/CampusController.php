<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampusResource;
use App\Models\Campus;
use App\Http\Requests\StoreCampusRequest;
use App\Http\Requests\UpdateCampusRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CampusController extends Controller
{
    /**
     *
     * @return AnonymousResourceCollection
     */
    public function indexCampus()
    {
        $campus = Campus::with('school', 'country')->latest()->get();
        return CampusResource::collection($campus);
    }

    /**
     *
     * @param StoreCampusRequest $request
     * @return CampusResource
     */

    public function storeCampus(StoreCampusRequest $request)
    {
        $campus = Campus::create($request->validated());
        return new CampusResource($campus);
    }


    /**
     *
     * @param UpdateCampusRequest $request
     * @param Campus $campus
     * @return CampusResource
     */

    public function updateCampus(UpdateCampusRequest $request, Campus $campus)
    {
        $campus->update($request->validated());
        abort_if(!$campus->wasChanged(), 403);
        return new CampusResource($campus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Campus $campus
     * @return Response
     */
    public function destroyCampus(Campus $campus)
    {
        $campus->delete();
        return response(['success' => true]);
    }
}
