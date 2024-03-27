<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        {{-- <link rel="preconnect" href="https://fonts.bunny.net"> --}}
        {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <style>
            h1{color: red;}
        </style>
    </head>
    <body>
        <div style="margin: 0 13%">
            {{-- Шапка --}}
            <div style="display:grid; grid-template-columns: 20% auto auto auto;" class="border-bottom pb-2">
                <div>
                    <img src="images\logo.png" style="width: 60%" class="">
                </div>
                <div class="bg-danger">
                    Что-то
                </div>
                <div class="bg-primary">
                    Что-то
                </div>
                <div class="bg-danger">
                    Что-то
                </div>
            </div>
            {{-- Основная часть --}}
            <div style="display:grid; grid-template-columns: 17% auto auto;" class="border-bottom pt-2 pb-2">
                <div class="">
                    <span class=" badge fw-bold fs-6" style="background: rgb(11, 178, 255); color: white; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; width: 200px; height: 35px; text-align:center;"> Каталог товаров
                        <i class="fa fa-angle-down" style="font-size:18px"></i>
                    </span>
                </div>
                <div class="bg-primary">
                    Тут будет строка поиска
                </div>
                <div class="bg-danger">
                    Корзина
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>
