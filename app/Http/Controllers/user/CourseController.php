<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('frontend.courses.index', compact('courses'));
    }

    public function show($slug)
    {
        $course = Course::where("slug", $slug)->first();

        $lessons = $course->lessons();
        return view('frontend.courses.show', compact('course', 'lessons'));
    }
}
