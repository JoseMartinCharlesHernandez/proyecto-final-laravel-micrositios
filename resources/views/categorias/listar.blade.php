@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <!-- /.card -->      
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">categorias</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nombre</th>
              <th>Estatus</th>
              <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
             @foreach ($categorias as $item)
             <tr>
                <td>{{ $item->nombre}}</td>
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
                  <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning" title="modificar"><a href="{{route('categorias.edit',['id'=>$item->id])}}}"><i class="fas fa-wrench" style="color: black"></i></a></button>
                        @if ($item->id_estatus==1)
                        <button type="button" class="btn btn-danger" title="eliminar"><a href="{{ route('categorias.destroy',['id'=>$item->id]) }}"><i class="fas fa-trash" style="color: white"></i></a></button>                        
                    @else
                       <button type="button" class="btn btn-success" title="restaurar"><a href="{{ route('categorias.restore',['id'=>$item->id]) }}"><i class="fas fa-retweet" style="color: white"></i></a></button>
                    @endif
                    </div>
                </td>            
             </tr>
             @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>Nombre</th>
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


<!-- Ekko Lightbox -->
<script src="../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Filterizr-->
<script src="../plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>

    <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
          });
        });
      </script>


@endsection