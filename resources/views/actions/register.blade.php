@extends('welcome')
@section('content')
<section id="register">
    <div class="container py-5 h-100">
      <form class="row d-flex justify-content-center align-items-center h-100" action="{{ route('register.post') }}" method="post">
        @csrf
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong">
            <div class="card-body p-5 text-center" style="box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(90, 125, 188, 0.05) 0px 0.25em 1em;">
  
              <h3 class="mb-5">Регистрация</h3>
  
              <div class="form-outline mb-4">
                <label class="form-label">Name *</label>
                <input type="text" name="name" class="form-control form-control-lg" />
              </div>
  
              <div class="form-outline mb-4">
                <label class="form-label">Surname *</label>
                <input type="text" name="surname" class="form-control form-control-lg" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Patronymic</label>
                <input type="text" name="patronymic" class="form-control form-control-lg" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Login *</label>
                <input type="text" name="login" class="form-control form-control-lg" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control form-control-lg" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Пароль *</label>
                <input type="password" name="password" class="form-control form-control-lg" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Повтор пароля *</label>
                <input type="password" name="password_repeat" class="form-control form-control-lg" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label">Согласие с правилами регистрации</label>
                <input type="checkbox" name="rules" />
              </div>
  
              <button class="btn btn-primary btn-lg btn-block" type="submit">Регистрация</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
@endsection