@extends('layouts.app')


@section('content')
          <!-- Default box -->
          <div class="card card-solid">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
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
                        <input type="number"  class="form-control" id="cantidad" value="1" min="1" max="100">
                  </div>
    
                  <div class="bg-gray py-2 px-3 mt-4">
                    <h2 class="mb-0" >
                      c/u ${{$producto->precio}}
                    </h2>
                     <input type="number" id="precio" value="{{ $producto->precio}}" hidden>
                    <h4 class="mt-0">
                      <small id="total"></small>
                    </h4>
                  </div>
                  <div class="mt-4"> 
                        <button type="submit" class=" btn btn-success btn-lg btn-flat mr-2" ><i class="fas fa-shopping-cart" style="color: white"></i> comprar</button>
                        <button type="submit" class=" btn btn-primary btn-lg btn-flat mr-2" ><i class="fas fa-envelope" style="color: white"></i> Cotizzar a mi correo</button>
                  </div>    
            </form>    
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    
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
@endsection