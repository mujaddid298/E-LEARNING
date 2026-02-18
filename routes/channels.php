<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('discussion.{courseId}', function ($user, $courseId) {
    return true;
});

Broadcast::channel('replies.{discussionId}', function ($user, $discussionId) {
    return true;
});