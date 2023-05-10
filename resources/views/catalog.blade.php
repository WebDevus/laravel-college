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
                    <label class="form-label">Упорядочить по</label>
                    <select name="sort" class="form-control">
                        <option value="">Выбрать...</option>
                        <option value="yearDESC" {{ request()->sort == 'yearDESC' ? 'selected' : '' }}>По году производства (Новое - старое)</option>
                        <option value="yearASC" {{ request()->sort == 'yearASC' ? 'selected' : '' }}>По году производства (Старое - новое)</option>
                        <option value="nameASC" {{ request()->sort == 'nameASC' ? 'selected' : '' }}>По наименованию (А-я)</option>
                        <option value="nameDESC" {{ request()->sort == 'nameDESC' ? 'selected' : '' }}>По наименованию (Я-а)</option>
                        <option value="priceASC" {{ request()->sort == 'priceASC' ? 'selected' : '' }}>По цене (Дешевле - дороже)</option>
                        <option value="priceDESC" {{ request()->sort == 'priceDESC' ? 'selected' : '' }}>По цене (Дороже - дешевле)</option>
                    </select>
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
                    <button type="submit" class="btn btn-success">Фильтровать</button>
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
                            <a href="#" id="addToCartButton" data-product="{{ $product->id }}" class="header_button btn btn-info">Купить</a>
                            @endauth
                            <a href="{{ route('product', $product) }}">Подробнее</a>
                        </div>
                    </div>
                @endforeach

                @if(count($products) < 1)
                    <p>Товаров нет</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection