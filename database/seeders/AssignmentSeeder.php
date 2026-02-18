<?php

namespace Database\Seeders;

use App\Models\Assignments;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assignments = [
            [
                'title' => 'Tugas Matematika',
                'description' => 'Kerjakan soal pada halaman 10-20',
                'deadline' => Carbon::now()->addDays(5),
                'course_id' => 1,
            ],
            [
                'title' => 'Tugas Website',
                'description' => 'Buat laporan praktikum website',
                'deadline' => Carbon::now()->addDays(5),
                'course_id' => 2,
            ],
        ];

        foreach ($assignments as $data) {
            Assignments::create($data);
        }
    }
}
