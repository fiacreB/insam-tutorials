<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\ExamAttempt;
use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

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
        $chapters = Chapter::all();
        $lessons = Lesson::all();
        return view('frontend.course.index', compact('chapter', 'chapters', 'lessons'));
    }

    public function allVideos()
    {
        $lessons = Lesson::orderBy('created_at', 'desc')->paginate(12);
        $chapter = Chapter::with('lessons')->first();
        return view('dashboard.admin.lessons.index', compact('lessons', 'chapter'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Chapter $chapter): View
    {
        return view('dashboard.admin.lessons.create', compact('chapter'));
    }
    public function allCreate(Chapter $chapter): View
    {
        $chapters = Chapter::all();
        return view('dashboard.admin.lessons.all-create', compact('chapter', 'chapters'));
    }

    public function createlien(Chapter $chapter)
    {
        return view('dashboard.admin.lessons.lien', compact('chapter'));
    }

    public function allCreateLien(Chapter $chapter)
    {
        $chapters = Chapter::all();
        return view('dashboard.admin.lessons.all-lien', compact('chapter', 'chapters'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Chapter $chapter): RedirectResponse
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
            if ($request->has('chapter_id')) {
                $chapter = Chapter::where('id', $request->chapter_id)->first();
            }
            $slug = Str::slug($video_path, '-');

            Lesson::create([
                'title'        => explode('.', $video->getClientOriginalName())[0],
                'slug' =>  $slug,

                'chapter_id'    => $chapter->id,
                'video_path' => $video_path,
                'visits' => 0
            ]);
        }
        return back()->with('success', 'video créér avec succès');
    }

    public function storelink(Request $request, Chapter $chapter)
    {
        $slug = Str::slug($request->title, '-');
        if ($request->has('chapter_id')) {
            $chapter = Chapter::where('id', $request->chapter_id)->first();
        }
        Lesson::create([
            'title'        => $request->title,
            'description' => $request->editor,
            'slug' => $slug,
            'chapter_id'    => $chapter->id,
            'video_provider' => $request->video_provider,
            'video_link' => $request->video_link,
        ]);
        return back()->with('success', 'video créér avec succès');
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

        return view('layout-frontend.lessons.show', compact('chapter', 'categories', 'attempts', 'questions', 'category', 'chapters', 'lessons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson): View
    {
        $chapters = Chapter::all();
        return view('dashboard.admin.lessons.edit', compact('lesson', 'chapters'));
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
            'chapter_id' => $request->chapter_id,
            'description'        => $request->description,
            'video_provider' => $request->video_provider,
            'video_link' => $request->video_link,
        ]);
        $lesson->save();
        return redirect()->route('admin.chapters.show',  $lesson->chapter->slug)->with('success', 'video mis à jour avec succès');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson): RedirectResponse
    {
        $id = $lesson->chapter_id;
        $lesson->delete();
        return back()->with('success', 'Deleted success');
    }

    public function search(Request $request, $search)
    {
        $categories = Category::all();

        $chapters = Chapter::all();

        $lessons = Lesson::all();
        $videos = Lesson::where('title', 'LIKE', '%' . $search . '%')->get();
        return view('layout-frontend.pages.search', compact('videos', 'search', 'chapters', 'lessons', 'categories'));
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
        return view('layout-frontend.categories.videos', compact('chapter', 'lesson', 'categories', 'chapters', 'lessons', 'category', 'attempts'));
    }
    public function resume(Chapter $chapter, Category $category, Lesson $lesson)
    {
        $categories = Category::all();
        $chapters = Chapter::all();
        $lessons = Lesson::all();
        $attempts = ExamAttempt::with('chapter')->orderBy('updated_at')->get();
        return view('layout-frontend.categories.resume', compact('attempts', 'chapter', 'categories', 'chapters', 'lesson', 'lessons', 'category'));
    }
}
