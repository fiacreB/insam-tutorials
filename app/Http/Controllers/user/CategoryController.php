<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\ExamAttempt;
use App\Models\Chapter;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoriesAll(Category $category, Chapter $chapter)
    {
        $categories = Category::all();
        $chapters = Chapter::all();
        $lesson = Lesson::all();
        return view('frontend.categories.index', compact('chapter', 'category', 'categories', 'chapters', 'lesson'));
    }

    public function index(Category $category, Chapter $chapter)
    {
        $categories = Category::all();
        $chapters = Chapter::all();
        $lesson = Lesson::all();
        return view('frontend.categories.index', compact('chapter', 'category', 'categories', 'chapters', 'lesson'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $categories = Category::all();
        $chapters = Chapter::all();
        

        $lesson = Lesson::all();
        $questions = Question::with('answers')->get();
        $courses = Course::all();

        $user_id = Auth::user()? Auth::user()->id: 0; 
        $attempts = ExamAttempt::where('user_id', $user_id)->with('chapter')->orderBy('updated_at')->get();

        return view('frontend.categories.show', compact('courses', 'category', 'categories',  'courses', 'attempts', 'questions', 'chapters', 'lesson'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function showcourse(Category $category)
    {
        $courses = Course::where('category_id', $category->id)->get();

        return view('frontend.categories.showcourse', compact('courses', 'category'));
    }
}
