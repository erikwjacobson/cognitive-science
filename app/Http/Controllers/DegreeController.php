<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseType;
use App\Degree;
use App\DegreeType;
use App\Department;
use App\University;
use Illuminate\Http\Request;
use PHPUnit\Framework\UnintentionallyCoveredCodeError;

class DegreeController extends Controller
{
    public $catalogYears = [
        '2010-2011'=> '2010-2011',
        '2011-2012'=> '2011-2012',
        '2012-2013'=> '2012-2013',
        '2013-2014'=> '2013-2014',
        '2014-2015'=> '2014-2015',
        '2015-2016'=> '2015-2016',
        '2016-2017'=> '2016-2017',
        '2017-2018'=> '2017-2018',
        '2018-2019'=> '2018-2019',
        '2019-2020'=> '2019-2020',
        '2020-2021'=> '2020-2021',
        '2021-2022'=> '2021-2022',
        '2022-2023'=> '2022-2023'
    ];

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
    public function create()
    {
        $departments = Department::all();
        $degreeTypes = DegreeType::all();
        $universities = University::all();
        $catalogYears = $this->catalogYears;
        return view('degrees.create', compact('departments', 'degreeTypes', 'universities', 'catalogYears'));
    }

    /**
     * Store the degree and all associated information
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'degree-name' => 'required',
            'housed_departments' => 'required',
            'degreeTypes' => 'required'
        ]);
        
        $university = University::findOrFail($request->institution);

        // Create the degree
        $degree = Degree::create([
            'name' => $request['degree-name'],
            'minor' => $request['degree-minor'],
            'concentration' => $request['degree-concentration'],
            'catalog_year' => $request['catalog-year'],
            'notes' => $request['notes'],
            'degree_credits_min' => explode(" - ", $request['degree-credits'])[0],
            'degree_credits_max' => explode(" - ", $request['degree-credits'])[1],
            'major_credits_min' => explode(" - ", $request['major-credits'])[0],
            'major_credits_max' => explode(" - ", $request['major-credits'])[1],
            'prereq_credits_min' => explode(" - ", $request['prereq-credits'])[0],
            'prereq_credits_max' => explode(" - ", $request['prereq-credits'])[1],
            'elective_credits_min' => explode(" - ", $request['elective-credits'])[0],
            'elective_credits_max' => explode(" - ", $request['elective-credits'])[1],
            'gened_credits_min' => explode(" - ", $request['gened-credits'])[0],
            'gened_credits_max' => explode(" - ", $request['gened-credits'])[1],
            'university_id' => $university->id,
        ]);
        $degree->save();

        $departments = [];
        // Sync all of the housed departments
        $housed_departments = Department::whereIn('id', $request->housed_departments)->get();
        foreach($housed_departments as $dept){
            $departments[$dept->id] = ['department_type' => 'housed'];
        }
        // If there are contributing departments, sync them
        if($request->contributing_departments) {
            $contributing_departments = Department::whereIn('id', $request->contributing_departments)->get();
            foreach($contributing_departments as $dept){
                $departments[$dept->id] = ['department_type' => 'contributing'];
            }
        }
        $degree->departments()->sync($departments);

        // Sync the degree types
        $degreeTypes = DegreeType::whereIn('id', $request->degreeTypes)->get();
        $degree->degreeTypes()->sync($degreeTypes);

        return redirect()->route('degree.courses', $degree);
    }

    /**
     * Edit the degree
     *
     * @param Degree $degree
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Degree $degree)
    {
        $departments = Department::all();
        $contributing = $degree->departments()->wherePivot('department_type', 'contributing')->get();
        $housed = $degree->departments()->wherePivot('department_type', 'housed')->get();

        $degreeTypes = DegreeType::all();
        $universities = University::all();
        $catalogYears = $this->catalogYears;
        return view('degrees.edit', compact('degree', 'departments', 'degreeTypes', 'universities', 'contributing','housed', 'catalogYears'));
    }

    /**
     * Update the degree
     *
     * @param Degree $degree
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Degree $degree, Request $request)
    {
        $university = University::findOrFail($request['institution']);
        $degreeTypes = DegreeType::whereIn('id', $request->degreeTypes)->get();

        $degree->name = $request['degree-name'];
        $degree->minor = $request['degree-minor'];
        $degree->catalog_year = $request['catalog-year'];
        $degree->concentration = $request['degree-concentration'];
        $degree->degree_credits_min = explode(" - ", $request['degree-credits'])[0];
        $degree->degree_credits_max = explode(" - ", $request['degree-credits'])[1];
        $degree->major_credits_min = explode(" - ", $request['major-credits'])[0];
        $degree->major_credits_max = explode(" - ", $request['major-credits'])[1];
        $degree->prereq_credits_min = explode(" - ", $request['prereq-credits'])[0];
        $degree->prereq_credits_max = explode(" - ", $request['prereq-credits'])[1];
        $degree->elective_credits_min = explode(" - ", $request['elective-credits'])[0];
        $degree->elective_credits_max = explode(" - ", $request['elective-credits'])[1];
        $degree->gened_credits_min = explode(" - ", $request['gened-credits'])[0];
        $degree->gened_credits_max = explode(" - ", $request['gened-credits'])[1];
        $degree->university_id = $university->id;
        $degree->notes = $request['notes'];
        $degree->save();

        $departments = [];
        // Sync all of the housed departments
        $housed_departments = Department::whereIn('id', $request->housed_departments)->get();
        foreach($housed_departments as $dept){
            $departments[$dept->id] = ['department_type' => 'housed'];
        }
        // If there are contributing departments, sync them
        if($request->contributing_departments) {
            $contributing_departments = Department::whereIn('id', $request->contributing_departments)->get();
            foreach($contributing_departments as $dept){
                $departments[$dept->id] = ['department_type' => 'contributing'];
            }
        }
        $degree->departments()->sync($departments);
        $degree->degreeTypes()->sync($degreeTypes);

        return redirect()->back();
    }

    /**
     * Displays courses view
     * @param Degree $degree
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courses(Degree $degree)
    {
        $courseTypes = CourseType::all();
        $departments = Department::all();
        $courses = $degree->courses()->orderBy('created_at', 'DESC')->get();
        $catalogYears = $this->catalogYears;
        return view('degrees.courses', compact('degree', 'courseTypes', 'departments', 'courses', 'catalogYears'));
    }

    /**
     * Displays edit course view
     * @param Degree $degree
     * @param Course $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editCourse(Degree $degree, Course $course)
    {
        $courseTypes = CourseType::all();
        $departments = Department::all();
        $catalogYears = $this->catalogYears;
        return view('degrees.courses.edit', compact('degree', 'courseTypes', 'departments', 'course', 'catalogYears'));
    }
    
    /**
     * Update an existing course
     * 
     * @param Degree $degree
     * @param Course $course
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function updateCourse(Degree $degree, Course $course, Request $request) 
    {

        $request->validate([
            'title' => 'required',
            'code' => 'required',
            'number' => 'required',
            'department' => 'required',
            'required' => 'required',
            'methodology' => 'required',
            'subgroup' => 'required|numeric',
            'group' => 'required|numeric'
        ]);

        $department = Department::findOrFail($request->department);

        $requirement_score = $request->subgroup != 0 || $request->group != 0 ? $request->subgroup / $request->group : 0;

        $course->title = $request->title;
        $course->code = $request->code;
        $course->number = $request->number;
        $course->catalog_year = $request->catalog_year;
        $course->credits_min = explode(' - ', $request->credits)[0];
        $course->credits_max = explode(' - ', $request->credits)[1];
        $course->department_id = $department->id;
        $course->course_type_id = $request->course_type;
        $course->degree_id = $degree->id;
        $course->standardized_title = $request->standard_title;
        $course->requirement_score = $requirement_score;
        $course->subgroup = $request->subgroup;
        $course->group = $request->group;
        $course->notes = $request->notes;
        $course->required = (int) $request->required;
        $course->methodology = (int) $request->methodology;


        $course->save();

        return redirect()->route('degree.courses', $degree);
    }

    /**
     * Store courses
     *
     * @param Degree $degree
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function storeCourse(Degree $degree, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'code' => 'required',
            'number' => 'required',
            'department' => 'required',
            'required' => 'required',
            'methodology' => 'required'
        ]);

        $department = Department::findOrFail($request->department);

        $requirement_score = $request->subgroup != 0 || $request->group != 0 ? $request->subgroup / $request->group : 0;

        $course = Course::firstOrCreate([
            'title' => $request->title,
            'code' => $request->code,
            'number' => $request->number,
            'catalog_year' => $request->catalog_year,
            'credits_min' => explode(' - ', $request->credits)[0],
            'credits_max' => explode(' - ', $request->credits)[1],
            'department_id' => $department->id,
            'course_type_id' => $request->course_type,
            'degree_id' => $degree->id,
            'standardized_title' => $request->standard_title,
            'requirement_score' => $requirement_score,
            'subgroup' => $request->subgroup,
            'group' => $request->group,
            'notes' => $request->notes,
            'required' => (int) $request->required,
            'methodology' => (int) $request->methodology
        ]);

        return redirect()->back();
    }


    public function deleteCourse(Degree $degree, Course $course, Request $request)
    {
        try {
            $course->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Cannot delete this course because it is a part of a meta course. Please delete the meta course before proceeding.');
        }

        return redirect()->back();
    }
}

