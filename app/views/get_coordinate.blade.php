@extends('layouts.default')

@section('page_title')
	<title> Cluster | iLaw </title>
@stop

@section('header_css')

	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	
	<style>
			html, body, #map-canvas {
	        	height: 100%;
				margin: 0px;
				padding: 0px
			}
			#map-canvas {
				height: 100%;
				position: absolute;
				top: 0;
				bottom: -200px;
				left: 0;
				right: 0;
				z-index: 0;
			}
			#float {
				z-index: 100;
				float: right;
				padding-top: 70px;
				padding-right: 20px;
				width: 25%;
			}
  	</style>
@stop

@section('header_js')
	
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
	<script>

		var markersArray = {{json_encode($markers)}};
		var map, infoWindow,marker;
		
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
			
			for (var i = markersArray.length - 1; i >= 0; i--) {
				
				var iconColor = "";

				if (markersArray[i].state == "on"){
					 iconColor = 'http://maps.google.com/mapfiles/ms/icons/orange.png';
				}
				else if (markersArray[i].state == "off"){
					 iconColor = 'http://maps.google.com/mapfiles/ms/icons/orange-dot.png';
				}
				else{
					 iconColor = 'http://maps.google.com/mapfiles/ms/icons/grey.png';
				}
				
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(markersArray[i].latitude, 
						markersArray[i].longitude),
					map: map,
					icon: iconColor,
					title: markersArray[i].address
				});


				google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function(){
							infoWindow.setContent('<a href="' + '' + markersArray[i].id + '">' + markersArray[i].name + '</a>');
							infoWindow.open(map, marker);
						}
				})(marker, i));
			}

			if(navigator.geolocation) {
			    navigator.geolocation.getCurrentPosition(function(position) {
			      var pos = new google.maps.LatLng(position.coords.latitude,
			                                       position.coords.longitude);
			      var marker = new google.maps.Marker({
						position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
						map: map,
						draggable:true,
			    		animation: google.maps.Animation.DROP
					});

			      var infoWindow = new google.maps.InfoWindow({
			        map: map,
			        position: pos,
			        content: 'You are here! <a href="{{ route('bulb.create')}}?latitude='+pos.lat()+'&longitude='+pos.lng()+'\">tap to add light</a><br>or click <small><strong>X</strong></small> then drag the red marker'
			      });
			      google.maps.event.addListener(marker, 'dragend', function(e) {
			        var point = marker.getPosition();
			        map.panTo(point);
			        infoWindow.setContent('<a href="{{ route('bulb.create') }}?latitude='+point.lat()+'&longitude='+point.lng()+'">tap to add light here</a>');
			        infoWindow.open(map, marker);
			    });

			      map.setCenter(pos);
			    }, function() {
			      handleNoGeolocation(true);
			    });
			} 
			else {
			    // Browser doesn't support Geolocation
			    handleNoGeolocation(false);
			}
		}

		function handleNoGeolocation(errorFlag) {
		  if (errorFlag) {
		    var content = 'Error: The Geolocation service failed.';
		  } else {
		    var content = 'Error: Your browser doesn\'t support geolocation.';
		  }

		  var options = {
		    map: map,
		    position: new google.maps.LatLng(60, 105),
		    content: content
		  };

		  var infoWindow = new google.maps.InfoWindow(options);
		  map.setCenter(options.position);
		}
		
		google.maps.event.addDomListener(window, 'load', initialize);
		
    </script>

@stop


