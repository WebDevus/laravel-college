@extends('welcome')
@section('content')
<section id="admin">
    <nav aria-label="breadcrumb mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.categories') }}">Категории</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Товары</a></li>
        </ol>
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          Добавить
        </a>
    </nav>


      <div class="collapse mt-2" id="collapseExample">
        <form method="post" action="{{ route('productNew') }}" enctype="multipart/form-data" class="card card-body">
        @csrf
            <div class="mb-4">
                <label class="form-label">Название</label>
                <input type="text" name="name" class="form-control" />
            </div>

            <div class="mb-4">
                <label class="form-label">Описание</label>
                <input type="text" name="desc" class="form-control" />
            </div>

              <div class="form-outline mb-4">
                <label class="form-label">Год выпуска</label>
                <input type="text" name="year" class="form-control" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Страна выпуска</label>
                <input type="text" name="country" class="form-control"  />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Модель</label>
                <input type="text" name="model" class="form-control"  />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Цена</label>
                <input type="text" name="price" class="form-control"  />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Кол-во имеется</label>
                <input type="text" name="count" class="form-control" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Категория</label>
                <select name="category_id" class="form-control">
                    @foreach ($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Картинка</label>
                <input type="file" name="image" class="form-control" />
              </div>

              <button type="submit" class="btn btn-success">Добавить</button>
        </form>
      </div>

    <div class="d-flex justify-content-center align-items-center flex-column mt-4">
        <div class="title mb-2">Список товаров</div>
        @foreach ($products as $product)
        <div class="product-wrapper d-flex">
            <a href="{{ route('admin.products.show', $product) }}" class="category-list mb-2">
                {{ $product->name }}
            </a>
            <a href="{{ route('admin.products.delete', $product) }}" class="ms-4 text-red" title="Удалить">X</a>
        </div>
        @endforeach
    </div>
</section>

@endsection