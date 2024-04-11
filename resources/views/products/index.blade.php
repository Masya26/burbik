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
    .product-title{
        margin-top: 5px;
    }
    .product-price {
        font-weight: bold;
    }
</style>
</head>
<body>

<h1>Мои товары</h1>
@if(isset($products))
@foreach ($products as $product)
    <ul class="products-list">
        <!-- Пример товара 1 -->
        <tr>
            <td>
                {{ $product['id'] }}
            </td>
            <td>
                {{ $product['name'] }}
            </td>
            <td>
                {{ $product['title'] }}
            </td>
            <td>
                <p><img style="width:100px; height:100px;"
                        src="{{ 'images/product/' . $product->product_image }}"
                        alt=""></p>
            </td>
            <td>
                {{ $product['created_at'] }}
            </td>
        </tr>
    </ul>
@endforeach
@endif
</body>
</html>
