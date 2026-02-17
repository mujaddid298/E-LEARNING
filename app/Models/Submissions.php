<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submissions extends Model
{
    protected $table = 'submissions';

    protected $fillable = [
        'assignment_id',
        'student_id',
        'file_path',
        'score',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    public function assignment()
    {
        return $this->belongsToMany(Assignments::class);
    }

}
