<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\classroom;

class ClassroomController extends Controller
{
    public function getStudents()
    {
        return response()->json(classroom::getStudents());
    }

    public function createStudent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'age' => 'required|integer|min:1',
        ], [
            'name.required' => 'The student name is required.',
        ]);

        $student = classroom::createStudent($validated['name'], $validated['age']);

        return response()->json(['message' => 'Student created successfully', 'data' => $student], 201);
    }

    public function deleteStudent($id)
    {
        return classroom::deleteStudentById($id)
            ? response()->json(['message' => 'Student deleted'])
            : response()->json(['error' => 'Student not found'], 404);
    }

    public function updateStudent(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'age' => 'required|integer|min:1',
            'email' => 'required|email',
        ], [
            'name.required' => 'The student name is required.',
        ]);

        $student = classroom::updateStudent($id, $validated['name'], $validated['age'], email: $validated['email']);

        return $student
            ? response()->json(['message' => 'Student updated', 'data' => $student])
            : response()->json(['error' => 'Student not found'], 404);
    }

    public function getTeachers()
    {
        return response()->json(classroom::getTeachers());
    }

    public function createTeacher(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'subject' => 'required|string|max:100',
        ], [
            'name.required' => 'The teacher name is required.',
        ]);

        $teacher = classroom::createTeacher($validated['name'], $validated['subject']);

        return response()->json(['message' => 'Teacher created successfully', 'data' => $teacher], 201);
    }

    public function deleteTeacher($id)
    {
        return classroom::deleteTeacherById($id)
            ? response()->json(['message' => 'Teacher deleted'])
            : response()->json(['error' => 'Teacher not found'], 404);
    }

    public function updateTeacher(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'subject' => 'required|string|max:100',
        ], [
            'name.required' => 'The teacher name is required.',
        ]);

        $teacher = classroom::updateTeacher($id, $validated['name'], $validated['subject']);

        return $teacher
            ? response()->json(['message' => 'Teacher updated', 'data' => $teacher])
            : response()->json(['error' => 'Teacher not found'], 404);
    }
}
