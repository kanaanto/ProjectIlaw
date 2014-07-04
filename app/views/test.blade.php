@extends('layouts.test_layout')

@section ('page_title')
	<title> Test | iLaw </title>
@stop

@section('header_css')
	{{ HTML::style('css/custom.css') }}
@stop

@section('header_js')

    {{ HTML::script('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true') }}
	
	<script>
		
		var map;
		function initialize() {  
		  	var mapOptions = {
		    zoom: 17,
			styles: [{featureType:'water',stylers:[{color:'#46bcec'},{visibility:'on'}]	},{	featureType:'landscape',stylers:[{color:'#f2f2f2'}]	},{		featureType:'road',	stylers:[{saturation:-100},{lightness:45}]	},{		featureType:'road.highway',	stylers:[{visibility:'simplified'}]	},{	featureType:'road.arterial',elementType:'labels.icon',		stylers:[{visibility:'off'}]	},{		featureType:'administrative', elementType:'labels.text.fill',		stylers:[{color:'#444444'}]	},{	featureType:'transit',	stylers:[{visibility:'off'}]},{	featureType:'poi',		stylers:[{visibility:'off'}]}],
			disableDefaultUI: true,
			 zoomControl: true,
    		zoomControlOptions: {
        		style: google.maps.ZoomControlStyle.LARGE,
        		position: google.maps.ControlPosition.BOTTOM_RIGHT
    		},

		  	};
		  var map = new google.maps.Map(document.getElementById('map-canvas'),
		      mapOptions);
			
			var infoWindow = new google.maps.InfoWindow();
			var bounds = new google.maps.LatLngBounds();

			var markersArray = <?php echo json_encode($markers) ?>;
			var markersCount = {{$markersCount}};

			for (var i = 0; i < markersCount; i++){

				if (markersArray[i].state == "on")
					var iconColor = 'http://maps.google.com/mapfiles/ms/icons/orange.png';
				else if (markersArray[i].state== "off")
					var iconColor = 'http://maps.google.com/mapfiles/ms/icons/orange-dot.png';
				else
					var iconColor = 'http://maps.google.com/mapfiles/ms/icons/grey.png';
				
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(markersArray[i].latitude, markersArray[i]["longitude"]),
					map: map,
					icon: iconColor,
					title: markersArray[i].address
				});


				google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function(){
							infoWindow.setContent('<a href="' + './bulb/' + markersArray[i].id + '">' + markersArray[i].name + '</a>');
							infoWindow.open(map, marker);
						}
				})(marker, i));
				bounds.extend(marker.position);
			}

		map.fitBounds(bounds);
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);
	
	</script>
@stop
