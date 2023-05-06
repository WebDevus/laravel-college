@extends('welcome')
@section('content')
<section id="product">
        <div class="prod-items">
            <div class="prod-img-box">
                <img src="/assets/images/products/{{ $product->image }}" alt="" class="prod-img">
            </div>
            <div class="prod-wrapper d-flex justify-content-between align-items-center">
                <div class="product-info">
                    <h1 class="product-name">{{ $product->name }}</h1>
                        <div class="sell-box d-flex align-items-center">
                        @if (auth()->user())
                            <a href="{{ route('addToCart', $product->id) }}" class="header_button btn btn-info me-2">Купить</a>
                        @endif
                        <p class="price">{{ $product->price }} руб.</p>
                    </div>
                    <p class="text desc">{{ $product->desc }}</p>
                </div>
                <div class="prod-param">
                    <h3 class="title">Характеристики</h3>
                    <ul class="prod-param-items">
                        <li class="prod-param-item">
                            <p>Дата производства: {{ $product->year }}</p>
                        </li>
                        <li class="prod-param-item">
                            <p>Страна производитель: {{ $product->country }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</section>

@endsection