<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Http\Requests\StoreCampusRequest;
use App\Http\Requests\UpdateCampusRequest;
use Illuminate\Http\Response;

class CampusController extends Controller
{
    /**
     *
     * @return Response
     */
    public function indexCampus()
    {
        $campus = Campus::with('school','country')->latest()->get();
        return response(['Campus' => $campus]);
    }

    /**
     *
     * @param StoreCampusRequest $request
     * @return Response
     */

    public function storeCampus(StoreCampusRequest $request)
    {
        $campus =Campus::create($request->validated());
        return response(['Campus' => $campus]);
    }


    /**
     *
     * @param UpdateCampusRequest $request
     * @param Campus $campus
     * @return Response
     */

    public function updateCampus(UpdateCampusRequest $request, Campus $campus)
    {
        $campus->update($request->validated());
        abort_if(!$campus->wasChanged(), 404);
        return response(['Campus' => $campus]);
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
