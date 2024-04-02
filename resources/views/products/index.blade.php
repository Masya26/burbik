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
                        src="{{ Storage::url('images/post/origin/' . $product->product_image) }}"
                        alt=""></p>
            </td>
            <td>
                {{ $product['created_at'] }}
            </td>
            {{-- <td lass="project-actions text-right">
                <a class="btn btn-info btn-sm" href="{{ route('$product.edit', [$product->id]) }}">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Редактировать
                </a>
                {{-- <form style="display:inline-block" method="POST"
                    action={{ route('$product.destroy', [$product->id]) }}>
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                        data-bs-placement="right" title="Удалить"><i
                            class="fa-solid fa-trash-can"></i></button>
                </form> --}}
            </td> --}}
        </tr>
    </ul>
@endforeach
</body>
</html>
