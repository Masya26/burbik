<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Корзина</title>
    {{-- <link rel="preconnect" href="https://fonts.bunny.net"> --}}
    {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <script>
        // Определение функции updateQuantity
        function updateQuantity(productId, operation) {
            let url = `/korzina/${productId}/${operation}`;

            fetch(url, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data received:', data);
                    let quantityElement = document.getElementById(`quantity-${productId}`);
                    if (data.quantity >= 0) {
                        quantityElement.innerText = data.quantity;
                        updateTotalPrice(); // Пересчитываем общую сумму заказа
                        if (data.quantity === 0) {
                            updateProductCount(productId, 1); // Возврат количества товаров
                        }
                    }
                    if (data.quantity === 0) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }

        // Функция для обновления количества товаров в базе данных
        function updateProductCount(productId, countChange) {
            fetch(`/updateProductCount/${productId}/${countChange}`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }

        function updateTotalPrice() {
            let totalPrice = 0;
            let products = document.querySelectorAll('.products-block');

            // Проверяем, есть ли элементы с классом .products-block на странице
            if (products.length > 0) {
                products.forEach(product => {
                    let quantityElement = product.querySelector('.products-quantity');
                    let priceElement = product.querySelector('.products-price');

                    // Проверяем, что элементы с количеством и ценой товара найдены
                    if (quantityElement && priceElement) {
                        let quantity = parseInt(quantityElement.innerText);
                        let price = parseFloat(priceElement.innerText.replace(/[^\d.]/g, ''));
                        totalPrice += quantity * price;
                    }
                });
            }

            // Выводим общую сумму заказа на страницу
            document.getElementById('total-price').innerText = totalPrice.toFixed(2) + '₽';
        }

        // Вызываем функцию updateTotalPrice после загрузки страницы
        document.addEventListener('DOMContentLoaded', updateTotalPrice);
    </script>
</head>

<body>
    <div style="margin: 2% 7% 0 7%;" class="shadow p-3 mb-5 bg-body rounded">
        <div style="display:grid; grid-template-columns: 10% 20% 40% 15% 15%;" class="border-bottom pt-2 pb-2">
            <div class="pb-2 logo-block">
                <a href="/">
                    <img src="images\logo.png" style="max-width: 100%;">
                </a>
            </div>
            <div class="dropdown-flex-block">
                <div class="dropdown">
                    <button class="main-button" style="width: 100%;">
                        <div class="catalog">
                            Категории товаров
                        </div>
                    </button>

                    <div class="dropdown-block">
                        @if (isset($categories))
                            @foreach ($categories as $category)
                                <a href="/">{{ $category->title }}</a>
                                <br>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="search-form-block" style="width: 100%;">
                <form action="" method="get" class="search-form border pt-2">
                    <div style="display:flex; justify-content: space-between; padding:0 5px 0 5px;">
                        <input name="s" placeholder="Введите название товара" type="search"
                            class="search-input mini-text">
                        <button type="submit" class="search-button">
                            <i class="bi bi-search" style="font-size:18px"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="basket-block">
                <a href="/korzina">
                    <button class="main-button" style="width: 100%;">
                        Корзина
                    </button>
                </a>
            </div>
            <div class="person-block">
                @if (auth()->check())
                    <a href="/profile">
                        <div class="username-block">
                            <div style="display:grid; grid-template-columns: 15% auto;">
                                <i class="bi bi-person"></i>
                                {{ auth()->user()->name }}
                            </div>
                        </div>
                    </a>
                @else
                    <div class="username-block" style="width: 100%">
                        <a href="/login">
                            <button class="main-button" style="width: 100%">
                                Войти
                            </button>
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div style="display:grid; grid-template-columns: 70% 30%; padding: 1% 0 1% 0; width:100%">
            <div style="display:grid; grid-template-columns: 33% 33% 33%; width:100%">
                @if (isset($products))
                    @foreach ($products as $product)
                        <!-- Пример товара 1 -->
                        <div style="margin: 0 auto; padding: 5% 2% 2% 2%;" class="products-block">
                            <div style="text-align:center">
                                <img style="width:150px; height:150px; border-radius: 5px;"
                                    src="{{ 'images/product/' . $product->product_image }}" alt="">
                            </div>

                            <div class="products-text-block">
                                <div>
                                    <div class="products-name">
                                        {{ $product['name'] }} <br>
                                    </div>
                                    <div class="products-title">
                                        {{ $product['title'] }} <br>
                                    </div>
                                    <div class="products-price"> <!-- Добавляем класс .products-price -->
                                        Цена: {{ $product['price'] }}₽
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between"
                                    style="width: 210px; height:35px; background-color: rgb(11, 178, 255); border-radius: 10px; color:white;">
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="count-product-button"
                                            onclick="updateQuantity({{ $product->id }}, 'decrease')">
                                            —
                                        </button>
                                        <!-- Элемент <span> для отображения количества товара с правильным идентификатором -->
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="products-quantity" id="quantity-{{ $product->id }}">
                                            {{ $product->pivot->quantity }}
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="count-product-button"
                                            style="font-size: 21px; border-radius: 0 10px 10px 0;"
                                            onclick="updateQuantity({{ $product->id }}, 'increase')">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="korzina-summa-zakaza">
                <div class="d-flex justify-content-between ps-4 pe-4 pt-3">
                    <div class="d-flex align-items-end">
                        <h6>Итого</h6>
                    </div>
                    <div class="d-flex align-items-center">
                        <h3 id="total-price">0.00₽</h3> <!-- Этот элемент будет содержать общую сумму заказа -->
                    </div>
                </div>
                <div class="d-flex justify-content-center pb-3">
                    <button onclick="openADDialog()" class="main-button" style="width: 90%">
                        Оформить заказ
                    </button>
                </div>
                <dialog id="ADDialog" class="dialog-adress">
                    <div>
                        Для завершения оформления заказа введите адрес доставки:
                        <div class="pt-2 pb-2">
                            <form action="" method="get" class="search-form border">
                                <div style="display:flex; justify-content: space-between;">
                                    <input name="s" placeholder="Введите адрес доставки" type="search"
                                        class="search-input mini-text">
                                </div>
                            </form>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button onclick="closeADDialog()" class="dialog-main-button">В корзину</button>
                            <button onclick="endDialog()" class="dialog-main-button">Заказать</button>
                        </div>
                    </div>
                </dialog>
                <dialog id="okDialog" class="dialog-adress">
                    <div>
                        <h4 style="text-align: center">Ваш заказ принят!</h4>
                        <h6 style="text-align: center">Связаться с нами: 8-800-458-44-88</h6>
                        <div class="d-flex justify-content-center">
                            <button onclick="closeOKDialog()" class="dialog-main-button">Закрыть</button>
                        </div>
                    </div>
                </dialog>
            </div>
        </div>
        <div class="px-2 pt-2 border-top">
            <h5>Доставка и оплата</h5>
            <div>
                <p>Мы делаем всё, чтобы вы получили свой заказ как можно проще и быстрее!</p>

                <p>Доставка осуществляется курьером по указанному вами адресу в течение нескольких часов с момента оформления заказа.
                Пожалуйста, при оформлении заказа, укажите точный адрес доставки. </p>

                <p>Оплата производится наличными курьеру при получении заказа. Также возможна оплата банковским переводом по реквизитам, которые предоставит вам курьер.</p>

                <b>Связаться с нами: 8-800-458-44-88 (WhatsApp, Telegram)</b>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script>
        const ADdialog = document.getElementById('ADDialog');

        function openADDialog() {
            ADdialog.showModal();
        }

        function closeADDialog() {
            ADdialog.close();
        }

        function endDialog() {
            ADdialog.close();
            dialog.showModal();
        }
    </script>
    <script>
        const dialog = document.getElementById('okDialog');

        function openOKDialog() {
            dialog.showModal();
        }

        function closeOKDialog() {
            dialog.close();
        }
    </script>
</body>
