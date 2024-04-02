<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::get();

        return view('products.index', [
            'products' => $products->reverse(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Проверка данных формы
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'title' => 'required|max:2000',
            'product_image' => 'nullable|image',
            'price' => 'required|numeric',
        ]);

        // Проверка, был ли загружен файл изображения
        if ($request->hasFile('product_image')) {
            $filename = $request->file('product_image')->getClientOriginalName();
            $request->file('product_image')->move(public_path('/uploads/products'), $filename);
            $validatedData['product_image'] = $filename;
        }

        // Сохранение данных в базу данных
        $product = Products::create($validatedData);

        // Перенаправление на страницу списка товаров с сообщением об успехе
        return redirect()->route('products.index')
                        ->with('status', 'Товар успешно добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
