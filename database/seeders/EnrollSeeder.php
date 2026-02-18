<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('course_user')->insert([
            ['user_id' => 1, 'course_id' => 1],
            ['user_id' => 1, 'course_id' => 2],
        ]);
    }
}
