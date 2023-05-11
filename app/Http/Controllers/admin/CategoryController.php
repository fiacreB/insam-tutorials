<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Sujet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $categories = Category::where('parent_id', null)->orWhere('parent_id', 0)->get();

        return view('dashboard.admin.categories.create', compact('categories'));
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
            'description' => 'string',
        ]);
        $image_path = 'rien';
        if ($request->has('image')) {
            $filename = rand() . '.' . $request->image->extension();
            $image_path = $request->image->storeAs(
                "categories",
                $filename,
                'public'
            );
        }
        $slug = Str::slug($request->title, '-');
        Category::create([
            'title' => $request->title,
            'slug' => $slug,
            'parent_id' => $request->parent_id,
            'image' => $image_path,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Categorie créér avec succès');
    }



    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.admin.categories.index', compact('categories'));
    }


    public function show(Category $category)

    {
        $courses = Course::OrderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.admin.categories.show-courses', compact('category', 'courses'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category): View
    {
        return view('dashboard.admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category): RedirectResponse
    {

        if ($request->has('image')) {
            $slug = Str::slug($request->title, '-');

            $filename = rand() . '.' . $request->image->extension();
            $image_path = $request->image->storeAs(
                "categories",
                $filename,
                'public'
            );

            $category->fill([
                'title' => $request->title,
                'slug' => $slug,
                'image' => $image_path,
                'description' => $request->description,
            ]);
            $category->save();
        } else {
            $slug = Str::slug($request->title, '-');

            $category->fill([
                'title' => $request->title,
                'slug' => $slug,

                'description' => $request->description,
            ]);
            $category->save();
        }
        return redirect()->route('admin.categories.index')->with('success', 'Categorie mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->courses()->delete();
        $category->delete();
        return back()->with('success', 'Deleted success');
    }
}
