<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <!-- Предполагаем, что у вас есть шаблон для формы с CSRF токеном -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="POST">
        @csrf

        <!-- Поле для названия товара -->
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <!-- Поле для описания товара -->
        <div class="form-group">
            <label for="title">Описание</label>
            <textarea class="form-control" id="title" name="title"></textarea>
        </div>

        <!-- Поле для загрузки изображения товара -->
        <div class="form-group">
            <label for="image">Изображение</label>
            <input type="file" class="form-control-file" id="product_image" name="product_image">
        </div>

        <!-- Поле для цены товара -->
        <div class="form-group">
            <label for="price">Цена</label>
            <input type="number" step="any" class="form-control" id="price" name="price" required>
        </div>

        <!-- Кнопка отправки формы -->
        <button type="submit" class="btn btn-primary">Добавить товар</button>
    </form>
</body>

</html>
