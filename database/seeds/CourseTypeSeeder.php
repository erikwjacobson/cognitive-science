<?php

use App\CourseType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = [
            ['name' => 'Prerequisite', 'description' => 'This course is a prerequisite for the degree.'],
            ['name' => 'Core', 'description' => 'This course is a core class for the degree.'],
            ['name' => 'Required', 'description' => 'This course is a required course for the degree.'],
            ['name' => 'Track Course', 'description' => 'This course is a track course for the degree.'],
            ['name' => 'Elective', 'description' => 'This course is an elective course for the degree.'],
            ['name' => 'Capstone', 'description' => 'This course is a capstone course for the degree.'],
        ];

        foreach($a as $courseType) {
            CourseType::firstOrCreate($courseType);
        }
    }
}
