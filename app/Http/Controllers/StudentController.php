<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    /**
     *
     * @return Response
     */
    public function indexStudent()
    {
        $student = Student::with('user')->latest()->get();
        return response(['Students' => $student]);
    }

    /**
     *
     * @param StoreStudentRequest $request
     * @return Response
     */

    public function storeStudent(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());
        return response(['Students' => $student]);
    }



    /**
     *
     * @param UpdateStudentRequest $request
     * @param Student $student
     * @return Response
     */
    public function updateStudent(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        abort_if(!$student->wasChanged(), 404);
        return response(['Students' => $student]);
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
}
