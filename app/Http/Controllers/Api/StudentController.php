<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::with('courses')->get();
        return ResponseHelper::responseFormat(Response::HTTP_OK, 'Students retrieved successfully', $students);
    }

    public function show($id)
    {
        $student = Student::with('courses')->find($id);
        
        if (!$student) {
            return ResponseHelper::responseFormat(Response::HTTP_NOT_FOUND, 'Student not found');
        }
        
        return ResponseHelper::responseFormat(Response::HTTP_OK, 'Student retrieved successfully', $student);

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students,email',
            'courses' => 'required|array',
        ]);

        $student = Student::create($validated);

        // Attach courses
        $student->courses()->sync($request->courses);

        return ResponseHelper::responseFormat(Response::HTTP_CREATED, 'Student created successfully', $student);
    }

    // Update student details
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'courses' => 'required|array',
        ]);

        $student = Student::find($id);

        if (!$student) {
            return ResponseHelper::responseFormat(Response::HTTP_NOT_FOUND, 'Student not found');
        }

        $student->update($validated);

        // Attach courses
        $student->courses()->sync($request->courses);

        return ResponseHelper::responseFormat(Response::HTTP_OK, 'Student updated successfully', $student);
    }

    // Delete a student
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return ResponseHelper::responseFormat(Response::HTTP_NOT_FOUND, 'Student not found');
        }

        // Detach courses and delete the student
        $student->courses()->detach();
        $student->delete();

        return ResponseHelper::responseFormat(Response::HTTP_OK, 'Student deleted successfully');
    }

    public function search(Request $request)
    {
        // Validate incoming search query parameters
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        // Start query for students
        $query = Student::query();

        // If a name is provided, filter by name
        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // If an email is provided, filter by email
        if ($request->has('email') && $request->email) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Get the filtered students
        $students = $query->get();

        // Return response, either as JSON (API) or Blade view (web)
        return ResponseHelper::responseFormat(Response::HTTP_OK, 'Students retrieved successfully', $students);
    }
}
