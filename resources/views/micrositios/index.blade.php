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
            src="{{ $micrositio->logo_url}}" 
                   alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{  $micrositio->nombre }}</h3>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
              <b>Productos</b> <a class="float-right">{{ $contadores[0]}}</a>
              </li>
              <li class="list-group-item">
                <b>Servicios</b> <a class="float-right">{{ $contadores[1]}}</a>
              </li>
              <li class="list-group-item">
              <b>Ventas</b> <a class="float-right">{{ $contadores[2]}}</a>
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

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección</strong>

               <p class="text-muted">{{  $micrositio->direccion }}</p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Ubicación</strong>

               <p class="text-muted">{{  $micrositio->lat  }} , {{  $micrositio->lng}}</p>

            <hr>

            <strong><i class="far fa-file-alt mr-1"></i> Descripción</strong>

          <p class="text-muted">{{  $micrositio->descripcion }}</p>
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
              <li class="nav-item"><a class="nav-link"  href="{{route('micrositios.show',['id'=>$micrositio->id])}}">Vista del micrositio</a></li>
              <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Actividad</a></li>
              <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Productos</a></li>
              <li class="nav-item"><a class="nav-link active"  href="#settings" data-toggle="tab">Ajustes</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane" id="activity">
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
                                  <a title="Eliminar producto" href="{{route('productos.destroy',['id'=>$item->id])}}" class="btn btn-sm bg-danger">
                                    <i class="fa fa-trash"></i>
                                  </a>
                                  <a title="Editar información" href="#" class="btn btn-sm btn-warning">
                                    <i class="fas fa-wrench"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      @else
                        <div class="alert alert-primary" role="alert">
                          No hay productos disponibles, da click <a href="{{ route('productos.crear')}}" style="color: crimson" class="alert-link">aqui</a> para agregar un producto nuevo.
                        </div>
                      @endif  
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <nav aria-label="Contacts Page Navigation">
                      <ul class="pagination justify-content-center m-0">
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>

                      </ul>
                    </nav>
                  </div>
                  <!-- /.card-footer -->
                </div>
                
              </div>
              <!-- /.tab-pane -->

              <div class="active tab-pane" id="settings">
                  <form class="form-horizontal" id="formSettings" method="post" action="{{ route('micrositios.update',['id'=>$micrositio->id])}}" enctype="multipart/form-data">
                    @csrf

                  <input type="number" name="listar" value="0" hidden>
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control @error('Nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{  $micrositio->nombre}}" placeholder="nombre">
                       @error('nombre')
                          <div class="col-form-label" style="color:red;">{{ $message }}</div>
                       @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Dirección</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control @error('Direccion') is-invalid @enderror" id="dirección" value="{{  $micrositio->direccion}}" name="direccion" placeholder="Dirección">
                      @error('direccion')
                         <div class="col-form-label" style="color:red;">{{ $message }}</div>
                      @enderror 
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
                            <button class="btn btn-warning" id="btn_remove" >Remover marcador</button>
                        </div><br>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="lat" name="lat" value="{{  $micrositio->lat }}" placeholder="Latitud" disabled >
                        </div><br>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="lng" name="lng" value=" {{  $micrositio->lng }}" placeholder="Longitud" disabled>
                        </div>
                    </div>   
                    <div id ="mapaFormulario" class="col-sm-6" > </div> 
                    @if ($errors->has('lat') || $errors->has('lng'))
                    <div class="col-form-label col-sm-6" style="color:red;"><center>{{$errors->first('lat') }}</center></div>
                    @endif
                    <div id="error_type" class="col-form-label" style="color:red; display:none;"></div>
                  </div>
                  <div class="col-sm-12">
                    <label for="inputName2" class="col-sm-12 col-form-label" style="text-align: center"><h3>Datos de la microempresa</h3> </label>
                  </div>
                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Categoria</label>
                    <select class="col-sm-10 custom-select" id="select_categoria" name="categoria">
                        @foreach ($categorias as $item)
                            <option value="{{$item->id}}" {{$item->id == $micrositio->id_categoria ?: 'selected' }} >{{ $item->nombre}}</option>
                        @endforeach
                    </select>
                  </div>
                 

                  <div class="form-group row">
                    <label for="inputLogo" class="col-sm-2 col-form-label">Logo</label>
                      <div class="col-sm-10 custom-file">
                        <input type="file" class="custom-file-input form-control" id="logo"  value="{{  $micrositio->logo_url}}" name="logo" placeholder="Logo">
                        <label class="custom-file-label" for="exampleInputFile">Cargar Imagen</label>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputBanner" class="col-sm-2 col-form-label">Banner</label>
                      <div class="col-sm-10 custom-file">
                        <input type="file" class="custom-file-input form-control" id="banner"  value="{{  $micrositio->banner_url}}" name="banner" placeholder="Banner">
                        <label class="custom-file-label" for="exampleInputFile">Cargar Imagen</label>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Estado</label>
                    <select class="col-sm-10 custom-select" id="select_estado" name="estado">
                        @foreach ($estados as $item)
                            <option value="{{$item->id}}" {{ $micrositio->id_estado == $item->id ?: 'selected'}}>{{ $item->nombre}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Municipio</label>
                    <select class=" col-sm-10 custom-select" id="select_municipio" name="municipio">
                            <option value="{{ $micrositio->id_municipio}}" selected>{{ $micrositio->municipio}}</option>
                    </select>
                  </div>
                  <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 col-form-label">Descripción</label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" placeholder="Descripcion">{{  $micrositio->descripcion}}</textarea>
                        @error('descripcion')
                        <div class="col-form-label" style="color:red;">{{ $message }}</div>
                        @enderror  
                    </div>
                  </div>
                                    
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                         <button type="submit" class="btn btn-success">Actualizar</button>
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
            url: 'get-municipios-'+estado,
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