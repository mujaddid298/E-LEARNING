<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $lecturers = User::where('role', 'lecturer')->get();

        $courses = [
            [
                'name' => 'Matematika',
                'description' => 'Ilmu yang menyenangkan.',
            ],
            [
                'name' => 'Programan web',
                'description' => 'Belajar hukum-hukum fisika dasar.',
            ],
        ];

        foreach ($courses as $data) {
            $lecturer = $lecturers->random();
            Course::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'lecturer_id' => $lecturer->id,
            ]);
        }
    }
}
