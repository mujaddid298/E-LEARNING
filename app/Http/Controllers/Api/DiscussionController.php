<?php

namespace App\Http\Controllers\Api;

use App\Events\DiscussionEvents;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Discussions;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'contents' => 'required'
        ]);


        $course = Course::find($request->course_id);

        if (!$course) {
            return response()->json(['message' => 'Mahasiswa tidak terdaftar']);
        }

        $discussion = new Discussions();
        $discussion->content = $request->contents;
        $discussion->course_id = $request->course_id;
        $discussion->user_id = $request->user()->id;
        $discussion->save();

       broadcast(new DiscussionEvents($discussion))->toOthers();

        return response()->json([
            'message' => 'Berhasil membuat discussion',
            'data' => $discussion
        ]);
    }
}
