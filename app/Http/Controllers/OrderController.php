<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Products;
use App\Models\User;
use App\Models\Order;

class OrderController extends Controller
{
    public function submitAddress(Request $request)
    {
        // Валидация данных
        $request->validate([
            'address' => 'required|string|max:255',
        ]);

        // Получаем адрес из запроса
        $address = $request->input('address');

        // Здесь вы можете выполнить необходимые действия с адресом,
        // например, сохранить его в базу данных или выполнить другую логику

        // Возвращаем успешный ответ в формате JSON
        return response()->json(['success' => true]);
    }

    public function showKorzina()
    {
        // Получаем текущего пользователя
        $user = auth()->user();

        // Находим корзину текущего пользователя
        $cart = $user->orders()->where('status', 'korzina')->first();

        // Если корзина не найдена или у нее нет незавершенных заказов, вернем пустую коллекцию продуктов
        if (!$cart || !$cart->products()->exists()) {
            return view('korzina', ['products' => collect()]);
        }

        // Получаем продукты в корзине, где заказы еще не завершены
        $products = $cart->products()->whereHas('orders', function ($query) {
            $query->where('completed', false);
        })->get();

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
        } elseif ($productInKorzina && $productInKorzina->pivot->quantity == 1) {
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

    public function store(Request $request)
    {
        // Получаем текущего пользователя
        $user = auth()->user();

        // Находим текущий заказ пользователя
        $currentOrder = $user->orders()->where('status', 'korzina')->first();

        // Если текущий заказ существует, то...
        if ($currentOrder) {
            // Получаем данные текущего заказа
            $address = $request->input('address');
            $totalPrice = $request->input('total-price');
            // Создаем новый заказ
            $newOrder = new Order();
            $newOrder->user_id = $user->id;
            $newOrder->address = $address;
            $newOrder->status = 'korzina';
            $newOrder->completed = true;
            $newOrder->total_price = $totalPrice;
            $newOrder->save();

            // Получаем продукты из текущего заказа
            $products = $currentOrder->products()->get();

            // Переносим продукты из текущего заказа в новый заказ
            foreach ($products as $product) {
                $quantity = $product->pivot->quantity; // Количество продукта в текущем заказе
                $newOrder->products()->attach($product->id, ['quantity' => $quantity]);
            }

            // Удаляем текущий заказ
            $currentOrder->delete();

            // Перенаправляем пользователя на страницу с подтверждением заказа или другую страницу
            return redirect()->route('index.welcome');
        } else {
            

        }
    }
    public function admin()
    {
        $orders = Order::all();
        return view('orders.index', [
            'orders' => $orders->reverse(),
        ]);
    }
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.admin');
    }
}
