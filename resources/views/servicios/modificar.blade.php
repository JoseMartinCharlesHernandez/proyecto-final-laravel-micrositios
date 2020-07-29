@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="row justify-content-center">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Modificar Servicio</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
            <form role="form" method="GET" action="{{ route('servicios.update',['id'=>$servicio->id]) }}" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Nombre del servicio" name="nombre" value="{{$servicio->nombre}}">                        
                        @error('nombre')
                            <div class="col-form-label" style="color:red;">{{ $message }}</div>
                        @enderror    
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputPassword1">Precio</label>
                        <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio" placeholder="precio" name="precio" value="{{$servicio->precio}}">
                        @error('precio')
                        <div class="col-form-label" style="color:red;">{{ $message }}</div>
                        @enderror    
                    </div>
                    <div class="form-group">
                        <a href="{{$servicio->imagen_url}}"></a>    
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Imagen</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="imagen" class="custom-file-input" id="imagen">
                            <label class="custom-file-label" for="exampleInputFile">Seleccionar Imagen</label>
                        </div>
                        </div>
                    </div>

                    @if(Auth::user()->type==1)
                        <div class="form-group">
                            <label for="micrositios">Micrositio</label>
                            <select class="form-control" name="micrositio" required>
                                @foreach ($micrositios as $item)
                                    <option value="{{$item->id}}" {{$servicio->id_micrositio == $item->id ? 'selected' : '' }} >{{$item->nombre}}</option>   
                                @endforeach
                            </select>
                            @if ($errors->has('micrositio'))
                            <div class="col-form-label" style="color:red;">{{$errors->first('micrositio')}}</div>
                            @endif
                            <div id="error_type" class="col-form-label" style="color:red; display:none;"></div>
                        </div>    
                    @endif

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
                </div>
                <!-- /.card -->
            </div>
            </div>
        </div>    
@endsection