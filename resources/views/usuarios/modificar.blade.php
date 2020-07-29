@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="row justify-content-center">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Modificar Usuario</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
            <form role="form" method="GET" action="{{route('usuarios.update',['id'=>$usuario->id])}}" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label for="name_">Nombre</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Jon Doe" value="{{ $usuario->name}}">
                        @if ($errors->has('name'))
                            <div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
                        @endif
                            <div id="error_user_id" class="col-form-label" style="color:red; display:none;"></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electronico</label>
                    <input type="email"  class="form-control" id="email" placeholder="ejemplo@ejemplo" value="{{$usuario->email}}" disabled>
                        @if ($errors->has('email'))
                          <div class="col-form-label" style="color:red;">{{$errors->first('email')}}</div>
                         @endif
                          <div id="error_email" class="col-form-label" style="color:red; display:none;"></div>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="{{$usuario->password}}">
                        @if ($errors->has('password'))
                             <div class="col-form-label" style="color:red;">{{$errors->first('password')}}</div>
                       @endif
                             <div id="error_password" class="col-form-label" style="color:red; display:none;"></div>
                    </div>
                    <div class="form-group">
                    <label for="tipo_usuario">Tipo</label>
                    <select class="form-control" name="type" id="">
                   {{-- <option value="{{$usuario->type}}" selected disabled>{{ $usuario->type==2 ? 'manager' : 'usuario' }} </option>
                    --}} 
                       @foreach ($tipos as $item)
                            <option value="{{$item->id}}" {{$usuario->type==$item->id ? 'selected' : '' }} >{{$item->tipo}}</option>   
                        @endforeach
                    </select>
                    @if ($errors->has('type'))
                    <div class="col-form-label" style="color:red;">{{$errors->first('type')}}</div>
                    @endif
                    <div id="error_type" class="col-form-label" style="color:red; display:none;"></div>
                    </div>

                        {{--  <div class="form-group">
                                <label for="exampleInputFile">Fotografia</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input name="avatar_url" type="file"  id="exampleInputFile" accept="image/*">
                                    <label class="custom-file-label" for="exampleInputFile">Seleccionar archivo</label>
                                    @if ($errors->has('avatar_url'))
                                    <div class="col-form-label" style="color:red;">{{$errors->first('avatar_url')}}</div>
                                @endif
                                    <div id="error_user_id" class="col-form-label" style="color:red; display:none;"></div>
                                </div>
            
                                </div>
                            </div> --}}
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Actualzar</button>
                    </div>
                </form>
                </div>
                <!-- /.card -->
            </div>
            </div>
        </div>    
@endsection