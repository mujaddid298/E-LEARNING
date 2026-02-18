<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discussions extends Model
{
    use SoftDeletes;
    protected $table = 'discussions';
    protected $fillable = [
        'course_id',
        'user_id',
        'title',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function replies()
    {
        return $this->hasMany(Replies::class);
    }
}
