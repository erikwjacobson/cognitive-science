<?php

use App\University;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = [
            ['id' => 1, 'name' => 'Beloit College'],
            ['id' => 2, 'name' => 'Brown University'],
            ['id' => 3, 'name' => 'California State University-Fresno'],
            ['id' => 4, 'name' => 'California State University-Stanislaus'],
            ['id' => 5, 'name' => 'Carleton College'],
            ['id' => 6, 'name' => 'Carnegie Mellon University'],
            ['id' => 7, 'name' => 'Case Western Reserve University'],
            ['id' => 8, 'name' => 'Central Michigan University'],
            ['id' => 9, 'name' => 'Dartmouth College'],
            ['id' => 10,'name' => 'Eastern Connecticut State University'],
            ['id' => 11,'name' => 'George Fox University'],
            ['id' => 12,'name' => 'Georgetown University'],
            ['id' => 13,'name' => 'Hampshire College'],
            ['id' => 14,'name' => 'Indiana University-Bloomington'],
            ['id' => 15,'name' => 'Institute of Ocean Technology'],
            ['id' => 16,'name' => 'Johns Hopkins University'],
            ['id' => 17,'name' => 'Lehigh University'],
            ['id' => 18,'name' => 'Marquette University'],
            ['id' => 19,'name' => 'Massachusetts Institute of Technology'],
            ['id' => 20,'name' => 'Minnesota State University-Mankato'],
            ['id' => 21,'name' => 'Muskingum University'],
            ['id' => 22,'name' => 'Northwestern University'],
            ['id' => 23,'name' => 'Occidental College'],
            ['id' => 24,'name' => 'Pomona College'],
            ['id' => 25,'name' => 'Rensselaer Polytechnic Institute'],
            ['id' => 26,'name' => 'Rice University'],
            ['id' => 27,'name' => 'Simmons College'],
            ['id' => 28,'name' => 'Smith College'],
            ['id' => 29,'name' => 'Stanford University'],
            ['id' => 30,'name' => 'SUNY College at Oswego'],
            ['id' => 31,'name' => 'Swarthmore College'],
            ['id' => 32,'name' => 'The University of Texas at Dallas'],
            ['id' => 33,'name' => 'Tufts University'],
            ['id' => 34,'name' => 'United States Military Academy'],
            ['id' => 35,'name' => 'University of Arizona'],
            ['id' => 36,'name' => 'University of California-Berkeley'],
            ['id' => 37,'name' => 'University of California-Davis'],
            ['id' => 38,'name' => 'University of California-Irvine'],
            ['id' => 39,'name' => 'University of California-Los Angeles'],
            ['id' => 40,'name' => 'University of California-Merced'],
            ['id' => 41,'name' => 'University of California-San Diego'],
            ['id' => 42,'name' => 'University of California-Santa Cruz'],
            ['id' => 43,'name' => 'University of Connecticut'],
            ['id' => 44,'name' => 'University of Delaware'],
            ['id' => 45,'name' => 'University of Evansville'],
            ['id' => 46,'name' => 'University of Georgia'],
            ['id' => 47,'name' => 'University of Memphis'],
            ['id' => 48,'name' => 'University of Michigan-Ann Arbor'],
            ['id' => 49,'name' => 'University of Pennsylvania'],
            ['id' => 50,'name' => 'University of Richmond'],
            ['id' => 51,'name' => 'University of Rochester'],
            ['id' => 52,'name' => 'University of Southern California'],
            ['id' => 53,'name' => 'University of Virginia'],
            ['id' => 54,'name' => 'University of Wisconsin-Stout'],
            ['id' => 55,'name' => 'Vanderbilt University'],
            ['id' => 56,'name' => 'Vassar College'],
            ['id' => 57,'name' => 'Whitman College'],
            ['id' => 58,'name' => 'Yale University'],
        ];

        foreach($a as $uni) {
            University::firstOrCreate($uni);
        }
    }
}
