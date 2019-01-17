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
            ['id' => 1, 'name' => 'Anthropology'],
            ['id' => 2, 'name' => 'Audiology & Speech Pathology'],
            ['id' => 3, 'name' => 'Biology'],
            ['id' => 4, 'name' => 'Biomedical Sciences'],
            ['id' => 5, 'name' => 'Chemistry'],
            ['id' => 6, 'name' => 'Cognitive Science'],
            ['id' => 7, 'name' => 'Communications'],
            ['id' => 8, 'name' => 'Computer Science'],
            ['id' => 9, 'name' => 'Economics'],
            ['id' => 10, 'name' => 'Education'],
            ['id' => 11, 'name' => 'Engineering'],
            ['id' => 12, 'name' => 'English'],
            ['id' => 13, 'name' => 'Informatics & Information Science'],
            ['id' => 14, 'name' => 'Interdisciplinary Studies'],
            ['id' => 15, 'name' => 'Kinesiology'],
            ['id' => 16, 'name' => 'Linguistics'],
            ['id' => 17, 'name' => 'Management'],
            ['id' => 18, 'name' => 'Mathematics & Statistics'],
            ['id' => 19, 'name' => 'Music'],
            ['id' => 20, 'name' => 'Neuroscience'],
            ['id' => 21, 'name' => 'Philosophy'],
            ['id' => 22, 'name' => 'Physics'],
            ['id' => 23, 'name' => 'Political Science'],
            ['id' => 24, 'name' => 'Psychology'],
            ['id' => 25, 'name' => 'Sociology'],
            ['id' => 26, 'name' => 'Other'],
        ];

        foreach($a as $dept) {
            Department::firstOrCreate($dept);
        }
    }
}
