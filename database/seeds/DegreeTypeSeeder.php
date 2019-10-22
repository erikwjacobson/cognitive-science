<?php

use App\DegreeType;
use Illuminate\Database\Seeder;

class DegreeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = [
            ['name' => 'B.S.', 'description' => 'Bachelor of Science'],
            ['name' => 'B.A.', 'description' => 'Bachelor of Arts'],
            ['name' => 'B.A.S.', 'description' => 'Bachelor of Applied Science'],
            ['name' => 'B.I.S.', 'description' => 'Bachelor of Integrated Studies'],
            ['name' => 'B.S.S.', 'description' => 'Bachelor of Social Science'],
        ];

        foreach($a as $type) {
            DegreeType::firstOrCreate($type);
        }
    }
}
