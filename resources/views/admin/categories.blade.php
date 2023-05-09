@extends('welcome')
@section('content')
<section id="admin">
    <nav aria-label="breadcrumb mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.categories') }}">Категории</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Товары</a></li>
        </ol>
    </nav>

    <form action="{{ route('admin.categories.create') }}" method="post">
        @csrf
        <div class="form-group-custom d-flex flex-column col-12">
            <label class="form-label">Создание категории</label>
            <input type="text" placeholder="Название категории" name="category" class="form-control">
            <button type="submit" class="btn btn-success mt-2">Создать</button>
        </div>
    </form>

    <div class="d-flex justify-content-center align-items-center flex-column mt-4">
        <div class="title">Список категорий</div>
        @foreach ($categories as $category)
            <div class="category-list d-flex mb-2">
                {{ $category->name }}
                <a href="{{ route('admin.categories.delete', $category->id) }}" class="ms-4 text-red" title="Удалить">X</a>
            </div>
        @endforeach
    </div>
</section>

@endsection