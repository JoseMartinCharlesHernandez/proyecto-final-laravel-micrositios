@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <!-- /.card -->      
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Micrositios</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nombre</th>
              <th>categoria</th>
              <th>Dirección</th>
              <th>Lat</th>
              <th>Lng</th>
              <th>Empresario</th>
              <th>Estatus</th>
              <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
             @foreach ($micrositios as $item)
             <tr>
                <td>{{ $item->nombre}}</td>
                <td>{{ $item->categoria}}</td>
                <td>{{ $item->direccion}}</td>
                <td>{{ $item->lat}}</td>
                <td>{{ $item->lng}}</td>
                <td>{{ $item->empresario}}</td>
                <td>
                    @switch($item->id_estatus)
                        @case(1)
                            <span class="badge badge-success">activo</span>       
                                @break
                        @case(2)
                            <span class="badge badge-danger">inactivo</span>
                            @break            
                        @case(3)
                        <span class="badge bg-warning">suspendido</span>
                            @break
                        @case(4)
                        <span class="badge badge-info">pendiente</span> 
                            @break>   
                        @case(5)
                        <span class="badge badge-dark">rechazado</span> 
                        @break   
                        @case(6)
                        <span class="badge badge-primary">nuevo</span> 
                        @break   
                    @endswitch
                </td>
                  <td>
                  <button type="button" class="btn btn-primary" title="ver logo"><a href="{{ $item->logo_url}}" data-toggle="lightbox" data-title="{{$item->nombre}}" data-gallery="gallery">
                      <i class="fas fa-eye" style="color: white"></i>
                    </a></button>

                  <div class="btn-group">
                  <button type="button" class="btn btn-warning" title="modificar"><a href="{{route('micrositios.edit',['id'=>$item->id])}}"><i class="fas fa-wrench" style="color: black"></i></a></button>
                    @if ($item->id_estatus==1)
                    <button type="button" class="btn btn-danger" title="eliminar"><a href="{{ route('micrositios.destroy',['id'=>$item->id]) }}"><i class="fas fa-trash" style="color: white"></i></a></button>                        
                  @else
                     <button type="button" class="btn btn-success" title="restaurar"><a href="{{ route('micrositios.restore',['id'=>$item->id]) }}"><i class="fas fa-retweet" style="color: white"></i></a></button>
                  @endif
                  </div>
                </td>            
             </tr>
             @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th>Nombre</th>
              <th>categoria</th>
              <th>Dirección</th>
              <th>Lat</th>
              <th>Lng</th>
              <th>Empresario</th>
              <th>Estatus</th>
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