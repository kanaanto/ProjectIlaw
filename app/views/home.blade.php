@extends('layouts.default')

@section ('page_title')
	<title> Home | iLaw </title>
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
			styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]}],
				disableDefaultUI: true

		  };
		  var map = new google.maps.Map(document.getElementById('map-canvas'),
		      mapOptions);
			var infoWindow = new google.maps.InfoWindow();
			var bounds = new google.maps.LatLngBounds();

			var markersArray = {{json_encode($markers)}};

			for (var i = markersArray.length - 1; i >= 0; i--) {
				
				if (markersArray[i].state == "on")
					var iconColor = 'http://maps.google.com/mapfiles/ms/icons/orange.png';
				else if (markersArray[i].state== "off")
					var iconColor = 'http://maps.google.com/mapfiles/ms/icons/orange-dot.png';
				else
					var iconColor = 'http://maps.google.com/mapfiles/ms/icons/grey.png';

				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(markersArray[i].latitude, markersArray[i].longitude),
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
