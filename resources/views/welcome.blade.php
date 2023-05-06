<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/main.css">
    <title>Магазин Сантехники</title>
  </head>
  <body>

    <header id="glav">
      <div class="col-lg-12 flex-wrap container-fluid">
        <div class="row">
          <div class="d-flex justify-content-center align-items-center">
            <div class="d-flex justify-content-center align-items-center logo">
              <img src="/assets/images/logo.png">
            </div>
            <div class="navigation">
              <nav>
                  <ul class="d-flex justify-content-between flex-wrap ul-class">
                    <li><a href="">Каталог</a></li>
                    <li><a href="">Корзина</a></li>
                    <li><a href="">Где нас найти</h5></a></li>
                    @auth
                    <li><a href="#">Выйти</a></li>
                    @endauth
                    @guest
                      <li><a href="#" class="header_button btn btn-info">Авторизация</a></li>
                      <li><a href="#" class="header_button btn btn-info">Регистрация</a></li>             
                    @endguest
                  </ul>
              </nav>
            </div>
            </div>
          </div>
        </div>
      </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>