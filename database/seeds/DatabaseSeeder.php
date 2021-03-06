<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CourseTypeSeeder::class);
         $this->call(DepartmentSeeder::class);
         $this->call(DegreeTypeSeeder::class);
         $this->call(UniversitySeeder::class);
    }
}
