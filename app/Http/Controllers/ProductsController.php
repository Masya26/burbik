<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\UpdateRequest;
use App\Http\Requests\Product\StoreRequest;
use App\Models\Category;
use App\Models\Products;
use App\Models\User;
use App\Models\Order;
use App\Models\ProductTag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // Проверяем наличие загруженного изображения
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension(); // Генерируем уникальное имя файла

            // Сохраняем изображение в директории storage
            $path = $image->storeAs('images/product', $filename, 'public'); // Перемещаем изображение в директорию storage

            // Обновляем имя файла в базе данных
            $product->product_image = $path;
        }

        // Обновляем поля товара
        $product->update([
            'name' => $request->name,
            'title' => $request->title,
            'price' => $request->price,
            'count' => $request->count,
            'category_id' => $request->category_id,
        ]);

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
    public function addToCart(Request $request, Products $product)
    {
        // Получаем текущего пользователя
        $user = auth()->user();

        // Получаем корзину текущего пользователя
        $korzina = $user->orders()->where('status', 'korzina')->firstOrCreate(['status' => 'korzina']);

        // Проверяем, есть ли товар уже в корзине пользователя
        if ($korzina->products->contains($product->id)) {
            // Увеличиваем количество товара в корзине на единицу
            $productInCart = $korzina->products()->where('product_id', $product->id)->first();
            $productInCart->pivot->update(['quantity' => $productInCart->pivot->quantity + 1]);
        } else {
            // Уменьшаем количество товара в базе данных на 1
            $product->decrement('count');

            // Добавляем товар в корзину пользователя с начальным количеством 1
            $korzina->products()->attach($product->id, ['quantity' => 1]);
        }

        // После добавления в корзину
        $redirectUrl = $request->input('redirect_url', route('index.welcome')); // Если нет указанного URL, то перенаправляем на главную страницу

        return redirect($redirectUrl);
    }
    public function search(Request $request)
    {
        $query = $request->input('s');
        $products = Products::where('name', 'LIKE', "%{$query}%")->get();

        return view('welcome', compact('products'));
    }
}
