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
            ['name' => 'Beloit College'],
            ['name' => 'Brown University'],
            ['name' => 'California State University-Fresno'],
            ['name' => 'California State University-Stanislaus'],
            ['name' => 'Carleton College'],
            ['name' => 'Carnegie Mellon University'],
            ['name' => 'Case Western Reserve University'],
            ['name' => 'Central Michigan University'],
            ['name' => 'Dartmouth College'],
            ['name' => 'Eastern Connecticut State University'],
            ['name' => 'George Fox University'],
            ['name' => 'Georgetown University'],
            ['name' => 'Hampshire College'],
            ['name' => 'Indiana University-Bloomington'],
            ['name' => 'Institute of Ocean Technology'],
            ['name' => 'Johns Hopkins University'],
            ['name' => 'Lehigh University'],
            ['name' => 'Marquette University'],
            ['name' => 'Massachusetts Institute of Technology'],
            ['name' => 'Minnesota State University-Mankato'],
            ['name' => 'Muskingum University'],
            ['name' => 'Northwestern University'],
            ['name' => 'Occidental College'],
            ['name' => 'Pomona College'],
            ['name' => 'Rensselaer Polytechnic Institute'],
            ['name' => 'Rice University'],
            ['name' => 'Simmons College'],
            ['name' => 'Smith College'],
            ['name' => 'Stanford University'],
            ['name' => 'SUNY College at Oswego'],
            ['name' => 'Swarthmore College'],
            ['name' => 'The University of Texas at Dallas'],
            ['name' => 'Tufts University'],
            ['name' => 'United States Military Academy'],
            ['name' => 'University of Arizona'],
            ['name' => 'University of California-Berkeley'],
            ['name' => 'University of California-Davis'],
            ['name' => 'University of California-Irvine'],
            ['name' => 'University of California-Los Angeles'],
            ['name' => 'University of California-Merced'],
            ['name' => 'University of California-San Diego'],
            ['name' => 'University of California-Santa Cruz'],
            ['name' => 'University of Connecticut'],
            ['name' => 'University of Delaware'],
            ['name' => 'University of Evansville'],
            ['name' => 'University of Georgia'],
            ['name' => 'University of Memphis'],
            ['name' => 'University of Michigan-Ann Arbor'],
            ['name' => 'University of Pennsylvania'],
            ['name' => 'University of Richmond'],
            ['name' => 'University of Rochester'],
            ['name' => 'University of Southern California'],
            ['name' => 'University of Virginia'],
            ['name' => 'University of Wisconsin-Stout'],
            ['name' => 'Vanderbilt University'],
            ['name' => 'Vassar College'],
            ['name' => 'Whitman College'],
            ['name' => 'Yale University'],
        ];

        foreach($a as $uni) {
            University::firstOrCreate($uni);
        }
    }
}
