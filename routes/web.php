<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\ExamAnswer;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\User\ExamenController;
use App\Http\Controllers\TestController;
use App\Models\Course;
use App\Models\ExamAttempt;
use App\Models\Chapter;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(
    [
        'verify' => true
    ]
);


Route::get('/', function () {
    $news_courses = Course::all()->sortByDesc('created_at')->take(8);
    $categories = Category::all()->sortByDesc('created_at')->take(8);
    $populars_course = Course::all()->sortByDesc('visits')->take(6);


    return view('frontend.index', compact('news_courses', 'categories', 'populars_course'));
    // return view('frontend.index');
});


// Route::middleware([])->group(function () {
//     // Route::get('/', function (Request $request, Chapter $sujet, Course $chapitre, Category $category) {
//     //     $populars_videos = Course::all()->sortByDesc('visits')->take(6);
//     //     $news_videos = Course::all()->sortByDesc('created_at')->take(8);
//     //     $categories = Category::all()->sortByDesc('created_at')->take(8);

//         // $courses = Course::all();
//         // $Lesson = Lesson::all();
//         // $attemptData =  ExamAttempt::where('chapter_id', $request->chapter_id)->with(['user', 'sujet'])->get();

//         // return view('index', compact('category', 'chapitre', 'sujet', 'populars_videos', 'news_videos', 'categories', 'courses', 'Lesson', 'attemptData'));
//     }); //OK

//     require __DIR__ . '/user/user-routes.php';
//     Route::get('/review-student-qna', [ExamenController::class, 'reviewStudentQna'])->name('resultStudentQna');
// });
require __DIR__ . '/user/user-routes.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    require __DIR__ . '/admin/admin-routes.php';
});
