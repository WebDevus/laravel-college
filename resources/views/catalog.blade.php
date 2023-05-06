@extends('welcome')
@section('content')
<section id="pom">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center align-items-center text">
                <h4>Каталог</h4>
            </div>
            <div class="d-flex justify-content-around flex-wrap services">
                @foreach ($products as $product)
                    <div class="d-flex flex-column block">
                        <div class="d-flex justify-content-center flex-column">
                            <div class="image">
                                <img src="/assets/images/products/{{ $product->image }}" class="img-fluid">
                            </div>
                        </div>
                        <div class="inform">
                            <div class="name">{{ $product->name }}</div>
                            <div class="desc">{{ $product->desc }}</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center information">
                            @auth
                            <a href="{{ route('addToCart', $product->id) }}" class="header_button btn btn-info">Купить</a>
                            @endauth
                            <a href="{{ route('product', $product) }}">Подробнее</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection