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
            ['name' => 'Anthropology'],
            ['name' => 'Audiology & Speech Pathology'],
            ['name' => 'Biology'],
            ['name' => 'Biomedical Sciences'],
            ['name' => 'Chemistry'],
            ['name' => 'Cognitive Science'],
            ['name' => 'Communications'],
            ['name' => 'Computer Science'],
            ['name' => 'Economics'],
            ['name' => 'Education'],
            ['name' => 'Engineering'],
            ['name' => 'English'],
            ['name' => 'Informatics & Information Science'],
            ['name' => 'Interdisciplinary Studies'],
            ['name' => 'Kinesiology'],
            ['name' => 'Linguistics'],
            ['name' => 'Management'],
            ['name' => 'Mathematics & Statistics'],
            ['name' => 'Music'],
            ['name' => 'Neuroscience'],
            ['name' => 'Philosophy'],
            ['name' => 'Physics'],
            ['name' => 'Political Science'],
            ['name' => 'Psychology'],
            ['name' => 'Sociology'],
            ['name' => 'Other'],
        ];

        foreach($a as $dept) {
            Department::firstOrCreate($dept);
        }
    }
}
