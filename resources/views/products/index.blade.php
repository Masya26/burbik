<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Товары</title>
    <style>
        /* Стилизация списка товаров */
        .products-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .product {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .product-name {
            font-weight: bold;
        }

        .product-title {
            margin-top: 5px;
        }

        .product-price {
            font-weight: bold;
        }

        table {
            background: maroon;
            color: white;
        }
    </style>
</head>

<body>

    <h1>Мои товары</h1>

    {{ $count = 0 }}
    <table>
        @if (isset($products))
            @foreach ($products as $product)
                @if ($count <= 2)
                    <!-- Пример товара 1 -->

                    <td>
                    <td>
                        <p><img style="width:100px; height:100px;" src="{{ 'images/product/' . $product->product_image }}"
                                alt=""></p>

                    </td>

                    <td>
                        {{ $product['id'] }}
                    </td>
                    <td>
                        {{ $product['name'] }}

                    </td>
                    <td>
                        {{ $product['title'] }}
                    </td>
                    </td>

                    {{ $count = $count + 1 }}
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
</body>

</html>
