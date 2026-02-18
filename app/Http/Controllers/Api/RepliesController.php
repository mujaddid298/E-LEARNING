<?php

namespace App\Http\Controllers\Api;

use App\Events\RepliesEvents;
use App\Http\Controllers\Controller;
use App\Models\Discussions;
use App\Models\Replies;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function replies(Request $request, $id)
    {
        $request->validate([
            'contents' => 'required'
        ]);

        $discussion = Discussions::find($id);
        if (!$discussion) {
            return response()->json(['message' => 'Discussion tidak ditemukan']);
        }

        $replies = new Replies();
        $replies->content = $request->contents;
        $replies->discussion_id = $id;
        $replies->user_id = $request->user()->id;
        $replies->save();

        broadcast(new RepliesEvents($replies))->toOthers();

        return response()->json([
            'message' => 'Berhasil membuat replies',
            'data' => $replies
        ]);
    }
}
