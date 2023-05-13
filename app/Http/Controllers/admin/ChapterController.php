<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Chapter;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Course;
use App\Models\Exam;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $courses = Course::all();
        $chapters = Chapter::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.admin.chapters.index', compact('chapters', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course, Chapter $chapter): View
    {
        return view('dashboard.admin.chapters.create', compact('course', 'chapter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
        $slug = Str::slug($request->title, '-');
        try {

            if ($request->has('course_id')) {
                $course = Course::where('id', $request->course_id)->first();
            }
            Chapter::create([
                'title' => $request->title,
                'slug' => $slug,
                'first' => $request->first,
                'description' => $request->description,
                'course_id'    => $course->id,

            ]);
            return response()->json(['success' => false, 'msg' => 'chapter ajouter avec succes!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chapter  $course
     * @return \Illuminate\Http\Response
     */
    public function adminShow(Chapter $chapter, Course $course): view
    {
        $lessons = Lesson::orderBy('created_at', 'desc')->paginate(12);
        return view('dashboard.admin.chapters.show', compact('chapter', 'lessons'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $lessons
     * @return \Illuminate\Http\Response
     *
     */
    public function deletechapter(Request $request)
    {
        try {
            chapter::where('id', $request->id)->delete();
            return response()->json(['success' => true, 'msg' => 'chapter supprimer avec succes!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $slug = Str::slug($request->title, '-');

        try {
            $chapter =  Chapter::find($request->id);
            $chapter->title = $request->title;
            $chapter->first = $request->first;
            $chapter->slug = $slug;
            $chapter->description = $request->description;
            $chapter->save();

            return response()->json(['success' => true, 'msg' => 'chapter mis à jour avec succes!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function show(Course $course, Chapter $chapter)

    {
        $questions = Question::with('answers')->get();

        return view('layout-frontend.categories.show', compact('course', 'questions', 'chapter'));
    }
}
