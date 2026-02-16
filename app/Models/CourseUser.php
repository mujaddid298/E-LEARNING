<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{

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
