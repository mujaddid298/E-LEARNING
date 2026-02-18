<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AssignmentMail;
use App\Models\Assignments;
use App\Models\Course;
use App\Models\Discussions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $course = Course::find($request->course_id);

        if (!$course) {
            return response()->json([
                'message' => 'Course tidak ditemukan'
            ]);
        }

        $assignment = new Assignments();
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->deadline = $request->deadline;
        $assignment->course_id = $request->course_id;
        $assignment->save();

        $students = User::whereHas('courses', function ($query) use ($request) {
            $query->where('courses.id', $request->course_id);
        })->get();
        foreach ($students as $item) {
            Mail::to($item->email)->send(new AssignmentMail($assignment));
        }

        return response()->json([
            'message' => 'Data assignment berhasil dibuat',
            'data' => $assignment
        ]);
    }
}
