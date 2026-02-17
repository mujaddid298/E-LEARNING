<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignments extends Model
{
    use SoftDeletes;

    protected $table = 'assignments';

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'course_id',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submissions::class);
    }
}
