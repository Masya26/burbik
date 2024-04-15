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

<body style="" class="bg-danger">
    <div style="margin: 2% 15% 0 15%;" class="shadow p-3 mb-5 bg-body rounded">
        {{-- Шапка --}}
        <div class="border-bottom pb-2 div-logo">
            <img src="images\logo.png" style="max-width: 15%;">
        </div>
        {{-- Основная часть --}}
        <div style="display:grid; grid-template-columns: 20% 70% 10%;" class="border-bottom pt-2 pb-2">
            <div style="width: 100%">
                <span class="badge fw-bold pt-2 button-catalog mini-text" style="width: 100%;"> Каталог товаров
                    <i class="fa fa-angle-down" style="font-size:18px; position:relative; top:2px; left:2px;"></i>
                </span>
            </div>
            <div class="px-2" style="width: 100%;">
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
            <div class="border-start px-2" style="width: 100%">
                <a>
                    <i class="bi bi-basket2 fs-4" style="color: rgb(11, 178, 255)"></i>
                    <span class="fw-bold mini-text"
                        style="color: rgb(11, 178, 255); font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; width: auto; height: 40px; text-align:center;">
                        0.00Р
                    </span>
                </a>
            </div>
        </div>
        <h1>Мои товары</h1>

        <p style="display: none;">{{ $count = 0 }}</p>
        <table>
            @if (isset($products))
                @foreach ($products as $product)
                    @if ($count <= 2)
                        <!-- Пример товара 1 -->

                        <td>
                        <td>
                            <p><img style="width:100px; height:100px;"
                                    src="{{ 'images/product/' . $product->product_image }}" alt=""></p>

                        </td>

                        <td>
                            {{ $product['name'] }}

                        </td>
                        <td>
                            {{ $product['title'] }}
                        </td>
                        </td>

                        <p style="display: none;">{{ $count = $count + 1 }}</p>
                    @else($count = 3)
                        <tr>
                            <td colspan="5">
                                <br>
                            </td>
                        </tr>
                        {{ $count = 0 }}
                    @endif
                @endforeach



            @endif
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
