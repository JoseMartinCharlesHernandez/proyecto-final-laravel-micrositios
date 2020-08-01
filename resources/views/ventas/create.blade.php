@extends('layouts.app')

@section('content')
          <!-- Default box -->
          <div class="card card-solid">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="col-6" >
                    <img src="{{ $producto->imagen_url}}"  class="product-image" alt="Product Image">
                  </div>

                </div>  
               <form class="col-12 col-sm-6" action="{{ route('ventas.store')}}" method="GET">
                    <div class="col-12 col-sm-6 col-md-8 d-flex align-items-stretch">
                        <div class="card bg-light">
                          <div class="card-header text-muted border-bottom-0">
                          </div>
                          <div class="card-body pt-0">
                            <div class="row">
                              <div class="col-7">
                              <h2 class="lead"><b>{{$micrositio->nombre}}</b></h2>
                              <p class="text-muted text-sm"><b>Dirección: </b>{{ $micrositio->direccion}}</p>
                              <p class="text-muted text-sm"><b>Descripción: </b>{{ $micrositio->descripcion}}.</p>
                              </div>
                              <div class="col-4 text-center">
                              <img src="{{$micrositio->logo_url}}" alt="" class="img-circle img-fluid">
                              </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <div class="text-right">
                            <a href="{{route('micrositios.show',['id'=>$micrositio->id]) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-eye"></i> ver
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                  <hr>
                  <h3 class="mt-3"><b>Producto: </b><small>{{ $producto->nombre}}</small></h3>    
                  <h4 class="mt-3">Cantidad:</h4>
                  <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <input type="number"  class="form-control" name="cantidad" id="cantidad" value="1" min="1" max="100">
                  </div>
    
                  <div class="bg-gray py-2 px-3 mt-4">
                    <h2 class="mb-0" >
                      c/u ${{$producto->precio}}
                    </h2>
                     <input type="number" name="precio" id="precio" value="{{ $producto->precio}}" hidden>
                    <h4 class="mt-0">
                      <small id="total"></small>
                    </h4>
                  </div>

                  <input type="text" name="nombre" value="{{ $producto->nombre}}" hidden>
                  <input type="number" id="id_producto" name="id_producto" value="{{ $producto->id}}" hidden>
                  <input type="number" name="id_empresario" value="{{ $micrositio->id_empresario}}" hidden>
                  <input type="number" id="id_micrositio" name="id_micrositio" value="{{ $micrositio->id}}" hidden>

                  <div class="mt-4"> 
                        <button type="submit" class=" btn btn-success btn-lg btn-flat mr-2" ><i class="fas fa-shopping-cart" style="color: white"></i> comprar</button>
                        <button id="btn_quotation" class=" btn btn-primary btn-lg btn-flat mr-2" ><i class="fas fa-envelope" style="color: white"></i> Cotizzar a mi correo</button>
                  </div>    
            </form>    
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    
@endsection



@section('css')
   <!-- SweetAlert2 -->
   <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
   <!-- Toastr -->
   <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
@endsection

@section('js')
 <script>
     var ui_cantidad =  document.getElementById('cantidad');
     var ui_total = document.getElementById('total');
     var ui_precio = document.getElementById('precio');   

     console.log(ui_precio)
     ui_cantidad.addEventListener('change', function (evt) {
       // something(this.value);
       ui_total.innerHTML = "Total: $"+this.value * ui_precio.value
       //alert('total = '+ui_total)
    });

    console.log(ui_cantidad)

 </script> 
 
 <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
 <script src="../../plugins/toastr/toastr.min.js"></script>
 <script>
    document.getElementById('btn_quotation').addEventListener("click",sendEmail);

    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    //se envian los datos por medio de una petición ajax tipo get
    function sendEmail(){
        event.preventDefault();

        id_producto = document.getElementById('id_producto').value
        cantidad = document.getElementById('cantidad').value
        id_micoristio = document.getElementById('id_micrositio').value
        
        $.ajax({
          url: "/send/quotation/emal",
          type: "GET",
          data:{
              id_producto: id_producto,
              cantidad: cantidad,
              id_micoristio: id_micoristio
          } , 
          success: function(respuesta) {
              console.log(JSON.parse(respuesta))
                Toast.fire({
                  icon: 'success',
                  title: 'Se envio con exito la cotización.'
                })
          },
          error: function() {
             Toast.fire({
                icon: 'error',
                title: 'Algo salío mal, no se envió la cotización.'
              })
          }
      });


    }

 </script>
@endsection