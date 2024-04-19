<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    {{-- <link rel="preconnect" href="https://fonts.bunny.net"> --}}
    {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div style="margin: 2% 15% 0 15%;" class="shadow p-3 mb-5 bg-body rounded">
        <div style="display:grid; grid-template-columns: 25% 20% 40% 15%;" class="border-bottom pt-2 pb-2">
            <div class="pb-2 logo-block">
                <img src="images\logo.png" style="max-width: 55%;">
            </div>
            <div class="dropdown-flex-block">
                <div class="dropdown">
                    <span class="badge fw-bold button-catalog" style="width: 100%;"> Категории товаров
                        <i class="fa fa-angle-down" style="font-size:18px; position:relative; top:2px; left:2px;"></i>
                    </span>

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
                <a>
                    <span class="badge mini-text basket-button fw-bold">
                        <i class="bi bi-basket2 fs-4" style="color: rgb(255, 255, 255)"></i>
                        Корзина
                    </span>
                </a>
            </div>
        </div>

        {{-- Товары --}}
        <div style="display:grid; grid-template-columns: auto auto auto auto auto; padding-top: 3%; width:100%">
            <p style="display: none;">{{ $count = 0 }}</p>


            @if (isset($products))
                @foreach ($products as $product)
                    @if ($count <= 4)
                        <!-- Пример товара 1 -->
                        <div style="margin: 0 auto; padding: 2% 2% 2% 2%;" class="products-block">
                            <div style="text-align:center">
                                <img style="width:150px; height:150px;"
                                    src="{{ 'images/product/' . $product->product_image }}" alt=""> <br>
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
                                        <button class="to-basket-button">
                                            <div class="products-price">
                                                {{ $product['price'] }} ₽
                                            </div>
                                            <div class="v-korzinu">
                                                В корзину
                                            </div>
                                        </button>
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
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>

</html>
