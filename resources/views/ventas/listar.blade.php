@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <!-- /.card -->      
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Ventas</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>Micrositio</th>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Total</th>
              <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
             @foreach ($ventas as $item)
             <tr>
                <td>{{ $item->id}}</td>
                <td>{{ $item->micrositio}}</td>
                <td>{{ $item->producto}}</td>
                <td>{{ $item->cantidad}}</td>
                <td>${{ $item->total}}</td>
                <td>
                  <div class="btn-group">
                  @if($item->id_estatus==1)
                     <button type="button" class="btn btn-danger" title="eliminar"><a href="{{ route('ventas.destroy',['id'=>$item->id]) }}"><i class="fas fa-trash" style="color: white"></i></a></button>                        
                  @else
                      @if(Auth::user()->type==1)
                         <button type="button" class="btn btn-success" title="restaurar"><a href="{{ route('ventas.restore',['id'=>$item->id]) }}"><i class="fas fa-retweet" style="color: white"></i></a></button>
                      @endif
                  @endif
                  </div>
                </td>            
             </tr>
             @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th>ID</th>
              <th>Micrositio</th>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Total</th>
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