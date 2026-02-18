<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Replies extends Model
{
    use SoftDeletes;
    protected $table = 'replies';
    protected $fillable = [
        'discussion_id',
        'user_id',
        'content',
    ];

    public function discussion()
    {
        return $this->belongsTo(Discussions::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
