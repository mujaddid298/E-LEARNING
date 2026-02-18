<?php

namespace App\Http\Controllers\Api;

use App\Events\RepliesEvents;
use App\Http\Controllers\Controller;
use App\Models\Replies;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function replies(Request $request, $id)
    {
        $request->validate([
            'contents' => 'required'
        ]);




        $replies = new Replies();
        $replies->content = $request->contents;
        $replies->discussion_id = $request->discussion_id;
        $replies->user_id = $request->user()->id;
        $replies->save();

        broadcast(new RepliesEvents($replies))->toOthers();

        return response()->json([
            'message' => 'Berhasil membuat discussion',
            'data' => $replies
        ]);
    }
}
