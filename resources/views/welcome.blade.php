<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/main.css">
    <title>Магазин Сантехники</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>

    <header id="glav">
      <div class="col-lg-12 flex-wrap container-fluid">
        <div class="row">
          <div class="d-flex justify-content-center align-items-center">
            <div class="d-flex justify-content-center align-items-center logo" onclick="window.location.href = '/'">
              <img src="/assets/images/logo.png">
            </div>
            <div class="navigation">
              <nav>
                  <ul class="d-flex justify-content-between flex-wrap ul-class">
                    <li><a href="{{ route('catalog') }}">Каталог</a></li>
                    <li><a href="{{ route('contacts') }}">Где нас найти?</a></li>

                    @auth
                    <li><a href="{{ route('cart') }}">Корзина</a></li>

                    @if(auth()->user()->login == 'admin')
                    <li><a href="{{ route('admin.index') }}">Админка</a></li>
                    @endif

                    @endauth

                    @auth
                    <li><a href="{{ route('logout') }}" class="header_button btn btn-info">Выйти</a></li>
                    @endauth

                    @guest
                      <li><a href="{{ route('auth') }}" class="header_button btn btn-info">Авторизация</a></li>
                      <li><a href="{{ route('register') }}" class="header_button btn btn-info">Регистрация</a></li>             
                    @endguest
                  </ul>
              </nav>
            </div>
            </div>
          </div>
        </div>
      </header>

      <main>
        <div class="container">
          <p id="errorResponse" class="text-red"></p>
          @if(session('success'))
        <section id="alert">
              <div class="text-green" id="successResponse">{{ session('success') }}</div>
        </section>
        @elseif(session('error'))
        <section id="alert">
          <div class="text-red" id="errorResponse">{{ session('error') }}</div>
        </section>
        @endif

        @yield('content')
        </div>
      </main>

      <footer>
        <div class="container">
          <div class="d-flex justify-content-center align-items-center logo-footer flex-column">
            <img src="/assets/images/logo.png" alt="Logo">
            <div class="number-footer">Номер для связи: 7 913 685-22-22</div>
          </div>
        </div>
      </footer>

      <script src="/assets/js/jquery.js"></script>
      <script type="text/javascript" src="/assets/js/slick.min.js"></script>
      <script src="/assets/js/main.js"></script>
    <script src="/assets/js/bootstrap.js"></script>
  </body>
</html>