<?php

namespace App\Http\Controllers;

use App\Degree;
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
}
