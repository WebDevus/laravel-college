@extends('welcome')
@section('content')
<section id="auth">
    <div class="container py-5 h-100">
      <form class="row d-flex justify-content-center align-items-center h-100" action="{{ route('auth.post') }}" method="post">
        @csrf
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong">
            <div class="card-body p-5 text-center" style="box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(90, 125, 188, 0.05) 0px 0.25em 1em;">
  
              <h3 class="mb-5">Вход</h3>
  
              <div class="form-outline mb-4">
                <label class="form-label">Login</label>
                <input type="text" name="login" class="form-control form-control-lg" />
              </div>
  
              
              <div class="form-outline mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control form-control-lg" />
              </div>
  
              <button class="btn btn-primary btn-lg btn-block" type="submit">Регистрация</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
@endsection