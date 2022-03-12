<?php

namespace App\Http\Controllers;

use App\Http\Resources\SchoolResource;
use App\Models\School;
use App\Http\Requests\SchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SchoolController extends Controller
{
    /**
     *
     * @return AnonymousResourceCollection
     */
    public function indexSchools()
    {
        $school = School::with('user')->latest()->get();
        return SchoolResource::collection($school);
    }

    /**
     *
     * @param SchoolRequest $request
     * @return SchoolResource
     */

    public function storeSchools(SchoolRequest $request)
    {
        $school = auth()->user()->schools()->create($request->validated());
        return new SchoolResource($school);
    }


    /**
     *
     * @param SchoolRequest $request
     * @param School $school
     * @return SchoolResource
     */
    public function updateSchools(SchoolRequest $request, School $school)
    {
        $school->update($request->validated());
        abort_if(!$school->wasChanged(), 403);
        return new SchoolResource($school);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param School $school
     * @return Response
     */
    public function destroySchools(School $school)
    {
        $school->delete();
        return response(['success' => true]);
    }
}
