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
        return view('degrees.create', compact('departments', 'degreeTypes', 'universities'));
    }

    /**
     * Store the degree and all associated information
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//        return explode(" - ", $request['degree-credits'])[1];
        $university = University::findOrFail($request->institution);

        // Create the degree
        $degree = Degree::create([
            'name' => $request['degree-name'],
            'minor' => $request['degree-minor'],
            'concentration' => $request['degree-concentration'],
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

        // Sync all of the housed departments
        $housed_departments = Department::whereIn('id', $request->housed_departments)->get();
        $housed = [];
        foreach($housed_departments as $dept){
            $housed[$dept->id] = ['department_type' => 'housed'];
        }
        $degree->departments()->sync($housed);

        // If there are contributing departments, sync them
        if($request->contributing_departments) {
            $contributing_departments = Department::whereIn('id', $request->contributing_departments)->get();
            $contributing = [];
            foreach($contributing_departments as $dept){
                $contributing[$dept->id] = ['department_type' => 'contributing'];
            }
            $degree->departments()->sync($contributing);
        }

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
        $degreeTypes = DegreeType::all();
        $universities = University::all();
        return view('degrees.edit', compact('degree', 'departments', 'degreeTypes', 'universities'));
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
        $departments = Department::whereIn('id', $request->departments)->get();
        $degreeTypes = DegreeType::whereIn('id', $request->degreeTypes)->get();

        $degree->name = $request['degree-name'];
        $degree->minor = $request['degree-minor'];
        $degree->concentration = $request['degree-concentration'];
        $degree->degree_credits = $request['degree-credits'];
        $degree->major_credits = $request['major-credits'];
        $degree->prereq_credits = $request['prereq-credits'];
        $degree->elective_credits = $request['elective-credits'];
        $degree->gened_credits = $request['gened-credits'];
        $degree->university_id = $university->id;
        $degree->save();

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
        return view('degrees.courses', compact('degree', 'courseTypes', 'departments', 'courses'));
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
        $department = Department::findOrFail($request->department);

        $course = Course::firstOrCreate([
            'title' => $request->title,
            'code' => $request->code,
            'number' => $request->number,
            'credits' => $request->credits,
            'department_id' => $department->id,
            'course_type_id' => $request->course_type,
            'degree_id' => $degree->id,
            'standardized_title' => $request->standard_title,
            'requirement_score' => $request->requirement_score,
            'notes' => $request->notes
        ]);

        return response($course, 200);
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

