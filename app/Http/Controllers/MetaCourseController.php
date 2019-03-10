<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseType;
use App\Department;
use App\MetaCourse;
use Illuminate\Http\Request;

class MetaCourseController extends Controller
{
    /**
     * Index of Meta Courses
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $metaCourses = MetaCourse::with('courses')->get();
        return view('meta-courses.index', compact('metaCourses'));
    }

    /**
     * Create of Meta Courses
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $courseTypes = CourseType::all();
        $courses = Course::with('degree.university')->get();
        $departments = Department::all();
        $courseDepartments = $departments->whereIn('id', $courses->pluck('department_id'));

        return view('meta-courses.create', compact('courseTypes', 'courses', 'departments', 'courseDepartments'));
    }

    /**
     * Creates an instance of a meta course in the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $department = Department::findOrFail($request->department);

        $metaCourse = MetaCourse::firstOrCreate([
            'title' => $request->title,
            'code' => $request->code,
            'number' => $request->number,
            'credits_min' => explode(' - ', $request->credits)[0],
            'credits_max' => explode(' - ', $request->credits)[1],
            'department_id' => $department->id,
            'course_type_id' => $request->type,
            'requirement_score' => $request->score,
            'notes' => $request->notes
        ]);

        $metaCourse->courses()->sync($request->courses);

        return redirect()->route('meta-course.index');
    }

    /**
     * Returns the edit view for the meta courses
     * @param MetaCourse $metaCourse
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(MetaCourse $metaCourse)
    {
        $departments = Department::all();
        $courseTypes = CourseType::all();
        $courses = Course::with('degree.university')->get();
        $courseDepartments = $departments->whereIn('id', $courses->pluck('department_id'));
        $metaCourseCourses = $courses->whereIn('id', $metaCourse->courses()->pluck('course_id'));

        return view('meta-courses.edit', compact('metaCourse', 'departments', 'courseTypes', 'courses', 'courseDepartments', 'metaCourseCourses'));
    }

    public function update(Request $request, MetaCourse $metaCourse)
    {
        $department = Department::findOrFail($request->department);

        $metaCourse->title = $request->title;
        $metaCourse->code = $request->code ;
        $metaCourse->number= $request->number;
        $metaCourse->credits = $request->credits;
        $metaCourse->department_id = $department->id;
        $metaCourse->course_type_id = $request->type;
        $metaCourse->requirement_score = $request->score;
        $metaCourse->notes = $request->notes;

        $metaCourse->courses()->sync($request->courses);
        $metaCourse->save();

        return redirect()->route('meta-course.index');
    }
}

