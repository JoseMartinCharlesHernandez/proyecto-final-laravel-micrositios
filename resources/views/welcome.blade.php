<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Buscador de Micrositios</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

          <!-- Font Awesome -->
        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh; 
                 margin: 0;
            }


            .content {
                text-align: center;
            }

            .title {
                font-size: 30px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title">
                    Buscador de Micrositios
                </div><br>
               <div class="row">
                <div class="col-md-4">
                    <label for=""> Buscar <i class="fa fa-search"></i></label>
                     <input type="search" id="input_search" name="q" class="form-control">
                    <div class="card card-solid">
                      <div class="card-body pb-0">
                        <div class="row d-flex align-items-stretch" id="div_micrositios">
                           <!-- Aki se llena con los registros de la petición ajax de micrositios --> 
                        </div>
                        <div class="row d-flex align-items-stretch" id="div_productos">
                          <!-- Aki se llena con los registros de la petición ajax de micrositios --> 
                       </div>
                      </div>
                      <!-- /.card-footer -->
                    </div>

                </div> 
                <div class="col-md-8">
                  <ul class="nav justify-content-end">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('/home') }}">Home</a>
                            </li>
                        @else
                            <li class="nav-item">
                              <a class="nav-link"  href="{{ route('login') }}">Ingresar</a>
                            </li>
    
                            @if (Route::has('register'))
                                <li class="nav-item">
                                  <a class="nav-link"  href="{{ route('register') }}">Registrarse</a>
                                </li>
                                
                            @endif
                        @endauth
                  @endif
                  </ul>
                  <!-- mapa -->
                  <div class="card card-info">
      
                      <div class="card-body">
                          <style> 
                            #map {
                                width: 100%;    
                                height: 600px;
                            }
                          </style>     
                        <section id ="map" > </section>               
                      </div>
                      <!-- /.card-body -->
                  </div>
                    <!-- /.card -->
                  </div>           
              </div>
            </div>
        </div>
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>  

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFQzRH0UxpjSaEYJUvFQythO-z06q-tGc&callback=initMap" async defer></script>
        <script>
          
            let map;
            let markers= [];
        
           function initMap() {
              map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 23.737023, lng: -99.141090},
                zoom: 13,
              });
            }
              
          // Adds a marker to the map and push to the array.
          function addMarker(item) {
        
            if(item.lat==0 || item.lng==0)
               return false
        
            console.log(item)
        
            const marker = new google.maps.Marker({
              position: {lat: item.lat, lng:item.lng},
              draggable: true,
              animation: google.maps.Animation.DROP,
              map: map,
              title: item.nombre
            });
            //se valida que el marcador no exista ya
            if(!markers.includes(marker))
                markers.push(marker);
          }
        
          function addMicrositioToDiv(item){
            console.log("dentro de add micrositio")
            console.log(item)
        
            document.getElementById('div_micrositios').innerHTML += `
            <div class="col-12 col-sm-6 col-md-12 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-body pt-0">
                  <div class="row">
                      <div class="col-8">
                          <h6><b>${item.nombre}</b></h6>
                          <p class="text-muted text-sm"><b>Dirección: </b>${ item.direccion}.</p>
                          <p class="text-muted text-sm"><b>Descripción: </b>${ item.descripcion}.</p>
                      </div>
                      <div class="col-3 text-center">
                          <img src="${item.logo_url}" alt="" class="img-square img-fluid">
                      </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="/login" class="btn btn-sm btn-success">
                        <i class="fas fa-eye" title="ver"></i>
                      </a>
                  </div>
                </div>
              </div>
            </div>`;
        
          }
        
          function addProductoToDiv(item){
            console.log("dentro de add producto")
            console.log(item)
        
            document.getElementById('div_productos').innerHTML += `
            <div class="col-12 col-sm-6 col-md-12 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                    <h6 ><b>Negocio: </b>${item.nombre}</h6>
                    </div>
                      <div class="col-7">
                      <h3>${'$'+item.precio}</h3>  
                      <p class="text-muted text-sm"><b>Producto: </b>${item.producto}.</p>
                      <p class="text-muted text-sm"><b>Descripción: </b>${item.descripcion}.</p>  
                    </div> 
                    <div class="col-4 text-center">
                    <img src="${item.imagen_url}" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a title="ver la pagina" href="/login" class="btn btn-sm bg-teal">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="/login" class="btn btn-sm btn-warning">
                      <i class="fa fa-shopping-cart"></i> Comprar
                    </a>
                  </div>
                </div>
              </div>
            </div>`;
        
          }
        
            //se hace una petición ajax de los micrositios 
            function getMicrositios(categoria){
              $.ajax({
                  url: 'get-micrositios/'+categoria,
        
                  success: function(respuesta) {
        
                      deleteMarkers();
                      var micrositios = JSON.parse(respuesta)
                      console.log(micrositios);
                      micrositios.forEach(addMarker);
                      //se borran todos los micrositios precargados en busquedas anteriores
                      document.getElementById('div_micrositios').innerHTML = "";
                     // document.getElementById('div_productos').innerHTML="";
        
                      micrositios.forEach(addMicrositioToDiv);
        
                  },
                  error: function() {
                      console.log("No se ha podido obtener la información");
                  }
              });
          }
        
          function deleteMarkers() {
            for (let i = 0; i < markers.length; i++) {
              markers[i].setMap(null);
            }
            markers = [];
          }
        
        
            //se cargan los micrositios de acuerdo a la categoria seleccionada
            $('#select_categoria').change(function(){
              var categoria = $("#select_categoria option:selected").val();
              console.log(categoria);
                getMicrositios(categoria)
            });  
        
        

            //se coloca un event listener para hacer las busquedas de micrositios con la barra de busqueda
            function getBySearch(busqueda){           
                $.ajax({
                  url: 'get-search/'+busqueda,
                  success: function(respuesta) {
        
                      //console.log(respuesta);
                      deleteMarkers();
                      var respuesta = JSON.parse(respuesta)
                      var micrositios = respuesta.micrositios
                      var productos = respuesta.productos
        
                      //al no encontrarse micrositios se muestra un alert
                      if(micrositios.length==0){
                          document.getElementById('div_micrositios').innerHTML = `
                                <div class="col-12 alert alert-warning" role="alert">
                                  <center>No se encontró ningun Micrositio!</center>
                                 </div>`;
                                 
                      }else{
                        micrositios.forEach(addMarker);
                        //se borran todos los micrositios precargados en busquedas anteriores
                        document.getElementById('div_micrositios').innerHTML = "";
                        micrositios.forEach(addMicrositioToDiv);
                      }
                      //al no encontrarse productos se muestra alert 
                      if(productos.length==0){
                        document.getElementById('div_productos').innerHTML = `
                          <div class="col-12 alert alert-warning" role="alert">
                                  <center>No se encontró ningun Producto!</center>
                                 </div>`;
                      }else{               
                        productos.forEach(addMarker); 
                        //se borran todos los productos precargados en busquedas anteriores
                        document.getElementById('div_productos').innerHTML="";
                        productos.forEach(addProductoToDiv);
                      }
        
                  },
                  error: function(e) {
                    console.log(e)
                      console.log("No se ha podido obtener la información");
                  }
              });
        
            }
        
        
        
            $( window ).on( "load", function() {              
               document.getElementById('input_search').addEventListener('keyup', (event) => {
                      var s = document.getElementById('input_search').value      
                      if(s.length>=3)
                         getBySearch(s);
                      if(s.length==0){
                        document.getElementById('div_productos').innerHTML = ``;
                        document.getElementById('div_micrositios').innerHTML = ``;
                        deleteMarkers()
                      }
                  });

            });
            
        </script>
    </body>
</html>
