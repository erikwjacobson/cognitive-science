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


    public function store(Request $request)
    {
        $department = Department::findOrFail($request->department);

        $metaCourse = MetaCourse::firstOrCreate([
            'title' => $request->title,
            'code' => $request->code,
            'number' => $request->number,
            'credits' => $request->credits,
            'department_id' => $department->id,
            'course_type_id' => $request->type,
            'requirement_score' => $request->score,
            'notes' => $request->notes
        ]);

        $metaCourse->courses()->sync($request->courses);

        return redirect()->route('meta-course.index');
    }
}

