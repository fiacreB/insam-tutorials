<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function showVideo(Lesson $video, Course $course, Chapter $chapter)
    {
        $categories = Category::all();
        $courses = Course::all();
        $chapters = Chapter::all();
        $cours = Lesson::all();
        return view('frontend.categories.one-video', compact('chapter', 'course', 'video', 'categories', 'chapters', 'cours', 'courses'));
    }
}
