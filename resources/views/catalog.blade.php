@extends('welcome')
@section('content')
<section id="pom">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center align-items-center text">
                <h4>Каталог</h4>
            </div>
            <form method="GET" action="#" class="d-flex align-items-end">
                <div class="form-group-custom col-lg-2 me-4">
                    <label class="form-label">Год производства</label>
                    <input type="text" name="year" placeholder="Например: 2020" class="form-control" value="{{ request()->year }}">
                </div>
                <div class="form-group-custom col-lg-3 me-4">
                    <label class="form-label">Название товара</label>
                    <input type="text" name="name" placeholder="Например: Колено" class="form-control" value="{{ request()->name }}">
                </div>
                <div class="form-group-custom col-lg-3 me-2">
                    <label class="form-label">Категория товара</label>
                    <select name="category" class="form-control">
                        <option value="">Выбрать...</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request()->category == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group-custom col-lg-3">
                    <button type="submit" class="btn btn-success">Поиск</button>
                </div>
            </form>
            <div class="d-flex justify-content-around flex-wrap services mt-3">
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