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

    public function find(Request $request)
    {

        $new_categories = Category::limit(10)->orderBy('created_at', 'desc')->get();
        $new_courses = Course::limit(10)->orderBy('created_at', 'desc')->get();


        $categories = Category::where('title', 'LIKE', '%' . $request->title . '%')->paginate(20);

        return view('frontend.categories.index', compact('categories', 'new_categories', 'new_courses'));
    }

    public function index(Category $category, Chapter $chapter)
    {
        $chapters = Chapter::all();
        $lesson = Lesson::all();

        $new_categories = Category::limit(10)->orderBy('created_at', 'desc')->get();
        $new_courses = Course::limit(10)->orderBy('created_at', 'desc')->get();

        $categories = Category::paginate(20);
        return view('frontend.categories.index', compact('chapter', 'category', 'categories', 'chapters', 'lesson', 'new_categories', 'new_courses'));
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

        $user_id = Auth::user() ? Auth::user()->id : 0;
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
        $courses = Course::where('category_id', $category->id)->paginate(20);
        $categories = Category::limit(10)->orderBy("created_at", 'desc')->get();
        $new_courses = Course::limit(10)->orderBy("created_at", "desc")->get();

        return view('frontend.categories.showcourse', compact('courses', 'category', 'categories', 'new_courses'));
    }
}
