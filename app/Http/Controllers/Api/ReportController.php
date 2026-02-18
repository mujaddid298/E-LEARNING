<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignments;
use App\Models\Course;
use App\Models\Submissions;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function courses()
    {
        $courses = Course::withCount('courseStudents')->get();
        $total = Course::with('courseStudents')->get()->count();
        return response()->json([
            'message' => 'data course berhasil ditampilkan',
            'data' => $courses,
            'total' => $total
        ]);
    }


    public function assignments()
    {
        $total = Assignments::count();


        $grade = Submissions::whereNotNull('score')->count();
        $noGrade = Submissions::whereNull('score')->count();

        return response()->json([
            'message' => 'Data assignments berhasil ditampilkan',
            'total' => $total,
            'grade' => $grade,
            'noGrade' => $noGrade,
        ]);
    }

    public function student($id)
    {
        $student = User::findOrFail($id);

        if (!$student) {
            return response()->json([
                'message' => 'Data student tidak ditemukan'
            ]);
        }

        $total = Submissions::where('student_id', $id)->count();
        $avg = Submissions::where('student_id', $id)
            ->whereNotNull('score')
            ->avg('score');
        $max = Submissions::where('student_id', $id)
            ->whereNotNull('score')
            ->max('score');
        $min = Submissions::where('student_id', $id)
            ->whereNotNull('score')
            ->min('score');

        return response()->json([
            'message' => 'Data student berhasil ditampilkan',
            'student' => $student,
            'total' => $total,
            'avg_score' => round($avg, 2),
            'max_score' => round($max, 2),
            'min_score' => round($min, 2),

        ]);
    }
}
