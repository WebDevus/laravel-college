@extends('welcome')
@section('content')
    <section id="about">
            <div class="d-flex justify-content-center">
                <h1>О нас</h1>
            </div>

        <div class="about_section">
            <div class="txt_about text-center">
                В нашем интернет-магазине сантехники "МГЗ Сантехник" вы можете преобрести вентили, краны, трубы, сифоны и так далее. Поможем, подберём, решим вашу проблему
            </div>
            <div class="d-flex justify-content-center logo_about">
              <img src="/assets/images/logo.png">
            </div>
        </div>

        <div class="slider-cover">
            <div class="multiple-items">
                @foreach ($products as $item)
                    <a href="{{ route('product', $item) }}" class="items-cor">
                        <img src="/assets/images/products/{{ $item->image }}" alt="{{ $item->name }}">
                        <span>{{ $item->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
        
    </section>
@endsection