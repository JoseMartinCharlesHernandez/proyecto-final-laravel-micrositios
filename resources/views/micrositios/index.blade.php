@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
            src="{{$existe ? $micrositio[0]->logo_url : '/logos/default.png' }}" 
                   alt="User profile picture">
            </div>

        <h3 class="profile-username text-center">{{ $existe ? $micrositio[0]->nombre : 'nombre'}}</h3>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Seguidores</b> <a class="float-right">1,322</a>
              </li>
              <li class="list-group-item">
                <b>Siguiendo</b> <a class="float-right">543</a>
              </li>
              <li class="list-group-item">
                <b>Compras</b> <a class="float-right">13,287</a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Acerca de</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <strong><i class="fas fa-map-marker-alt mr-1"></i> dirección</strong>

               <p class="text-muted">{{ $existe ? $micrositio[0]->direccion : 'direccion'}}</p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> ubicación</strong>

               <p class="text-muted">{{ $existe ? $micrositio[0]->lat : 'lat'  }} , {{ $existe ? $micrositio[0]->lng : 'long'}}</p>

            <hr>

            <strong><i class="far fa-file-alt mr-1"></i> Descripción</strong>

          <p class="text-muted">{{ $existe ? $micrositio[0]->descripcion : '..'}}</p>
          <hr>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Actividad</a></li>
              <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Productos</a></li>
              <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Ajustes</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="alert alert-info" role="alert">
                  No hay actividad reciente!
                </div> 
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <div class="card card-solid">
                  <div class="card-body pb-0">
                    <div class="row d-flex align-items-stretch">
                      
                      @if(sizeof($productos)>0)
                        @foreach ($productos as $item)
                          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                            <div class="card bg-light">
                              <div class="card-header text-muted border-bottom-0">
                                ID: {{ $item->id}}
                              </div>
                              <div class="card-body pt-0">
                                <div class="row">
                                  <div class="col-7">
                                  <h2 class="lead"><b>{{ $item->nombre}}</b></h2>
                                    <p class="text-muted text-sm"><b> $</b>{{$item->precio}} </p>

                                  </div>
                                  <div class="col-5 text-center">
                                  <img src="{{ $item->imagen_url}}" alt="20" class=" img-fluid">
                                  </div>
                                </div>
                              </div>
                              <div class="card-footer">
                                <div class="text-right">
                                  <a title="deshabilitar producto" href="{{route('productos.destroy',['id'=>$item->id])}}" class="btn btn-sm bg-danger">
                                    <i class="fa fa-power-off"></i>
                                  </a>
                                  <a title="Editar información" href="#" class="btn btn-sm btn-primary">
                                    <i class="fas fa-wrench"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      @else
                        <div class="alert alert-primary" role="alert">
                          No hay productos disponibles, da <a href="{{ route('productos.crear')}}" class="alert-link">este link</a> para agregar un producto nuevo.
                        </div>
                      @endif  
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <nav aria-label="Contacts Page Navigation">
                      <ul class="pagination justify-content-center m-0">
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item"><a class="page-link" href="#">7</a></li>
                        <li class="page-item"><a class="page-link" href="#">8</a></li>
                      </ul>
                    </nav>
                  </div>
                  <!-- /.card-footer -->
                </div>
                
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
               @if($existe)
                  <form class="form-horizontal" id="formSettings" method="post" action="{{ route('micrositios.update',['id'=>$micrositio[0]->id])}}" enctype="multipart/form-data">
               @else
                  <form class="form-horizontal" id="formSettings" method="post" action="{{ route('micrositios.store')}}" enctype="multipart/form-data">

               @endif   

                    @csrf

                  <input type="number" name="listar" value="0" hidden>
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $existe ? $micrositio[0]->nombre :''}}" placeholder="nombre">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Dirección</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="dirección" value="{{ $existe ? $micrositio[0]->direccion :''}}" name="direccion" placeholder="Dirección">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Ubicación</label>
                      <style>   
                        #mapaFormulario {
                            width: 500px;    
                            height: 400px;
                        }
                    </style>
                     <div class="col-sm-4"><br><br>
                        <div class="col-sm-6">
                            <button class="btn btn-warning" id="btn_remove" >remover marcador</button>
                        </div><br>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="lat" name="lat" value="{{ $existe ? $micrositio[0]->lat : '' }}" placeholder="latitud" disabled >
                        </div><br>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="lng" name="lng" value=" {{ $existe ? $micrositio[0]->lng : '' }}" placeholder="longitud" disabled>
                        </div>
                    </div>   
                    <div id ="mapaFormulario" class="col-sm-6" > </div> 
                  </div>
                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Categoria</label>
                    <select class="col-sm-10 custom-select" id="select_categoria" name="categoria">
                        @if($existe)
                            <option value="{{ $micrositio[0]->id_categoria}}" selected>{{ $micrositio[0]->categoria}}</option>
                         @else
                            <option value="" selected disabled>selecciona una categoria..</option>    
                        @endif
                        @foreach ($categorias as $item)
                            <option value="{{$item->id}}">{{ $item->nombre}}</option>
                        @endforeach
                    </select>
                  </div>
                 

                  <div class="form-group row">
                    <label for="inputLogo" class="col-sm-2 col-form-label">Logo</label>
                    <div class=" col-sm-10 input-group">
                      <div class="col-sm-10 custom-file">
                        <input type="file" class="custom-file-input form-control" id="logo"  value="{{ $existe ? $micrositio[0]->logo_url :''}}" name="logo" placeholder="Logo">
                        <label class="custom-file-label" for="exampleInputFile">Cargar Imagen</label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Estado</label>
                    <select class="col-sm-10 custom-select" id="select_estado" name="estado">
                        @if($existe)
                            <option value="{{ $micrositio[0]->id_estado}}" selected>{{ $micrositio[0]->estado}}</option>
                         @else
                            <option value="" selected disabled>selecciona un esado..</option>    
                        @endif
                        @foreach ($estados as $item)
                            <option value="{{$item->id}}">{{ $item->nombre}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Municipio</label>
                    <select class=" col-sm-10 custom-select" id="select_municipio" name="municipio" {{ $existe ? '' : 'disabled' }}>

                        @if($existe)
                            <option value="{{ $micrositio[0]->id_municipio}}" selected>{{ $micrositio[0]->municipio}}</option>
                         @else
                            <option value=""selected disabled>selecciona un municipio..</option>    
                        @endif
                    </select>
                  </div>
                  <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 col-form-label">descripción</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion">{{ $existe ? $micrositio[0]->descripcion :''}}</textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      @if ($existe)
                         <button type="submit" class="btn btn-success">Actualizar</button>
                      @else
                         <button type="submit" class="btn btn-primary">Guardar</button>
                      @endif  
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>

<script>
 
    //se habilita el select de municipios al seleccionar un estado
    $('#select_estado').change(function(){
      $('#select_municipio').removeAttr('disabled');   
        getMunicipios()
    });  


    //se hace una petición ajax de los municipios del esyado seleccionado
    function getMunicipios(){
        var estado = $("#select_estado option:selected").text();
   
        $.ajax({
            url: 'get-municipios/'+estado,
            success: function(respuesta) {
                $("#select_municipio").empty()
                var m = JSON.parse(respuesta)
                m.forEach(addOption);
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }
        });
    
    }

    //se agregan como opciones al select los municipios del estado seleccionado
    function addOption(item) {
        var o = new Option(item.municipio, item.id);
        $("#select_municipio").append(o);
     }

</script>

 <!-- codio para cargar el mapa--> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCKiIqCdZGrVxx06LSbe7uG3zXOq1Cz5k&callback=initMap" async defer></script>
<script>
  
    let map;
    let markerGlogal=null;
   function initMap() {
      map = new google.maps.Map(document.getElementById('mapaFormulario'), {
        center: {lat: 23.737023, lng: -99.141090},
        zoom: 16,
      });

      console.log();
      // This event listener will call addMarker() when the map is clicked.
      map.addListener("click", event => {
        addMarker(event.latLng);
      });
      console.log(document.getElementById('map'));

    }


    let btn_remove = document.getElementById('btn_remove');

    btn_remove.addEventListener('click',function(e){
          e.preventDefault()
          markerGlogal!=null ? markerGlogal.setMap(null) : null;

          document.getElementById('lat').value = "";
          document.getElementById('lng').value = "";

    })

    function remove(){
      markerGlogal.setMap(null);
    }

      
  // Adds a marker to the map and push to the array.
  function addMarker(location) {
      console.log(location.lat())
      console.log(location.lng())
      document.getElementById('lat').value = location.lat();
      document.getElementById('lng').value = ""+location.lng();


    const marker = new google.maps.Marker({
      position: location,
      map: map
    });
    markerGlogal != null ? remove() : null;
    markerGlogal = marker;
  }


  //habilita los campos de lat y lng para que se puedan guardar en la base de datos
  document.querySelector("#formSettings").addEventListener("submit", function(e){
      document.getElementById('lat').disabled = false;
      document.getElementById('lng').disabled = false;
  })

    //si existe una ubicación guardada se carga en el mapa
  $( window ).on( "load", function() {
        console.log( "ventana cargada" );
      
       var lat = document.getElementById('lat').value 
       var lng = document.getElementById('lng').value 
       var title = document.getElementById('nombre').value  
      console.log(lat)
    
      if(lat != 0  &  lng != 0){

        const marker = new google.maps.Marker({
            position: { lat: Number(lat), lng: Number(lng)},
            map: map,
            title: title,
        });
       
        map.setZoom(18);      // This will trigger a zoom_changed on the map
       
        map.setCenter(new google.maps.LatLng(lat, lng))

        markerGlogal = marker;
      }    
      
    });

</script>

@endsection