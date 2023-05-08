<?php

use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\ExamenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
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
        Route::get('get-reviewed-qna{chapter}', [ExamenController::class, 'reviewQna'])->name('reviewQna');
        Route::get('results/{chapter}', [ExamenController::class, 'resultDashboard'])->name('resultDashboard');
        Route::get('delete-test/{chapter}', [TestController::class, 'deleteTest'])->name('deleteTest'); //OK
        Route::get('/video/{video}', [ChapterController::class, 'showVideo'])->name('video');
    });
    Route::group([
        'prefix' => 'book.categories',
        'as' => 'book.categories.'
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