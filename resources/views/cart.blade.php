@extends('welcome')
@section('content')
<section id="cart">
        <h2 class="title">
            Корзина@if($carts->count() < 1), тут пусто@endif
        </h2>
        <div class="cart-block">
            <div class="cart-items order-md-1 order-0">
                @foreach ($carts as $cart)

                <div class="cart-item d-flex justify-content-between mb-2">
                    <div class="cart-pic-box">
                        <img src="/assets/images/products/{{ $cart->product->image }}" alt="">
                    </div>
                    <div class="text-box d-flex align-items-center justify-content-center flex-column" >
                        <p class="card-title mb-0 me-2 fw-bold">{{ $cart->product->name }}</p>
                        <div class="count-box d-flex align-items-center">
                            <a href="{{ route('removeFromCart', $cart->product->id) }}" class="add-rem">-</a>
                            <p class="count ms-2 me-2">{{ $cart->count }} шт</p>
                            <a href="{{ route('addToCart', $cart->product->id) }}" class="add-rem me-3">+</a>
                        </div>
                        <p class="price">Итог: {{ $cart->product->price * $cart->count }} руб.</p>
                    </div>
                    <a href="{{ route('deleteFromCart', $cart->id) }}" class="header_button btn btn-info d-flex align-items-center">Удалить</a>
                </div>
                @endforeach
            </div>
        </div>

        @if($carts->count() >= 1)
        <form action="{{ route('cartNext') }}" method="post" class="d-flex flex-column">
            @csrf
            <div class="form-title">Оформление заказа</div>
            <input type="password" placeholder="Ваш пароль" class="form-control" name="password">
            <button type="submit" class="btn btn-success mt-2">Оформить</button>
        </form>
        @endif
</section>

<section id="orders" class="mt-4">
    <h2 class="title">
        Ваши заказы
    </h2>

    <div class="cart-block">
        <div class="cart-items order-md-1 order-0">
            @foreach ($orders as $order)

            <div class="cart-item d-flex justify-content-between">
                <div class="cart-pic-box">
                    <img src="/assets/images/products/{{ $order->product->image }}" alt="">
                </div>
                <div class="text-box d-flex justify-content-center align-items-center flex-column" >
                    <p class="card-title mb-0 me-2 fw-bold">{{ $order->product->name }}</p>
                    <p class="price me-2">Итог: {{ $order->product->price * $order->count }} руб</p>
                    <p class="count me-2">Штук: {{ $order->count }}</p>
                    <p class="status">Статус: {{ $order->currentStatus() }}</p>
                </div>
                @if($order->status <= 1)
                <a href="{{ route('deleteOrder', $cart->id) }}" class="header_button btn btn-info d-flex align-items-center">Удалить</a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection