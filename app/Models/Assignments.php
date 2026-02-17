<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    protected $table='assignments';

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
}
