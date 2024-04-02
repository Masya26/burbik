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

<ul class="products-list">
    <!-- Пример товара 1 -->
    <li class="product">
        <div class="product-name">Телевизор Samsung</div>
        <div class="product-title">Full HD, 42 дюйма, Smart TV</div>
        <div class="product-price">15 000 руб.</div>
    </li>
    <!-- Пример товара 2 -->
    <li class="product">
        <div class="product-name">Ноутбук Lenovo</div>
        <div class="product-title">i7, 8 ГБ RAM, SSD 512 ГБ</div>
        <div class="product-price">50 000 руб.</div>
    </li>
    <!-- Добавьте больше товаров по аналогии -->
</ul>

</body>
</html>
