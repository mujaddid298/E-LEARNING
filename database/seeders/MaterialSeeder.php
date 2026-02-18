<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materials;
use App\Models\Course;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            $pdfFiles = [
                'tugas1.pdf',
                'tugas2.pdf',
            ];

            foreach ($pdfFiles as $fileName) {
                $file = "materials/$fileName";

                Materials::create([
                    'title' => $fileName,
                    'file_path' => $file,
                    'course_id' => $course->id
                ]);
            }
        }

    }
}
