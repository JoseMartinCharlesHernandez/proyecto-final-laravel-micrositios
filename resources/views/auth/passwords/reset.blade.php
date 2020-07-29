@extends('layouts.login')

@section('content')
<div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>Buscador de Micrositios</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">¿Olvidaste tu Contraseña?<br> A continuación escribe tu correo y te será enviada una nueva.</p>
  
      <form method="get" action="{{ route('password.send') }}">
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Correo">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          @error('email')
          <div class="input-group mb-3">
            <p class="text-danger">
            <strong>{{ $errors->first('email')}}</strong>
            </p>
          </div>
         @enderror

          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Enviar nueva contraseña</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <div class="social-auth-links text-center mb-3">
            <p class=" mb-0 ">
            <a  href="{{ route('login') }}" class="text-center">Iniciar sesión</a>
            </p>
            <p class="mb-0">
            <a href="{{ route('register') }}" class="text-center">Registrarse</a>
            </p>
        </div>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
@endsection
