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

    <form class="row d-flex justify-content-center align-items-center h-100" action="{{ route('admin.products.edit', $product) }}" method="post">
        @csrf
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong">
            <div class="card-body p-5 text-center" style="box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(90, 125, 188, 0.05) 0px 0.25em 1em;">
  
              <h3 class="mb-5">Редактирование: {{ $product->name }}</h3>
  
              <div class="form-outline mb-4">
                <label class="form-label">Название</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" />
              </div>
  
              <div class="form-outline mb-4">
                <label class="form-label">Описание</label>
                <input type="text" name="desc" class="form-control" value="{{ $product->desc }}" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Год выпуска</label>
                <input type="text" name="year" class="form-control" value="{{ $product->year }}"/>
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Страна выпуска</label>
                <input type="text" name="country" class="form-control" value="{{ $product->country }}" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Модель</label>
                <input type="text" name="model" class="form-control" value="{{ $product->model }}" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Цена</label>
                <input type="text" name="price" class="form-control" value="{{ $product->price }}" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Кол-во имеется</label>
                <input type="text" name="count" class="form-control" value="{{ $product->count }}" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Категория</label>
                <select name="category_id" class="form-control">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Картинка</label>
                <input type="file" name="image" class="form-control" />
              </div>
  
              <button class="btn btn-success btn-lg btn-block" type="submit">Редактировать</button>
            </div>
          </div>
        </div>
      </form>
</section>

@endsection