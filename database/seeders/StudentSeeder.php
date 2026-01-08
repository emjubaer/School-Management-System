<?php

namespace Database\Seeders;
use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 students using the factory
        Student::factory(3)->create([
            'class_id' => ClassRoom::inRandomOrder()->first()->id,
        ]);
    }
}
