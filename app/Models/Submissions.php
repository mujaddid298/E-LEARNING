<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submissions extends Model
{

    use SoftDeletes;

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
        return $this->belongsTo(Assignments::class);
    }

}
