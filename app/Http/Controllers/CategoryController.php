<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category)
    {

        return view('category.index');
    }
    public function create()
    {

    }
    public function store(Request $request)
    {

    }
    public function show(Category $category)
    {

    }
    public function edit(Category $category)
    {

    }
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

}
