<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class; // <-- এখানে বলা হচ্ছে Student model-এর জন্য
    public function definition(): array
    {
        return [
            'reg_no' => $this->faker->unique()->numerify('REG###'),
            'name' => $this->faker->name(),
            'dob' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'photo' => null,
        ];
    }
}
