<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Http\Requests\SchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use Illuminate\Http\Response;

class SchoolController extends Controller
{
    /**
     *
     * @return Response
     */
    public function indexSchools()
    {
        $school = School::with('users')->latest()->get();
        return response(['schools' => $school]);
    }

    /**
     *
     * @param SchoolRequest $request
     * @return Response
     */

    public function storeSchools(SchoolRequest $request)
    {
        $school = auth()->user()->schools()->create($request->validated());
        return response(['schools' => $school]);
    }

    /**
     *
     * @param School $school
     * @return Response
     */
    public function showSchools(School $school)
    {
        return response(['schools' => $school]);
    }


    /**
     *
     * @param SchoolRequest $request
     * @param School $school
     * @return Response
     */
    public function updateSchools(SchoolRequest $request, School $school)
    {
        $school->update($request->validated());
        abort_if(!$school->wasChanged(), 404);
        return response(['schools' => $school]);
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
