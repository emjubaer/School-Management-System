<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClassRoom;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Manual small dataset
        ClassRoom::create([
            'name' => 'Class One',
            'status' => 'active',
            'description' => 'This is Class One',
        ]);

        ClassRoom::create([
            'name' => 'Class Two',
            'status' => 'active',
            'description' => 'This is Class Two',
        ]);

        ClassRoom::create([
            'name' => 'Class Three',
            'status' => 'inactive',
            'description' => 'This is Class Three',
        ]);
    }

}
