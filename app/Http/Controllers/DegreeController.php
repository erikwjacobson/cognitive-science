<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseType;
use App\Degree;
use App\Department;
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
    public function create()
    {
        return view('degrees.create');
    }

    /**
     * Store the degree and all associated information
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $university = University::firstOrCreate([
           'name' => $request['institution-name'],
        ], ['details' => $request['details']]);

        $department = Department::firstOrCreate([
            'name' => $request['department-name']
        ]);

        $degree = Degree::create([
            'name' => $request['degree-name'],
            'minor' => $request['degree-minor'],
            'concentration' => $request['degree-concentration'],
            'degree_credits' => $request['degree-credits'],
            'major_credits' => $request['major-credits'],
            'prereq_credits' => $request['prereq-credits'],
            'elective_credits' => $request['elective-credits'],
            'gened_credits' => $request['gened-credits'],
            'university_id' => $university->id,
            'department_id' => $department->id,
        ]);

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
        return view('degrees.edit', compact('degree'));
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
        $university = $degree->university;
        $university->name = $request['institution-name'];
        $university->details = $request['details'];

        $department = Department::firstOrCreate([
            'name' => $request['department-name']
        ]);

        $degree->name = $request['degree-name'];
        $degree->minor = $request['degree-minor'];
        $degree->concentration = $request['degree-concentration'];
        $degree->degree_credits = $request['degree-credits'];
        $degree->major_credits = $request['major-credits'];
        $degree->prereq_credits = $request['prereq-credits'];
        $degree->elective_credits = $request['elective-credits'];
        $degree->gened_credits = $request['gened-credits'];
        $degree->university_id = $university->id;
        $degree->department_id = $department->id;
        $degree->save();

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
        $department = Department::firstOrCreate([
            'name' => $request->department
        ]);

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

