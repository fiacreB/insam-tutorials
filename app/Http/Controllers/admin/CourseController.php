<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseController extends Controller
{

    function index()
    {
        $lessons = Lesson::all();
        $courses = Course::orderBy('created_at', 'desc')->paginate(10);
        $user = Auth::user()->id;
        $catego = Category::with('courses')->first();
        return view('dashboard.admin.courses.index', ['courses' => $courses], compact('lessons', 'user', 'catego'));
    }

    function create(Category $category)
    {
        return view('dashboard.admin.courses.create', ['category' => $category]);
    }
    public function store(Request $request, Category $category, Course $course)
    {
        $request->validate([
            'title' => 'required|string',
            //'description' => 'string',
            //'image' => 'required',
        ]);

        $image_path = "rien";

        if ($request->has('image')) {
            $filename = rand() . '.' . $request->image->extension();
            $image_path = $request->image->storeAs(
                "categories",
                $filename,
                'public'
            );
        }


        $slug = Str::slug($request->title, '-');
        Course::create([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $image_path,
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);
        return redirect()->route('admin.categories.show', ['category' => $category->slug])->with('success', 'Cours créer avec succès');
    }
    function allCreate()
    {
        $categories = Category::all();
        $user = Auth::user()->id;
        return view('dashboard.admin.courses.all-create', compact('categories', 'user'));
    }


    public function allStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'category_id' => 'required'
            //'description' => 'string',
            //'image' => 'required',
        ]);

        $image_path = null;

        if ($request->has('image')) {
            $filename = rand() . '.' . $request->image->extension();
            $image_path = $request->image->storeAs(
                "courses",
                $filename,
                'public'
            );
        }


        $slug = Str::slug($request->title, '-');
        Course::create([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $image_path ?: "Rien",
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);
        $category = Category::where('id', $request->category_id)->first();

        return redirect()->route('admin.courses.index')->with('success', 'Cours créer avec succès');
        // return redirect()->route('admin.categories.show', ['category' => $category->slug]);
    }


    public function show(Course $course)
    {
        $chapters = Chapter::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.admin.courses.show-chapitre', compact('course', 'chapters'));
    }

    public function edit(Course $course, Category $category)
    {
        $categories = Category::all();
        return view('dashboard.admin.courses.edit', compact('course', 'category', 'categories'));
    }

    public function update(Request $request, Course $course)
    {


        if ($request->has('image')) {
            $slug = Str::slug($request->title, '-');
            $filename = rand() . '.' . $request->image->extension();
            $image_path = $request->image->storeAs(
                "categories",
                $filename,
                'public'
            );

            $course->fill([
                'title' => $request->title,
                'slug' => $slug,
                'image' => $image_path,

                'description' => $request->description,
            ]);
            $course->save();
        } else {

            $slug = Str::slug($request->title, '-');
            $course->fill([
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'category_id' => $request->category_id
            ]);
            $course->save();
        }
        $courses = Course::all();

        $category = Category::where('id', $request->category_id)->first();
        return redirect()->route('admin.categories.show', ['category' => $category->slug])->with('success', 'Cours mis a jour avec succès');
    }

    public function deletecourse(Course $course, Category $category)
    {
        $course->delete();

        return back()->with('success', 'Success');
    }
}
