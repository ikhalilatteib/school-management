<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\School;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Notifications\SendStudentReportOnDemand;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    /**
     *
     * @return AnonymousResourceCollection
     */
    public function indexStudent()
    {
        $student = Student::with('user')->latest()->get();
        return StudentResource::collection($student);
    }

    /**
     *
     * @param StoreStudentRequest $request
     * @return StudentResource
     */

    public function storeStudent(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());
        return new StudentResource($student);
    }


    /**
     *
     * @param UpdateStudentRequest $request
     * @param Student $student
     * @return StudentResource
     */
    public function updateStudent(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        abort_if(!$student->wasChanged(), 403);
        return new StudentResource($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return Response
     */
    public function destroyStudent(Student $student)
    {
        $student->delete();
        return response(['success' => true]);
    }

    /**
     *
     * @return Response
     */

    public function sendStudentReportOnDemand()
    {
        $students = Student::with('campus')->orderBy('name')->get();
        auth()->user()->notify(new SendStudentReportOnDemand($students));
        return response(['success' => true]);
    }

    /**
     *
     * @param $school
     * @return AnonymousResourceCollection
     */
    public function specificSchoolStudent($school)
    {
        $students = Student::query()->whereHas('campus', function ($query) use ($school) {
            $query->whereHas('school', function ($query) use ($school) {
                $query->where('name', $school);
            });
        })->get();
        return StudentResource::collection($students);
    }


}
