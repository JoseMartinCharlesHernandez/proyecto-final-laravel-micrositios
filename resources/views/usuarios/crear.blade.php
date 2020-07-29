@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="row justify-content-center">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Crear Usuario</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
            <form role="form" method="POST" action="{{route('usuarios.store')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label for="name_">Nombre</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Jon Doe">
                        @if ($errors->has('name'))
                            <div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
                        @endif
                            <div id="error_user_id" class="col-form-label" style="color:red; display:none;"></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electronico</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="ejemplo@ejemplo">
                        @if ($errors->has('email'))
                          <div class="col-form-label" style="color:red;">{{$errors->first('email')}}</div>
                         @endif
                          <div id="error_email" class="col-form-label" style="color:red; display:none;"></div>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        @if ($errors->has('password'))
                             <div class="col-form-label" style="color:red;">{{$errors->first('password')}}</div>
                       @endif
                             <div id="error_password" class="col-form-label" style="color:red; display:none;"></div>
                    </div>
                    <div class="form-group">
                    <label for="tipo_usuario">Tipo</label>
                    <select class="form-control" name="type" id="">
                        <option value="" disabled selected>selecciona un tipo</option>
                        @foreach ($tipos as $item)
                            <option value="{{$item->id}}">{{$item->tipo}}</option>   
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
                            </div>
                           --}}
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">crear</button>
                    </div>
                </form>
                </div>
                <!-- /.card -->
            </div>
            </div>
        </div>    
@endsection