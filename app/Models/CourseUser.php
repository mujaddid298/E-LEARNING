<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseUser extends Model
{
    use SoftDeletes;


    protected $table ='course_users';

    public function coursesLecturer()
    {
        return $this->hasMany(Course::class, 'lecturer_id');
    }
 
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
