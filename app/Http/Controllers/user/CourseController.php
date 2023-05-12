<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\Lesson;
use App\Models\ExamAttempt;
use App\Models\Chapter;
use App\Models\Question;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function courseAll(Course $course, Lesson $cours)
    {
        $courses = Course::all();
        return view('frontend.course.index', compact('chapter', 'category', 'courses', 'chapters', 'cours'));
    }

    public function index()
    {
        // $chapter = Chapter::where('id', $id)->first();
        // $courses = Course::where('chapter_id', $id)->get();;
        // $cours = null;


        // if (!empty($courses) != 1) {
        //     $cours = Lesson::where('course_id', $courses[0]->id)->first();
        // }

        $courses = $lessons =  Course::all();

        return view('frontend.lessons.index', compact('courses', 'lessons'));
        // return view('layout-frontend.course.index', compact('courses', 'cours', 'chapter'));

    }

    public function show(Request $request, Course $course)
    {

        $chapters = Chapter::where('course_id', $course->id)->get();


        $attempts = ExamAttempt::with('chapter')->orderBy('updated_at')->get();


        return view('frontend.course.index', compact('course', 'chapters', 'attempts'));
    }
    // public function show(Course $course){
    //     return view('layout-frontend.categories.videos', compact('course'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Category $category, Course $course)

    {


        return view('admin.course.create', compact('category', 'course'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\course  $category
     * @return \Illuminate\Http\Response
     */
    public function adminShow(Course $course, Category $category)

    {

        return view('admin.course.show', compact('course'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $cours
     * @return \Illuminate\Http\Response
     *
     */
    public function deletecourse(Request $request)
    {
        try {
            Course::where('id', $request->id)->delete();
            return response()->json(['success' => true, 'msg' => 'cours supprimer avec succes!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'string',
            'image' => 'required',
        ]);
        foreach ($request->image as $key => $image) {
            $title =
                $title = explode('.', str_replace(' ', '_', $image->getClientOriginalName()))[0];
            $filename_image = $title . '.' . $image->extension();
            $img_path = $image->storeAs(
                "cours/" . $title,
                $filename_image,
                'public'
            );


            Category::create([
                'title' => $request->title,
                'description' => $request->description,
                'img_path' => $img_path,
            ]);
        }

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    // public function show(Category $category, Chapter $chapter)
    // {

    //     $categories = Category::all();

    //     $chapters = Chapter::all();

    //     $cours = Lesson::all();
    //     $questions = Question::with('answers')->get();
    //     $attempts = ExamAttempt::where('user_id', Auth()->user()->id)->with('chapter')->orderBy('updated_at')->get();

    //     return view('layout-frontend.categories.show', compact('chapter', 'categories', 'attempts', 'questions', 'category', 'chapters', 'cours'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response
     */


    // public function show(Category $category, course $course)

    // {
    //     $questions = Question::with('answers')->get();

    //     return view('layout-frontend.categories.show', compact('category', 'questions', 'course'));
    // }

    /* @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $request->validate([
            'title' => 'required|string',
            'description' => 'string',
        ]);
        $category->fill([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $category->save();
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }






    public function adminIndex()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }
}
