<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\UpdateRequest;
use App\Http\Requests\Product\StoreRequest;
use App\Models\Category;
use App\Models\Products;
use App\Models\ProductTag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $products = Products::with('category')->get();

        return view('welcome', [
            'products' => $products->reverse(),
            'categories' => $categories,
        ]);
    }
    public function indexkor()
    {
        $categories = Category::all();
        $products = Products::with('category')->get();

        return view('korzina', [
            'products' => $products->reverse(),
            'categories' => $categories,
        ]);
    }
    public function admin()
    {
        $products = Products::all();
        return view('products.index', [
            'products' => $products->reverse(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $category = Category::find($request->input('category_id'));
        $product = new Products();
        $data = $request->validated();

        // Загрузка изображения продукта
        if ($request->hasFile('product_image')) {
            $filename = $request->file('product_image')->getClientOriginalName();
            $request->file('product_image')->move(public_path('images/product/'), $filename);
            $validatedData['product_image'] = $filename;
        }
        // Получение выбранной категории

        // Создание продукта
        $product = Products::firstOrCreate([
            'name' => $data['name'],
        ], $data);
        // Сохранение категории
        $product->category_id = $category->id; // Устанавливаем категорию
        $product->save(); // Сохраняем продукт
        if (!$product) {
            return response()->json(['error' => 'Продукт с таким именем уже существует'], 409);
        }

        return redirect()->route('products.admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Products $product)
    {
        $product = Products::find($product->id);

        if ($request->hasFile('product_image')) {
            $filename = $request->file('product_image')->getClientOriginalName();

            if (file_exists(public_path('images/product/' . $filename))) {
                throw new Exception('Файл с таким именем уже существует.');
            }

            if (!is_dir(public_path('images/product'))) {
                mkdir(public_path('images/product'), 0777, true);
            }

            $request->file('product_image')->move(public_path('images/product/'), $filename);
        }

        $product->name = $request->name;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->count = $request->count;
        $product->category_id = $request->category_id;

        if ($request->hasFile('product_image')) {
            $product->product_image = $filename;
        }

        $product->save();

        return response()->json(['message' => 'Продукт успешно обновлён'], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()->route('products.admin');
    }
}
