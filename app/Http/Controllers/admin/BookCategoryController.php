<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Cours;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Sujet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $query = $request->get('query');
        $admin_search = BookCategory::where('title', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc')->paginate(10);
        $bookCategories = BookCategory::orderBy('created_at', 'desc')->paginate(10);
        if ($request->has('search')) {
            $admin_search = $request->search;
            $bookCategories = BookCategory::where('title', 'like', '%' . $admin_search . '%')->orderBy('created_at', 'desc')->paginate(10);
        }
        return view('dashboard.admin.bibliotheque.book_categories.index',  compact('bookCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $categories = BookCategory::all();
        return view('dashboard.admin.bibliotheque.book_categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
        ]);
        $slug = Str::slug($request->title, '-');

        BookCategory::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'parent_id' => $request->parent_id
        ]);
        return redirect()->route('admin.book_categories.index')->with('success', 'Biblithèque crée avec success');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $bookCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BookCategory $bookCategory): View
    {
        $categories = BookCategory::all();

        return view('dashboard.admin.bibliotheque.book_categories.edit', compact('bookCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $bookCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookCategory $bookCategory): RedirectResponse
    {
        $slug = Str::slug($request->title, '-');
        $bookCategory->fill([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'parent_id' => $request->parent_id
        ]);
        $bookCategory->save();
        return redirect()->route('admin.book_categories.index')->with('success', 'Bibliothèque mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $bookCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookCategory $bookCategory): RedirectResponse
    {
        $bookCategory->delete();
        return redirect()->route('admin.book_categories.index')->with('success', 'deleted success');
    }

    public function adminIndex()
    {
        $bookCategories = BookCategory::all();
        return view('admin.book_categories.index', compact('bookCategories'));
    }

    public function adminShow(BookCategory $bookCategory)
    {
        $books = Book::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.admin.bibliotheque.books.index', compact('bookCategory', 'books'));
    }
}
