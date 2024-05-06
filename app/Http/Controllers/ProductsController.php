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

        // Создаем новый экземпляр продукта
        $product = new Products();

        // Получаем валидированные данные из запроса
        $data = $request->validated();

        // Загружаем изображение продукта
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $filename = $image->getClientOriginalName(); // Получаем оригинальное имя файла
            $path = $image->storeAs('images/product', $filename, 'public'); // Сохраняем файл с оригинальным именем
            $data['product_image'] = $filename; // Обновляем массив данных путем файла
        }

        // Создаем продукт
        $product = Products::firstOrCreate([
            'name' => $data['name'],
        ], $data);

        // Устанавливаем категорию продукта
        $product->category_id = $category->id;

        // Сохраняем продукт
        $product->save();

        // Проверяем успешность операции сохранения
        if (!$product) {
            return response()->json(['error' => 'Продукт с таким именем уже существует'], 409);
        }

        // Перенаправляем на страницу администрирования продуктов
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
        // Получаем экземпляр товара из базы данных
        $product = Products::find($product->id);

        // Если загружено новое изображение, обрабатываем его
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension(); // Генерируем уникальное имя файла
            $image->move(public_path('images/product/'), $filename); // Перемещаем изображение в директорию
            $product->product_image = $filename; // Устанавливаем имя изображения в поле product_image
        }

        // Обновляем остальные поля товара
        $product->name = $request->name;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->count = $request->count;
        $product->category_id = $request->category_id;

        // Сохраняем обновленный товар в базу данных
        $product->save();

        // Возвращаем успешный ответ
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
