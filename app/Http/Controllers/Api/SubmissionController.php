<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\GradeMail;
use App\Models\Submissions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubmissionController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user()->id;

        $request->validate([
            'file_path' => 'required|file|max:10240',
            'assignment_id' => 'required|exists:assignments,id'
        ]);

        $assign = $request->assignment_id;
        if (!$assign) {
            return response()->json(['message' => 'Assignment tidak ditemukan']);
        }


        $file = $request->file('file_path');
        $filePath = $file->store('submissions', 'public');

        $submission = new Submissions();
        $submission->file_path = $filePath;
        $submission->assignment_id = $request->assignment_id;
        $submission->student_id = $user;
        $submission->save();

        return response()->json(data: [
            'message' => 'Data submission berhasil dibuat',
            'data' => $submission
        ]);
    }

    public function grade(Request $request, $id)
    {
        $request->validate([
            'score' => 'required|integer|min:0|max:100',
        ]);


        $submission = Submissions::with('assignment', 'student')->findOrFail($id);
        $submission->score = $request->score;
        $submission->save();

        Mail::to($submission->student->email)->send(new GradeMail($submission));

        return response()->json([
            'message' => 'Nilai berhasil diberikan',
            'data'    => $submission
        ]);
    }
}
