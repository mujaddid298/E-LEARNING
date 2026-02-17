<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Submissions;
use Illuminate\Http\Request;

class SubmissionContoller extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'file_path' => 'required|string|file|max:10240',
            'assignment_id' => 'required|exists:assignment,id',
            'score' => 'required|integer|nullable',
        ]);

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
}
