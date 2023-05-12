<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\ExamAttempt;
use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     // return LessonResource::collection(Lesson::all());
    // }
    public function index(Lesson $lesson, Chapter $chapter)
    {


        // $chapters = Chapter::all();
        // $lessons = Lesson::all();
        $categories = Category::limit(10)->get();
        $courses = Course::paginate(20);
        $new_courses = Course::limit(10)->get();

        return view('frontend.lessons.index', compact('courses', 'categories', 'new_courses'));
    }

    public function find(Request $request)
    {
        $categories = Category::limit(10)->get();

        $courses = Course::where('title', 'LIKE', '%' . $request->title . '%')->paginate(20);

        return view('frontend.lessons.index', compact('courses', 'categories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Chapter $chapter)
    {
        return view('admin.lessons.create', compact('chapter'));
    }

    public function createlien(Chapter $chapter)
    {
        return view('admin.lessons.lien', compact('chapter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Chapter $chapter)
    {

        $request->validate([
            'videos'        => 'required'
        ]);
        foreach ($request->videos as $key => $video) {
            $title =
                $title = explode('.', str_replace(' ', '_', $video->getClientOriginalName()))[0];
            $filename_video = $title . '.' . $video->extension();
            $video_path = $video->storeAs(
                "cours/" . $title,
                $filename_video,
                'public'
            );
            $slug = Str::slug($video_path, '-');

            Lesson::create([
                'title'        => explode('.', $video->getClientOriginalName())[0],
                'slug' =>  $slug,

                'chapter_id'    => $chapter->id,
                'video_path' => $video_path,
                'visits' => 0
            ]);
        }
        return redirect()->route('admin.lessons.create', $chapter->slug);
    }

    public function storelink(Request $request, Chapter $chapter)
    {
        $slug = Str::slug($request->title, '-');

        Lesson::create([
            'title'        => $request->title,
            'description' => $request->editor,
            'slug' => $slug,
            'chapter_id'    => $chapter->id,
            'video_provider' => $request->video_provider,
            'video_link' => $request->video_link,
        ]);
        return redirect()->route('admin.lessons.createlien', $chapter->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {

    //     $chapter = chapter::find($id);


    //     $lessons = lessons::where('chapters_lessons_id', $chapter->id)->get();

    //     return view('layout-frontend.lessons.show', compact('lessons', 'chapter'));
    // }

    public function show(Category $category, Chapter $chapter, $id)
    {

        $categories = Category::all();

        $chapters = Chapter::all();
        $chapter = Chapter::find($id);
        // $lessons = lessons::all();
        $lessons = Lesson::where('chapter_id', $chapter->id)->get();
        $questions = Question::with('answers')->get();
        $attempts = ExamAttempt::where('user_id', Auth()->user()->id)->with('chapter')->orderBy('updated_at')->get();

        return view('frontend.lessons.show', compact('chapter', 'categories', 'attempts', 'questions', 'category', 'chapters', 'lessons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        return view('admin.lessons.edit', compact('lesson'));
    }

    public function update(Request $request, Lesson $lesson, Chapter $chapter)
    {

        $request->validate([
            'title'        => 'required|string',
            'description'        => 'required|string',
            'video_provider' => 'string',
            'video_link' => 'string',
        ]);
        $slug = Str::slug($request->title, '-');

        $lesson->fill([
            'title'        => $request->title,
            'slug' => $slug,
            'description'        => $request->description,
            'video_provider' => $request->video_provider,
            'video_link' => $request->video_link,
        ]);
        $lesson->save();
        return redirect()->route('admin.chapters.show',  $lesson->chapter->slug);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $id = $lesson->chapter_id;
        $lesson->delete();
        return back();
    }

    public function search(Request $request, $search)

    {
        $categories = Category::all();

        $chapters = Chapter::all();

        $lessons = Lesson::all();
        $videos = Lesson::where('title', 'LIKE', '%' . $search . '%')->get();
        return view('frontend.pages.search', compact('videos', 'search', 'chapters', 'lessons', 'categories'));
    }

    public function getVideo(Request $request, $id)
    {
        $video = Lesson::find($id);
        return Storage::download($video->video_path);
    }


    public function videos(Chapter $chapter, Lesson $lesson, Category $category)
    {
        $categories = Category::all();

        $chapters = Chapter::all();


        $lessons = Lesson::all();
        $attempts = ExamAttempt::where('user_id', Auth()->user()->id)->with('chapter')->orderBy('updated_at')->get();

        return view('frontend.categories.videos', compact('chapter', 'lesson', 'categories', 'chapters', 'lessons', 'category', 'attempts'));
    }
    public function resume(Chapter $chapter, Category $category, Lesson $lesson)
    {
        $categories = Category::all();

        $chapters = Chapter::all();

        $lessons = Lesson::all();
        $attempts = ExamAttempt::with('chapter')->orderBy('updated_at')->get();

        return view('frontend.categories.resume', compact('attempts', 'chapter', 'categories', 'chapters', 'lesson', 'lessons', 'category'));
    }
}
