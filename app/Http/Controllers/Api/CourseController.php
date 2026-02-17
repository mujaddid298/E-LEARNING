<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Symfony\Component\Mime\Message;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('lecturer')->get();

        return response()->json([
            'message' => 'data course berhasil ditampilkan',
            'data' => $courses
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $course = new Course();
        $course->name = $request->name;
        $course->description = $request->description;
        $course->lecturer_id = $request->user()->id;
        $course->save();

        return response()->json([
            'message' => 'Data course berhasil dibuat',
            'data' => $course
        ]);
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'message' => 'Course tidak ditemukan'
            ]);
        }

        if ($course->lecturer_id != $request->user()->id) {
            return response()->json([
                'message' => 'Course bukan punya dosen'
            ]);
        }

        $request->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);

        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();

        return response()->json([
            'message' => 'Data course berhasil diubah',
            'data' => $course
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'message' => 'Course tidak ditemukan'
            ]);
        }

        if ($course->lecturer_id != $request->user()->id) {
            return response()->json([
                'message' => 'Course bukan punya dosen'
            ]);
        }

        $course->delete();

        return response()->json([
            'message' => 'Data course berhasil dihapus'
        ]);
    }

    public function enroll(Request $request, $id)
    {
        $user = $request->user();

        $course = Course::find($id);
        if (!$course) {
            return response()->json(['message' => 'Course tidak ditemukan'], 404);
        }
 
        $sudah = $user->courses()->where('courses.id', $id)->exists();
        if ($sudah) {
            return response()->json(['message' => 'Mahasiswa sudah terdaftar'], 400);
        }

        $user->courses()->attach($id);

        return response()->json(['message' => 'Berhasil enroll']);
    }
}
