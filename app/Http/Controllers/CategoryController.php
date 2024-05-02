<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        $new_category = new Category();
        $new_category->title = $request->title;
        $new_category->save();
        return redirect()->route('admin.category.index');
    }
    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }
    public function update(UpdateRequest $request, Category $category)
    {
        $category->title = $request->title;
        $category->save();

        return view('admin.category.show', compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index');
    }
}
