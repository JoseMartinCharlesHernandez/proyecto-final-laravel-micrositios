@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="row justify-content-center">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Modificar Categoria</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
            <form role="form" method="GET" action="{{ route('categorias.update',['id'=>$categoria->id]) }}" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Nombre de la categoria" name="nombre" value="{{$categoria->nombre}}">                        
                            @error('nombre')
                                <div class="col-form-label" style="color:red;">{{ $message }}</div>
                            @enderror    
                        </div>
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