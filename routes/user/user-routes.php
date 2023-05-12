<?php


use App\Http\Controllers\user\BookCategoryController;
use App\Http\Controllers\user\BookController;
use App\Http\Controllers\user\PostController;
use App\Http\Controllers\user\ExamenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\LessonController;
use App\Http\Controllers\user\CategoryController;
use App\Http\Controllers\user\CourseController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ChapterController;
use App\Models\course;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// routes user
Route::get('/Lessones', [PostController::class, 'Lessones'])->name('Lessones'); //OK
Route::get('/contact', [PostController::class, 'contact'])->name('contact'); //OK


//rechercher route
Route::get('/videos/{id}', [LessonController::class, 'getVideo'])->name('getVideo'); //OK
Route::get('/search/{search}', [LessonController::class, 'search'])->name('search'); //OK



//categorie route

Route::group(['prefix' => 'layout-frontend', 'as' => 'layout-frontend.'], function () {
    Route::get('user/{user}', [PostController::class, 'profile'])->name('profile'); //OK
    Route::group([
        'prefix' => 'categories',
        'as' => 'categories.'
    ], function () {
        Route::get('', [CategoryController::class, 'index'])->name('index'); //OK
        Route::get('/{category}', [CategoryController::class, 'showcourse'])->name('showcourse'); //OK
        Route::get('/{category}/show', [CategoryController::class, 'show'])->name('show'); //OK
        Route::get('categoriesAll/{category}', [CategoryController::class, 'categoriesAll'])->name('categoriesAll'); //OK
        Route::get('test/{category}', [ExamenController::class, 'test'])->name('test'); //OK
        Route::get('examen/{chapter}', [ExamenController::class, 'examen'])->name('examen'); //OK
        Route::get('videos/{chapter}', [LessonController::class, 'videos'])->name('videos'); //OK
        Route::get('resume/{chapter}', [LessonController::class, 'resume'])->name('resume'); //OK
        Route::post('exam-submit/{chapter}', [ExamenController::class, 'examSubmit'])->name('examSubmit');
        Route::get('/get-reviewed-qna', [ExamenController::class, 'reviewQna'])->name('reviewQna');
        Route::get('results/{chapter}', [ExamenController::class, 'resultDashboard'])->name('resultDashboard');
        Route::get('delete-test/{attempt}', [ExamenController::class, 'deleteTest'])->name('deleteTest'); //OK
        Route::get('/video/{video}', [ChapterController::class, 'showVideo'])->name('video');
        Route::post('/approved-qna', [ExamenController::class, 'approvedQna'])->name('approvedQna');
    });
    Route::group([
        'prefix' => 'book_categories',
        'as' => 'book_categories.'
    ], function () {
        Route::get('', [BookCategoryController::class, 'index'])->name('index');
        Route::get('/{bookCategory}', [BookCategoryController::class, 'show'])->name('show');
    });
    Route::group([
        'prefix' => 'book',
        'as' => 'book.'
    ], function () {
        Route::get('', [BookController::class, 'index'])->name('index');
        Route::get('/{book}', [BookController::class, 'show'])->name('show');
    });

    Route::group([
        'prefix' => 'lessons',
        'as' => 'lessons.'
    ], function () {
        Route::get('', [LessonController::class, 'index'])->name('index');
        Route::get('/{lesson}', [LessonController::class, 'show'])->name('show');
    });

    Route::group([
        'prefix' => 'courses',
        'as' => 'courses.'
    ], function () {
        Route::get('', [CourseController::class, 'index'])->name('index');
        Route::get('/{course}', [CourseController::class, 'show'])->name('show');
    });
});

Route::get('courses/search', [LessonController::class, 'find']);
Route::get('categories/search', [CategoryController::class, 'find']);

// Route::group([
//     'prefix' => '/',
//     'as' => '/'
// ], function () {
//     Route::get('courses', [CourseController::class, 'index']);
//     Route::get('courses/{slug}', [CourseController::class, 'show'])->name('show');
// });

// Route::get('/courses', [CourseController::class, 'index']);
