<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Маяк</title>
    {{-- <link rel="preconnect" href="https://fonts.bunny.net"> --}}
    {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
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
                                <div class="category">
                                    <a href="/">{{ $category->title }}</a>
                                    <br>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="search-form-block" style="width: 100%;">
                <form onsubmit="searchProducts(event)" class="search-form border pt-2">
                    <div style="display:flex; justify-content: space-between; padding:0 5px 0 5px;">
                        <input id="search-input" name="s" placeholder="Введите название товара" type="search"
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
        <div id="search-results" style="display: none;">
            <!-- Сюда будет загружаться результаты поиска -->
        </div>
        {{-- Товары --}}
        <div id="products-container"
            style="display:grid; grid-template-columns: auto auto auto auto auto; padding-top: 3%; width:100%">
            <p style="display: none;">{{ $count = 0 }}</p>
            @if (isset($searchResults))
                <div id="search-results">
                    {{-- Перебираем результаты поиска --}}
                    @foreach ($searchResults as $product)
                        <div style="margin: 0 auto; padding: 5% 2% 2% 2%;" class="products-block">
                            <div style="text-align:center;">
                                <img style="width:150px; height:150px; border-radius: 5px;"
                                    src="{{ asset('storage/images/product/' . $product->product_image) }}"
                                    alt=""> <br>
                            </div>
                            <div class="products-text-block">
                                <div>
                                    <div class="products-name">
                                        {{ $product->name }} <br>
                                    </div>
                                    <div class="products-title">
                                        {{ $product->title }} <br>
                                    </div>
                                </div>
                                <div>
                                    <form action="{{ route('products.addToCart', $product->id) }}" method="post">
                                        @csrf
                                        <button class="main-button" type="submit">
                                            <div class="products-price">
                                                {{ $product->price }}₽
                                            </div>
                                            <div class="v-korzinu">
                                                В корзину
                                            </div>
                                        </button>
                                        <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                @if (isset($products))
                    @foreach ($products as $product)
                        @if ($count <= 4)
                            <!-- Пример товара 1 -->
                            <div style="margin: 0 auto; padding: 5% 2% 2% 2%;" class="products-block">
                                <div style="text-align:center;">
                                    <img style="width:150px; height:150px; border-radius: 5px;"
                                        src="{{ asset('storage/images/product/' . $product->product_image) }}"
                                        alt=""> <br>
                                </div>

                                <div class="products-text-block">
                                    <div>
                                        <div class="products-name">
                                            {{ $product['name'] }} <br>
                                        </div>
                                        <div class="products-title">
                                            {{ $product['title'] }} <br>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <form action="{{ route('products.addToCart', $product->id) }}"
                                                method="post">
                                                @csrf
                                                <button class="main-button" type="submit">
                                                    <div class="products-price">
                                                        {{ $product['price'] }} ₽
                                                    </div>
                                                    <div class="v-korzinu">
                                                        В корзину
                                                    </div>
                                                </button>
                                                <input type="hidden" name="redirect_url"
                                                    value="{{ url()->current() }}">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p style="display: none;">{{ $count = $count + 1 }}</p>
                        @else($count = 3)
                            <br>
                            <p style="display: none;">{{ $count = 0 }}</p>
                        @endif
                    @endforeach
                @endif
            @endif
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
        // Функция для отправки запроса поиска
        function searchProducts(event) {
            event.preventDefault(); // Предотвращаем стандартное поведение отправки формы

            let query = document.querySelector('#search-input').value; // Получаем запрос поиска
            let searchResultsContainer = document.getElementById('search-results');
            let productsContainer = document.getElementById('products-container');

            fetch(`/products/search?s=${query}`, {
                    method: 'GET',
                })
                .then(response => response.text())
                .then(data => {
                    if (data.trim().length) {
                        searchResultsContainer.innerHTML = data; // Вставляем результаты поиска
                        searchResultsContainer.style.display = 'block'; // Показываем контейнер с результатами
                        productsContainer.style.display = 'none'; // Скрываем основной контейнер с товарами
                    } else {
                        searchResultsContainer.innerHTML = '<p>По вашему запросу ничего не найдено.</p>';
                        searchResultsContainer.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('There was an error:', error);
                    searchResultsContainer.innerHTML = '<p>Произошла ошибка при выполнении поиска.</p>';
                    searchResultsContainer.style.display = 'block';
                });
        }
    </script>
</body>

</html>
