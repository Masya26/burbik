<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Products;
use App\Models\User;
use App\Models\Order;

class OrderController extends Controller
{
    public function showKorzina()
    {
        // Получаем текущего пользователя
        $user = auth()->user();

        // Находим корзину текущего пользователя
        $cart = $user->orders->where('status', 'cart')->first();

        // Если корзина не найдена, вы можете добавить логику для обработки этого случая

        // Получаем продукты в корзине
        $user = auth()->user();
        $cart = $user->orders()->where('status', 'cart')->firstOrCreate(['status' => 'cart']);
        $products = $cart->products;

        // Отображаем представление с содержимым корзины и передаем туда данные о продуктах
        return view('korzina', compact('products'));
    }
    public function removeFromKorzina(Products $product)
    {
        // Получаем текущего пользователя
        $user = auth()->user();

        // Находим корзину текущего пользователя
        $korzina = $user->orders->where('status', 'korzina')->first();

        // Удаляем продукт из корзины
        $korzina->products()->detach($product->id);

        // Опционально: добавьте сообщение об успешном удалении или редирект
    }
    public function updateQuantityInKorzina(Products $product, Request $request)
    {
        // Получаем текущего пользователя
        $user = auth()->user();

        // Находим корзину текущего пользователя
        $korzina = $user->orders->where('status', 'korzina')->first();

        // Обновляем количество продуктов в корзине
        $korzina->products()->updateExistingPivot($product->id, ['quantity' => $request->quantity]);

        // Опционально: добавьте сообщение об успешном обновлении или редирект
    }
}
