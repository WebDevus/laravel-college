@extends('welcome')
@section('content')
<section id="contacts">
    <div class="title_contact text-center">
        <h1>Где нас найти</h1>
    </div>
    <div class="section_contact d-flex">
        <div class="map_section ">
            <img src="/public/map.png" alt="">
        </div>
        <div class="info_contact d-flex justify-content-center flex-column">
            <h2>Адрес: Комарова 13</h2>
            <h2>E-mail: nzxtpc@gmail.com</h2>
            <h2>Номер телефона: 7 (913) 685-22-22</h2>
        </div>
    </div>
</section>
@endsection