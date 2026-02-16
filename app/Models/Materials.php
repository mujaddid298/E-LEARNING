<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    protected $table='materials';

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
