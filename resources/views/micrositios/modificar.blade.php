@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="row justify-content-center">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Modificar Micrositio</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                    <form role="form" id="form" method="POST" action="{{ route('micrositios.update',['id'=>$micrositio->id]) }}" enctype="multipart/form-data">
                        @csrf

                        <input type="number" name="listar" value="1" hidden>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Nombre del Micrositio" name="nombre" value="{{$micrositio->nombre}}">                        
                                @error('nombre')
                                    <div class="col-form-label" style="color:red;">{{ $message }}</div>
                                @enderror    
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Dirección</label>
                                <input type="text" class="form-control @error('direccion') is-invalid @enderror" placeholder="dirección" name="direccion" value="{{$micrositio->direccion}}">
                                @error('direccion')
                                <div class="col-form-label" style="color:red;">{{ $message }}</div>
                                @enderror    
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
                                    <input type="text" class="form-control" id="lat" name="lat" value="{{$micrositio->lat}}" placeholder="latitud" disabled  >
                                    </div><br>
                                    <div class="col-sm-6">
                                    <input type="text" class="form-control" id="lng" name="lng" value=" {{$micrositio->lng  }}" placeholder="longitud" disabled >
                                    </div>
                                </div>   
                                <div id ="mapaFormulario" class="col-sm-6" > </div> 
                                @if ($errors->has('lat') || $errors->has('lng'))
                                <div class="col-form-label col-sm-6" style="color:red;"><center>{{$errors->first('lat') }}</center></div>
                                @endif
                                <div id="error_type" class="col-form-label" style="color:red; display:none;"></div>
                            </div>


                            <div class="form-group">
                                <a href="{{$micrositio->logo_url}}"></a>    
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Logo</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="logo" class="custom-file-input" id="logo">
                                    <label class="custom-file-label" for="exampleInputFile">Seleccionar Logo</label>
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Banner</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="banner" class="custom-file-input" id="banner">
                                    <label class="custom-file-label" for="exampleInputFile">Seleccionar Banner</label>
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="micrositios">Categoria</label>
                                <select class="form-control" name="categoria" required>
                                    @foreach ($categorias as $item)
                                        <option value="{{$item->id}}" {{$micrositio->id_categoria == $item->id ? 'selected' : '' }} >{{$item->nombre}}</option>   
                                    @endforeach
                                </select>
                                @if ($errors->has('categoria'))
                                <div class="col-form-label" style="color:red;">{{$errors->first('categoria')}}</div>
                                @endif
                                <div id="error_type" class="col-form-label" style="color:red; display:none;"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="micrositios">Estado</label>
                                <select class="form-control" name="estado" id="select_estado" required>
                                    @foreach ($estados as $item)
                                        <option value="{{$item->id}}" {{$micrositio->id_estado == $item->id ? 'selected' : '' }} >{{$item->nombre}}</option>   
                                    @endforeach
                                </select>
                                @if ($errors->has('estado'))
                                <div class="col-form-label" style="color:red;">{{$errors->first('estado')}}</div>
                                @endif
                                <div id="error_type" class="col-form-label" style="color:red; display:none;"></div>
                            </div>   

                            <div class="form-group">
                                <label for="micrositios">Municipio</label>
                                <select class="form-control" name="municipio" id="select_municipio" required>
                                    @foreach ($municipios as $item)
                                        <option value="{{$item->id}}" {{$micrositio->id_municipio == $item->id ? 'selected' : '' }} >{{$item->municipio}}</option>   
                                    @endforeach
                                </select>
                                @if ($errors->has('municipio'))
                                <div class="col-form-label" style="color:red;">{{$errors->first('municipio')}}</div>
                                @endif
                                <div id="error_type" class="col-form-label" style="color:red; display:none;"></div>
                            </div>   

                            <div class="form-group">
                                <label for="exampleInputPassword1">Descripción</label>
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" placeholder="Descripcion">{{$micrositio->descripcion}}</textarea>
                                @error('descripcion')
                                <div class="col-form-label" style="color:red;">{{ $message }}</div>
                                @enderror    
                            </div>

                            <div class="form-group">
                                <label for="micrositios">Estatus</label>
                                <select class="form-control" name="id_estatus" required>
                                    @foreach ($estatus as $item)
                                        <option value="{{$item->id}}" {{$micrositio->id_estatus == $item->id ? 'selected' : '' }} >{{$item->nombre}}</option>   
                                    @endforeach
                                </select>
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



@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>

<script>

   
    //se habilita el select de municipios al seleccionar un estado
    $('#select_estado').change(function(){
        getMunicipios()
    });  


    //se hace una petición ajax de los municipios del esyado seleccionado
    function getMunicipios(){
        var estado = $("#select_estado option:selected").text();
   
        $.ajax({
            url: '/get-municipios/'+estado,
            success: function(respuesta) {
                console.log(respuesta);
                $("#select_municipio").empty()
                var m = JSON.parse(respuesta)
                m.forEach(addOption);
            },
            error: function(e) {
                console.log(e);
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
      draggable: true,
      animation: google.maps.Animation.DROP,
      map: map
    });
    markerGlogal != null ? remove() : null;
    markerGlogal = marker;
  }


  //habilita los campos de lat y lng para que se puedan guardar en la base de datos
  document.querySelector("#form").addEventListener("submit", function(e){
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