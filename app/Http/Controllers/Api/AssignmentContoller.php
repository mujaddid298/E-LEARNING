<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignments;
use Illuminate\Http\Request;

class AssignmentContoller extends Controller
{
     public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
            'course_id' => 'required|exists:courses,id'
        ]);

        $assignment = new Assignments();
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->deadline = $request->deadline;
        $assignment->course_id = $request->course_id;
        $assignment->save();

        return response()->json([
            'message' => 'Data assignment berhasil dibuat',
            'data' => $assignment
        ]);
    }
}
