<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = [
            ['name' => 'Psychology'],
            ['name' => 'Philosophy'],
            ['name' => 'Biology'],
            ['name' => 'Computer Science'],
            ['name' => 'Cognitive Science'],
            ['name' => 'Linguistics'],
            ['name' => 'Anthropology'],
        ];

        foreach($a as $dept) {
            Department::firstOrCreate($dept);
        }
    }
}
