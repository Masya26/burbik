<div style="display:grid; grid-template-columns: 20% 20% 20% 20% 20%; padding: 1% 0 1% 0; width:100%">
    @if (isset($products))
    @foreach ($products as $product)
        <!-- Пример товара 1 -->
        <div style="margin: 0 auto; padding: 5% 2% 2% 2%;" class="products-block">
            <div style="text-align:center;">
                <img style="width:150px; height:150px; border-radius: 5px;"
                    src="{{ asset('storage/images/product/' . $product->product_image) }}" alt="">
                <br>
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
                        <form action="{{ route('products.addToCart', $product->id) }}" method="post">
                            @csrf
                            <button class="main-button" type="submit">
                                <div class="products-price">
                                    {{ $product['price'] }} ₽
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
        </div>
    @endforeach
    @endif
</div>
