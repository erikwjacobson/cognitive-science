<?php

namespace App\Http\Controllers\api;

use App\Course;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DegreeController extends Controller
{
    /**
     * Get Courses
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getCourses()
    {
        $courses = CourseResource::collection(Course::all());

        return $courses;
    }
}
