@extends('layouts.app')

@section('content')

    <style> 
        #map {
            width: 500px;    
            height: 400px;
        }
    </style> 
    <div>
        <input type="number" id="lat">
        <input type="number" id="lng">
    </div>    
    <section id ="map" > </section> 
    <div>
      <button  id = "btn_remove" onclick="remove();"> remove marker</button>
    </div>

@endsection

@section('js')
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCKiIqCdZGrVxx06LSbe7uG3zXOq1Cz5k&callback=initMap" async defer></script>
	<script>
		
      let map;
      let markerGlogal=null;
  	 function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 23.737023, lng: -99.141090},
          zoom: 13,
        });

        console.log();
        // This event listener will call addMarker() when the map is clicked.
        map.addListener("click", event => {  
          addMarker(event.latLng);
        });

        console.log(document.getElementById('map'));

      }

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

   
      
	</script>
@endsection