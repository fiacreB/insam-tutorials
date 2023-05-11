<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book): View
    {
        $book->fill([
            'views' => $book->views + 1
        ]);
        $book->save();
        $categories = Category::all();
        $sujets = Chapter::all();
        $cours = Lesson::all();
        return view('frontend.books.show', compact('book', 'sujets', 'categories', 'cours'));
    }
}
