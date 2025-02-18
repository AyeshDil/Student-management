<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;
use App\Models\StudentQualification;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Student::factory(10)->create()->each(function ($student) {
            // Assign random qualifications
            StudentQualification::factory(2)->create([
                'student_id' => $student->id,
            ]);

            // Assign random courses
            $courses = Course::factory(3)->create();
            $student->courses()->attach($courses->pluck('id'));
        });
    }
}
