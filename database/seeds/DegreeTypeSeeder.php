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
            ['id' => 1, 'name' => 'B.S.', 'description' => 'Bachelor of Science'],
            ['id' => 2, 'name' => 'B.A.', 'description' => 'Bachelor of Arts'],
            ['id' => 3, 'name' => 'B.A.S.', 'description' => 'Bachelor of Applied Science'],
            ['id' => 4, 'name' => 'B.I.S.', 'description' => 'Bachelor of Integrated Studies'],
            ['id' => 5, 'name' => 'B.S.S.', 'description' => 'Bachelor of Social Science'],
        ];

        foreach($a as $type) {
            DegreeType::firstOrCreate($type);
        }
    }
}
