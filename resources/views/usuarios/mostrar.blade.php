@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                   src="https://api.adorable.io/avatars/285/{{$usuario->email}}.png"
                   alt="User profile picture">
            </div>

        <h3 class="profile-username text-center">{{$usuario->name}}</h3>

        <p class="text-muted text-center">{{ $usuario->email}}</p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Estatus</b> <a class="float-right">                       
                 @switch($usuario->id_estatus)
                    @case(1)
                        <span class="badge badge-success">{{$usuario->estatus}}</span>       
                        @break
                    @case(2)
                        <span class="badge badge-danger">{{$usuario->estatus}}</span>
                        @break
                    @case(3)
                        <span class="badge badge-secondary">{{$usuario->estatus}}</span>
                        @break
                    @case(4)
                    <span class="badge badge-warning">{{$usuario->estatus}}</span>
                    @break
                    @case(5)
                    <span class="badge badge-primary">{{$usuario->estatus}}</span>
                    @break   
                    @default   
                @endswitch</a>
              </li>
              <li class="list-group-item">
              <b>Tipo</b> <a class="float-right">{{$usuario->tipo}}</a>
              </li>
            </ul>

            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

    </div>
    <!-- /.row -->

    
  </div><!-- /.container-fluid -->  
@endsection