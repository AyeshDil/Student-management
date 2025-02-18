<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\StudentQualification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentQualification>
 */
class StudentQualificationFactory extends Factory
{

    protected $model = StudentQualification::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'qualification' => $this->faker->randomElement([
                'BSc in Computer Science',
                'Diploma in IT',
                'MBA',
                'MSc in AI',
                'BEng in Software Engineering'
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
