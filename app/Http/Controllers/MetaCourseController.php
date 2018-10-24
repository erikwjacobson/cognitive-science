<?php

namespace App\Http\Controllers;

use App\MetaCourse;
use Illuminate\Http\Request;

class MetaCourseController extends Controller
{
    /**
     * Index of Degrees
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $metaCourses = MetaCourse::all();
        return view('meta-courses.index', compact('metaCourses'));
    }
}
