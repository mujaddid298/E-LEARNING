<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materials extends Model
{

    use SoftDeletes;

    protected $table = 'materials';

    protected $fillable = [
        'course_id',
        'title',
        'file_path',
    ];


    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
