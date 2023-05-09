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

    <form method="GET" action="#" class="d-flex align-items-end">
        <div class="form-group-custom col-lg-3 me-2">
            <label class="form-label">Статус заказов</label>
            <select name="status" class="form-control">
                <option value="1" {{ request()->status == 1 ? 'selected' : '' }}>Новые</option>
                <option value="2" {{ request()->status == 2 ? 'selected' : '' }}>Подтвержденные</option>
                <option value="3" {{ request()->status == 3 ? 'selected' : '' }}>Отмененные</option>
            </select>
        </div>
        <div class="form-group-custom col-lg-3">
            <button type="submit" class="btn btn-success">Поиск</button>
        </div>
    </form>

    <div class="cart-block mt-4">
        <div class="cart-items order-md-1 order-0">
            @foreach ($orders as $order)

            <div class="cart-item d-flex justify-content-between align-items-center mb-4">
                <div class="text-box d-flex justify-content-between flex-column align-items-center" >
                    <p class="card-title mb-0 me-2 fw-bold">{{ $order->user->getFIO() }}</p>
                    <p class="price me-2">Итог: {{ $order->product->price * $order->count }} руб</p>
                    <p class="count me-2">Штук: {{ $order->count }}</p>
                    <p class="status">Время заказа: {{ $order->updated_at->format('d.m.Y H:i') }}</p>
                </div>
                <div class="buttons-actions">
                    @if($order->status != 2)
                    <a href="{{ route('admin.acceptOrder', $order->id) }}" class="header_button btn btn-success">Подтвердить</a>
                    @endif
                    @if($order->status != 3)
                    <a href="#" data-bs-toggle="modal" data-bs-target="#orderModal" data-order="{{ $order->id }}" onclick="modalAction({{ $order->id }})" id="order-cancel" class="header_button btn btn-danger">Отменить</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Отказ заказу <span id="orderNumber"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="get" action="{{ route('admin.cancelOrder') }}" class="modal-body">
          <input type="text" value="null" name="order" id="orderId" hidden>
          <input type="text" placeholder="Причина отказа" name="reason" class="form-control">
          <div class="mt-2">
              <button type="submit" class="btn btn-primary">Отменить заказ</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function modalAction(id) {
        const spanInModal = document.querySelector('span#orderNumber');
        spanInModal.textContent = id;
        const inputInModal = document.querySelector('input#orderId');
        inputInModal.value = id;
    }
  </script>
@endsection