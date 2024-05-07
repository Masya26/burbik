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
        $cart = $user->orders()->where('status', 'korzina')->first();

        // Если корзина не найдена, вы можете добавить логику для обработки этого случая

        // Получаем продукты в корзине
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

        // Обновляем количество товаров в базе данных после удаления из корзины
        $this->updateProductCount($product->id, +1);

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

        // Перенаправляем пользователя на страницу корзины
        return redirect()->route('korzina.show');
    }
    public function increaseQuantityInKorzina(Products $product)
    {
        $user = auth()->user();
        $korzina = $user->orders()->where('status', 'korzina')->first();
        $product->decrement('count');

        $productInKorzina = $korzina->products()->where('product_id', $product->id)->first();
        if ($productInKorzina) {
            $productInKorzina->pivot->increment('quantity');
        } else {
            $korzina->products()->attach($product->id, ['quantity' => 1]);
        }

        // Получаем актуальное количество товара после увеличения
        $quantity = $productInKorzina ? $productInKorzina->pivot->quantity : 1;

        // Добавляем атрибут quantity к товару
        $product->quantity = $quantity;

        return response()->json(['quantity' => $quantity, 'message' => 'Quantity increased successfully']);
    }

    public function decreaseQuantityInKorzina(Products $product)
    {
        $user = auth()->user();
        $korzina = $user->orders()->where('status', 'korzina')->first();
        $product->increment('count');

        $productInKorzina = $korzina->products()->where('product_id', $product->id)->first();
        if ($productInKorzina && $productInKorzina->pivot->quantity > 1) {
            $productInKorzina->pivot->decrement('quantity');

        } elseif ($productInKorzina && $productInKorzina->pivot->quantity = 1) {
            $productInKorzina->pivot->decrement('quantity');
            $korzina->products()->detach($product->id);
        } else {
            $korzina->products()->detach($product->id);
        }

        // Получаем актуальное количество товара после уменьшения
        $quantity = $productInKorzina ? $productInKorzina->pivot->quantity : 0;

        // Добавляем атрибут quantity к товару
        $product->quantity = $quantity;

        return response()->json(['quantity' => $quantity, 'message' => 'Quantity decreased successfully']);
    }
    public function updateProductCount($productId, $countChange)
    {
        $product = Products::find($productId);
        if ($product) {
            $product->count += $countChange;
            $product->save();
        }

        return response()->json(['success' => true]);
    }
}
