@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <!-- /.card -->      
      <div class="card">
        <div class="card-header">
          <div class="float-right">
            <button  type="button" class="btn btn-lg btn-success " title="crear usuario"><a href="{{ route('usuarios.crear') }}"><i class="fas fa-user-plus" style="color: white"></i></a></button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Tipo</th>
              <th>Estatus</th>
              <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
               @foreach ($usuarios as $item)
               <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name }}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->tipo}}</td>
                <td>
                  @switch($item->id_estatus)
                      @case(1)
                          <span class="badge badge-success">{{$item->estatus}}</span>       
                          @break
                      @case(2)
                          <span class="badge badge-danger">{{$item->estatus}}</span>
                          @break
                       @case(3)
                          <span class="badge badge-secondary">{{$item->estatus}}</span>
                          @break
                        @case(4)
                        <span class="badge badge-warning">{{$item->estatus}}</span>
                        @break
                        @case(5)
                        <span class="badge badge-primary">{{$item->estatus}}</span>
                        @break   
                      @default   
                  @endswitch
                </td>

                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-info" title="ver"><a href="{{route('usuarios.show',['id'=>$item->id])}}}"><i class="fas fa-eye" style="color: white"></i></a></button>
                    <button type="button" class="btn btn-warning" title="modificar"><a href="{{ route('usuarios.edit',['id'=>$item->id])}}"><i class="fas fa-wrench" style="color: black"></i></a></button>
                      @if ($item->id_estatus==1)
                        <button type="button" class="btn btn-danger" title="eliminar"><a href="{{ route('usuarios.destroy',['id'=>$item->id]) }}"><i class="fas fa-trash" style="color: white"></i></a></button>                        
                      @else
                         <button type="button" class="btn btn-success" title="restaurar"><a href="{{ route('usuarios.restore',['id'=>$item->id]) }}"><i class="fas fa-retweet" style="color: white"></i></a></button>
                      @endif
                    </div>
                 </td>
              </tr>
               @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Tipo</th>
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
            "autoWidth": true,
          });
        });
      </script>
@endsection