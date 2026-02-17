<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Materials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        $courses = Materials::get();

        return response()->json([
            'message' => 'data course berhasil ditampilkan',
            'data' => $courses
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'file_path' => 'required|file|max:10240',
            'course_id' => 'required|exists:courses,id'
        ]);

        $course = $request->course_id;
        if (!$course) {
            return response()->json(['message' => 'Course tidak ditemukan'], 404);
        }

        $file = $request->file('file_path');
        $filePath = $file->store('materials', 'public');


        $material = new Materials();
        $material->title = $request->title;
        $material->file_path = $filePath;
        $material->course_id = $request->course_id;
        $material->save();

        return response()->json([
            'message' => 'Data material berhasil dibuat',
            'data' => $material
        ]);
    }

    public function download($id)
    {
        $material = Materials::findOrFail($id);

        if (!Storage::disk('public')->exists($material->file_path)) {
            return response()->json(['message' => 'File tidak ditemukan']);
        }
        $filePath = Storage::disk('public')->path($material->file_path);
        return response()->download($filePath);
    }
}
