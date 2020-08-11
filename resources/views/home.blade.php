@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label for="inputName2" class="col-sm-2 col-form-label">Buscar</label>
            <div class="input-group mb-6">
              <input id="input_search" type="text" class="form-control">
              <div class="input-group-append">
                <span class="input-group-text"  id="btn_search"><i class="fas fa-search"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="card card-solid" id="card_1" hidden>
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch" id="div_micrositios">
             <!-- Aki se llena con los registros de la petición ajax de micrositios --> 
          </div>
        </div>
      </div>
  
      <div class="card card-solid" id="card_2" hidden>
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch" id="div_productos">
             <!-- Aki se llena con los registros de la petición ajax de micrositios --> 
          </div>
        </div>
      </div>

      <style>
        #card_1 {
            height: 300px; 
            border: 1px solid #ddd;
            background: #f1f1f1;
            overflow-y: scroll;
          }
      </style>
    </div>
  
  
    <div class="col-md-8">
      <!-- mapa -->
      <div class="card card-info">
          <div class="card-header">
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
          </div>
  
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

    <!-- Small boxes (Stat box) -->
    @if (Auth::user()->type==1)
        
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                <h3>{{ $conteo["ventas"] }}</h3>

                  <p>Ventas</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('ventas.listar')}}" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                <h3>{{ $conteo["micrositios"] }}<sup style="font-size: 20px"></sup></h3>

                  <p>Micrositios</p>
                </div>
                <div class="icon">
                  <i class="fa fas fa-cubes"></i>
                </div>
                <a href="{{route('micrositios.listar')}}" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                <h3>{{ $conteo["usuarios"]}}</h3>

                  <p>Usuarios Registrados</p>
                </div>
                <div class="icon">
                  <i class="fas fa-users"></i>
                </div>
              <a href="{{route('usuarios.listar')}}" title="ver listado de usuarios" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                <h3>{{ $conteo["productos"] }}</h3>

                  <p>Productos registrados</p>
                </div>
                <div class="icon">
                  <i class="fas fa-box"></i>
                </div>
              <a href="{{ route('productos.listar')}}" class="small-box-footer" title="ver todos los productos">Más información <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->

    @endif
    <div class="row"> 
      
      @if (Auth::user()->type==1)
              
          <div class="col-md-6">
            <!-- DONUT CHART -->
            <div class="card card-success">
                <div class="card-header">
                <h3 class="card-title">Estadisticas de Micrositios</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
                </div>
                <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
            </div>
              <!-- /.card -->
            </div> 


            <div class="col-md-6">
              <!-- DONUT CHART -->
              <div class="card card-primary">
                  <div class="card-header">
                  <h3 class="card-title">Estadisticas de Productos</h3>
      
                  <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                  </div>
                  <div class="card-body">
                  <canvas id="donutChartProductos" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                  <!-- /.card-body -->
              </div>
                <!-- /.card -->
              </div> 

       @endif      
              
    </div>

    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->

@endsection


@section('js')
<!-- ChartJS -->
<!-- grafica para mostrar estaisticas de micrositios -->
@if (Auth::user()->type==1)
<script src="../../plugins/chart.js/Chart.min.js"></script>
    <script>
                //-------------
        //- DONUT CHART DE MICROSITIOS-
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas2 = $('#donutChart').get(0).getContext('2d')
        var donutData2        = {
        labels: [
           'Activos',
           'Inactivos', 
           'Suspendidos', 
           'Pendientes',
           'Rechazados',
           'Nuevos', 
        ],
        datasets: [
            {
            data: [700,500,400,600],
            backgroundColor : ['#4cbd3d','#d62525', '#ef9a41','#f8d34a','#1f1f19','#4ee7dc'],
            }
        ]
        }
        var donutOptions     = {
          maintainAspectRatio : false,
          responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var donutChart2

    </script>

@endif

<!-- grafica para mostrar estadisticas de productos-->
<script>
      //-------------
    //- DONUT CHART DE PRODUCTOS -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChartProductos').get(0).getContext('2d')
    var donutData = {
                      labels: [
                            'Inactivos',
                            'Activos',  
                            ],
                  datasets: [
                        {
                          data: [700,500],
                          backgroundColor : ['#f56954', '#00a65a'],
                        }
                    ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart


  //obtiene los contadores para las graficas de donut
  function getDataDonut(){
      $.ajax({
          url: 'get-data-donut/',

          success: function(respuesta) {
              var data = JSON.parse(respuesta)
              console.log('datadonut');
              console.log(data);
              asignDataDonut(data)
          },
          error: function() {
              console.log("No se ha podido obtener los datos de las graficas");
          }
      });
  }

  function asignDataDonut(data){
      //console.log(data.p_activos)
      //data de la grafica productos
      donutData.datasets[0].data[1] = data.p_activos;
      donutData.datasets[0].data[0] = data.p_inactivos;
      donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })

    //data de la grafica Micrositios
    donutData2.datasets[0].data[0] = data.m_activos;
    donutData2.datasets[0].data[1] = data.m_inactivos;
    donutData2.datasets[0].data[2] = data.m_suspendidos;
    donutData2.datasets[0].data[3] = data.m_pendientes;
    donutData2.datasets[0].data[4] = data.m_rechazados;
    donutData2.datasets[0].data[5] = data.m_nuevos;
    donutChart2 = new Chart(donutChartCanvas2, {
        type: 'doughnut',
        data: donutData2,
        options: donutOptions      
        })
  }




</script>


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
        <div class="card-header text-muted border-bottom-0">
        </div>
        <div class="card-body pt-0">
          <div class="row">
            <div class="col-7">
            <h2 class="lead"><b>${item.nombre}</b></h2>
            <p class="text-muted text-sm"><b>Dirección: </b>${ item.direccion}.</p>
            <p class="text-muted text-sm"><b>Descripción: </b>${ item.descripcion}.</p>
            </div>
            <div class="col-4 text-center">
            <img src="${item.logo_url}" alt="" class="img-circle img-fluid">
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="text-right">
          <a href="/micrositios-show-${item.id}" class="btn btn-sm btn-warning">
              <i class="fas fa-eye"></i> ver
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
            <h2 class="lead"><b>Negocio: </b>${item.nombre}</h2>
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
            <a title="contactar al vendedor" href="#" class="btn btn-sm bg-teal">
              <i class="fas fa-comments"></i>
            </a>
            <a href="/ventas-create-${item.id}" class="btn btn-sm btn-warning">
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
              document.getElementById('div_productos').innerHTML="";

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
       getDataDonut()
       document.getElementById('input_search').addEventListener('keyup', (event) => {
                      var s = document.getElementById('input_search').value      
                      if(s.length>=3){
                         getBySearch(s);
                         setStateDivSearch(false)
                       }
                      if(s.length==0){
                        document.getElementById('div_productos').innerHTML = ``;
                        document.getElementById('div_micrositios').innerHTML = ``;
                        deleteMarkers()
                        setStateDivSearch(true)
                      }
                  });

    });


    function setStateDivSearch(state){
      document.getElementById("card_1").hidden = state
      document.getElementById("card_2").hidden = state

    }
    
</script>
@endsection