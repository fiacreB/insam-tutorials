<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Cours;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Sujet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookCategoryController extends Controller
{

    public function index(Request $request)
    {

        $query = $request->get('query');
        $admin_search = BookCategory::where('title', 'LIKE', '%' . $query . '%')->get();
        $bookCategories = BookCategory::orderBy('created_at', 'desc')->paginate(4);
        if ($request->has('search')) {
            $admin_search = $request->search;
            $bookCategories =  BookCategory::where('title', 'LIKE', '%' . $admin_search . '%')->orderBy('created_at', 'desc')->paginate(4);
        }
        $categorie = [];
        foreach ($bookCategories as $key => $category) {
            $videos = [];
            if ($category->videos !== null) {
                $videos = $category->videos->sortDesc('views')->take(1);
            }
            $category->videos = $videos;
            array_push($categorie, $category);
        }
        $categories = Category::all();
        $sujets = Course::all();
        $cours = Lesson::all();
        return view('frontend.book_categories.index', ['bookCategories' => $bookCategories], compact('admin_search', 'categories', 'sujets', 'cours'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $bookCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BookCategory $bookCategory, Request $request): View
    {
        $query = $request->get('query');
        $admin_search = Book::where('title', 'LIKE', '%' . $query . '%')->get();
        $books = $bookCategory->books()->orderBy('created_at', 'desc')->paginate(9);
        if ($request->has('search')) {
            $admin_search = $request->search;
            $books =  $bookCategory->books()->where('title', 'LIKE', '%' . $admin_search . '%')->orderBy('created_at', 'desc')->paginate(9);
        }
        $categories = Category::all();
        $bookCategories = BookCategory::all();
        $sujets = Chapter::all();
        $cours = Lesson::all();
        $request = $request->path();
        return view('frontend.book_categories.show', compact('bookCategory', 'bookCategories', 'admin_search', 'categories', 'books', 'sujets', 'cours', 'request'));
    }
}
