<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Cours;
use App\Models\Lesson;
use App\Models\Sujet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $query = $request->get('query');
        $admin_search = Book::where('title', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc')->paginate(10);
        $books = Book::orderBy('created_at', 'desc')->paginate(10);
        if ($request->has('search')) {
            $admin_search = $request->search;
            $books = Book::where('title', 'like', '%' . $admin_search . '%')->orderBy('created_at', 'desc')->paginate(10);
        }
        $user = Auth::user()->id;
        $bookCategory = Book::with('category')->first();
        return view('dashboard.admin.bibliotheque.books.all-books',  compact('user', 'books', 'bookCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(BookCategory $bookCategory): View
    {
        return view('dashboard.admin.bibliotheque.books.create', compact('bookCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, BookCategory $bookCategory): RedirectResponse
    {
        // dd($request);
        $request->validate([
            'title' => 'required|string',
            'image' => 'required',
            'pdf' => 'required',
        ]);
        $slug = Str::slug($request->title, '-');
        $filename = $request->title . '.' . $request->image->extension();
        $image_path = $request->image->storeAs(
            "books/covers",
            $filename,
            'public'
        );


        $filename2 = $request->title . '.' . $request->pdf->extension();
        $pdf_path = $request->pdf->storeAs(
            "books/pdf",
            $filename2,
            'public'
        );
        Book::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $image_path,
            'pdf_path' => $pdf_path,
            'views' => 0,
            'book_categories_id' => $bookCategory->id
        ]);

        return redirect()->route('admin.book_categories.show', $bookCategory)->with('success', 'Livre créer avec succès');
    }

    public function allCreate()
    {
        $categories = BookCategory::all();
        return view('dashboard.admin.bibliotheque.books.all-create', compact('categories'));
    }
    public function allStore(Request $request): RedirectResponse
    {
        // dd($request);
        $request->validate([
            'title' => 'required|string',
            'image' => 'required',
            'pdf' => 'required',
        ]);
        $slug = Str::slug($request->title, '-');
        $filename = $request->title . '.' . $request->image->extension();
        $image_path = $request->image->storeAs(
            "books/covers",
            $filename,
            'public'
        );


        $filename2 = $request->title . '.' . $request->pdf->extension();
        $pdf_path = $request->pdf->storeAs(
            "books/pdf",
            $filename2,
            'public'
        );
        Book::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $image_path,
            'pdf_path' => $pdf_path,
            'views' => 0,
            'book_categories_id' => $request->book_categories_id
        ]);
        $bookCategory = BookCategory::where('id', $request->book_categories_id)->first();
        return redirect()->route('admin.book_categories.show', ['bookCategory' => $bookCategory])->with('success', 'Livre créer avec succès');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book): View
    {
        return view('dashboard.admin.bibliotheque.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book, BookCategory $bookCategory): RedirectResponse
    {

        if ($request->has('image') || $request->has('pdf')) {
            $slug = Str::slug($request->title, '-');
            if ($request->has('image') && !$request->pdf) {
                $filename = rand() . '.' . $request->image->extension();
                $image_path = $request->image->storeAs(
                    "books/covers",
                    $filename,
                    'public'
                );
                $book->fill([
                    'title' => $request->title,
                    'slug' => $slug,
                    'description' => $request->description,
                    'image' => $image_path,
                ]);
            } elseif ($request->has('pdf') && !$request->image) {
                $filename2 = rand() . '.' . $request->pdf->extension();
                $pdf_path = $request->pdf->storeAs(
                    "books/pdf",
                    $filename2,
                    'public'
                );
                $book->fill([
                    'title' => $request->title,
                    'slug' => $slug,
                    'description' => $request->description,
                    'pdf_path' => $pdf_path,
                ]);
            } else {
                $filename = rand() . '.' . $request->image->extension();
                $image_path = $request->image->storeAs(
                    "books/covers",
                    $filename,
                    'public'
                );
                $filename2 = rand() . '.' . $request->pdf->extension();
                $pdf_path = $request->pdf->storeAs(
                    "books/pdf",
                    $filename2,
                    'public'
                );
                $book->fill([
                    'title' => $request->title,
                    'slug' => $slug,
                    'description' => $request->description,
                    'image' => $image_path,
                    'pdf_path' => $pdf_path,
                ]);
            }
            $book->save();
        } else {

            $slug = Str::slug($request->title, '-');
            $book->fill([
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
            ]);
            $book->save();
        }
        return redirect()->route('admin.book_categories.show', $book->category)->with('success', 'Livre mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return back()->with('success', 'Deleted success');
    }
}
