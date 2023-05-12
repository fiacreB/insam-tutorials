<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\ExamAttempt;
use App\Models\Lesson;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class PostController extends Controller
{

    public function contact()
    {
        return view('frontend.pages.contact');
    }
    public function profile()
    {
        $chapters = Chapter::all();
        $user = Auth::user();
        return view('frontend.profile', compact('user', 'chapters'));
    }
}
