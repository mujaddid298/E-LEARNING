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
            'title' => 'required',
            'file_path' => 'required|file|max:10240',
            'course_id' => 'required|exists:courses,id'
        ]);

        $file = $request->file('file_path');
        $filePath = $file->store('materials', 'public');


        $material = new Materials();
        $material->title = $request->title;
        $material->file_path = $filePath;
        $material->course_id = $request->course_id;
        $material->save();

        return response()->json([
            'message' => 'Data course berhasil dibuat',
            'data' => $material
        ]);
    }

    public function download($id)
    {
        $material = Materials::findOrFail($id);

        if (!$material) {
            return response()->json(['message' => 'Material tidak ditemukan']);
        }

        if (!Storage::disk('public')->exists($material->file_path)) {
            return response()->json(['message' => 'File tidak ditemukan']);
        }

        return Storage::disk('public')->download($material->file_path, $material->title);
    }
}
