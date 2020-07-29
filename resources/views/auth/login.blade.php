@extends('layouts.login ')
@section('content')
<div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>Buscador de </b>Micrositios</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Ingresa para Iniciar Sesión</p>
  
        <form method="POST" action="{{ route('login') }}">
            @csrf

          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
        
            @error('email')
            <div class="input-group mb-3">
              <p class="text-danger">
                  <strong>datos invalidos!</strong>
              </p>
            </div>
           @enderror

          <div class="input-group mb-3">
            <input type="password" id="password" class="form-control" placeholder="Password" name="password" required autocomplete="current-password" >

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

            @error('password')
            <div class="input-group mb-3">
                <p class="text-danger">
                    <strong>datos invalidos!</strong>
                </p>
            </div>
           @enderror

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">
                  recordarme
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        @guest
        @if (Route::has('register'))
            <div class="social-auth-links text-center mb-3">
                <p class="mb-0">
                  <a href="{{ route('register') }}" class="text-center">Registrarme como nuevo miembro</a>
                </p>
          </div>
        @endif
        <div class="social-auth-links text-center mb-3">
          <p class="mb-0">
            <a href="{{ route('password.reset') }}" class="text-center">Olvidé mi contraseña</a>
          </p>
    </div>

    @else
        <div class="social-auth-links text-center mb-3">
            <p class="mb-0">
              <a href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();" class="text-center">Salir</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </p>
            
      </div>
    @endguest
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
@endsection
