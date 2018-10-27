<?php

namespace App\Http\Controllers;

use App\Degree;
use App\Department;
use App\Http\Requests\CreateDegreeRequest;
use App\University;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    /**
     * Index of Degrees
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $degrees = Degree::all();
        return view('degrees.index', compact('degrees'));
    }

    /**
     * Create Page of Degrees
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $states = [ "AK" => "Alaska", "AL" => "Alabama", "AR" => "Arkansas", "AS" => "American Samoa", "AZ" => "Arizona",
            "CA" => "California", "CO" => "Colorado", "CT" => "Connecticut", "DC" => "District of Columbia",
            "DE" => "Delaware", "FL" => "Florida", "GA" => "Georgia", "GU" => "Guam", "HI" => "Hawaii",
            "IA" => "Iowa", "ID" => "Idaho", "IL" => "Illinois", "IN" => "Indiana", "KS" => "Kansas", "KY" => "Kentucky",
            "LA" => "Louisiana", "MA" => "Massachusetts", "MD" => "Maryland", "ME" => "Maine", "MI" => "Michigan",
            "MN" => "Minnesota", "MO" => "Missouri", "MS" => "Mississippi", "MT" => "Montana", "NC" => "North Carolina",
            "ND" => "North Dakota", "NE" => "Nebraska", "NH" => "New Hampshire", "NJ" => "New Jersey", "NM" => "New Mexico",
            "NV" => "Nevada", "NY" => "New York", "OH" => "Ohio", "OK" => "Oklahoma", "OR" => "Oregon", "PA" => "Pennsylvania",
            "PR" => "Puerto Rico", "RI" => "Rhode Island", "SC" => "South Carolina", "SD" => "South Dakota",
            "TN" => "Tennessee", "TX" => "Texas", "UT" => "Utah", "VA" => "Virginia", "VI" => "Virgin Islands", "VT" => "Vermont",
            "WA" => "Washington", "WI" => "Wisconsin", "WV" => "West Virginia", "WY" => "Wyoming"];

        return view('degrees.create', compact('states'));
    }

    /**
     * Store the degree and all associated information
     * @param CreateDegreeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateDegreeRequest $request)
    {
        $university = University::create([
           'IPED' => $request['IPED'],
           'first_report' => $request['first-report'],
           'name' => $request['institution-name'],
           'city' => $request['city'],
           'state' => $request['state'],
           'website' => $request['website'],
           'details' => empty($request['details']) ? null : $request['details'],
        ]);

        $department = Department::firstOrCreate([
            'name' => $request['department-name']
        ]);

        $degree = Degree::create([
            'name' => $request['degree-name'],
            'minor' => empty($request['degree-minor']) ? null : $request['degree-minor'],
            'concentration' => empty($request['degree-concentration']) ? null : $request['degree-concentration'],
            'university_id' => $university->id,
            'department_id' => $department->id,
        ]);

        return redirect()->route('degree.index');
    }
}
