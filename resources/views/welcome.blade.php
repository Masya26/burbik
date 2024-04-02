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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <style>
            h1{color: red;}
            .search-form {
                position: relative;
                width: auto;
                height: 40px;
                border-radius: 5px;
                box-shadow: 0 0px 0px rgba(0, 0, 0, 0.15);
                background: #fff;
                transition: all 0.3s ease;
            }
            .search-input {
                /* position: relative;
                top: 8px;
                left: 10px; */
                font-size: 14px;
                background: none;
                color: #5a6674;
                width: 270%;
                height: 20px;
                border: none;
                appearance: none;
                outline: none;
            }
            .search-button {
                /* position: relative;
                top: 8px; */
                /* left: 335px; */
                height: 20px;
                width: 20px;
                padding: 0;
                margin: 0;
                border: none;
                background: none;
                outline: none!important;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div style="margin: 0 13%">
            {{-- Шапка --}}
            <div style="display:flex;justify-content: center;" class="border-bottom pb-2">
                <img src="images\logo.png" style="width: 12%; ;" class="">
            </div>
            {{-- Основная часть --}}
            <div style="display:grid; grid-template-columns: 15% 75% auto;" class="border-bottom pt-2 pb-2">
                <div class="">
                    <span class=" badge fw-bold fs-6 pt-2" style="background: rgb(11, 178, 255); color: white; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; width: 212px; height: 40px; text-align:center;"> Каталог товаров
                        <i class="fa fa-angle-down" style="font-size:18px; position:relative; top:2px; left:2px;"></i>
                    </span>
                </div>
                <div class="px-2">
                    <form action="" method="get" class="search-form border pt-2">
                        <div style="display:flex; justify-content: space-between; padding:0 5px 0 5px;">
                            <input name="s" placeholder="Введите название товара" type="search" class="search-input">
                            <button type="submit" class="search-button">
                                <i class="bi bi-search" style="font-size:18px"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="border-start px-2">
                    <a>
                        <i class="bi bi-basket2 fs-4" style="color: rgb(11, 178, 255)"></i>
                        <span class="fw-bold fs-6" style="color: rgb(11, 178, 255); font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; width: auto; height: 40px; text-align:center;"> 0.00Р
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>
