@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <!-- /.card -->      
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">servicios</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nombre</th>
              <th>Precio</th>
              @if(Auth::user()->type==1)
                 <th>Estatus</th>
                 <th>Micrositio</th>
              @endif
              <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
             @foreach ($servicios as $item)
             <tr>
                <td>{{ $item->nombre}}</td>
                <td>${{ $item->precio}}</td>
                @if(Auth::user()->type==1)
                  <td>
                    @switch($item->id_estatus)
                        @case(1)
                            <span class="badge badge-success">activo</span>       
                              @break
                        @case(2)
                            <span class="badge badge-danger">inactivo</span>
                            @break            
                    @endswitch
                  </td>
                    <td>{{$item->micrositio}}</td> 
                @endif  
                  <td>
                    <button type="button" class="btn btn-primary" title="ver"><a href="{{$item->imagen_url}}" data-toggle="lightbox" data-title="{{$item->nombre}}" data-gallery="gallery">
                      <i class="fas fa-eye" style="color: white"></i>
                    </a></button>

                  <div class="btn-group">
                  <button type="button" class="btn btn-warning" title="modificar"><a href="{{ route('servicios.edit',['id'=>$item->id])}}"><i class="fas fa-wrench" style="color: black"></i></a></button>
                    @if ($item->id_estatus==1)
                    <button type="button" class="btn btn-danger" title="eliminar"><a href="{{ route('servicios.destroy',['id'=>$item->id]) }}"><i class="fas fa-trash" style="color: white"></i></a></button>                        
                  @else
                      @if(Auth::user()->type==1)
                     <button type="button" class="btn btn-success" title="restaurar"><a href="{{ route('servicios.restore',['id'=>$item->id]) }}"><i class="fas fa-retweet" style="color: white"></i></a></button>
                      @endif
                  @endif
                  </div>
                </td>            
             </tr>
             @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th>Nombre</th>
              <th>Precio</th>
              @if(Auth::user()->type==1)
                 <th>Estatus</th>
                 <th>Micrositio</th>
              @endif
              <th>Opciones</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection


@section('js')
    <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
          });
        });
      </script>


@endsection