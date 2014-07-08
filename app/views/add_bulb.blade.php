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
		#content {
			z-index: 100;
			float: left;
			padding-top: 70px;
			padding-left: 20px;
			width: 70%;
			color: white;
		}
		#addressBulb::-webkit-input-placeholder::after {
			display:block;
			content:"Unit Number, House/Building/Street Number + Street Name\A Barangay Name, City/Municipality\A Postal Code + Province\A Country";
		}
  	</style>
@stop

@section('header_js')
	
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
	<script>

		var map;
		var markerArray = {{json_encode($marker)}};

		function initialize() {
		  var mapOptions = {
			zoom: 17,
			styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]}],

				disableDefaultUI: true

		  	};
		    
		    var map = new google.maps.Map(document.getElementById('map-canvas'),
			    mapOptions);

			var options = {
				map: map,
				position: new google.maps.LatLng(markerArray.latitude, markerArray.longitude),
			  };

			var infoWindow = new google.maps.InfoWindow(options);

			map.setCenter(options.position);

			var iconColor = 'http://maps.google.com/mapfiles/ms/icons/grey.png';

			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(markerArray.latitude, markerArray.longitude),
				map: map,
				icon: iconColor
			});

			var offsetx = 1- (screen.width * 0.375);
			var offsety = 1 - (screen.height * 0.10);
			map.panBy(offsetx, offsety);

		}

		google.maps.event.addDomListener(window, 'load', initialize);
		
		function ValidateIPaddress(inputText){
			 var ipformat = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
			 if (inputText == "0.0.0.0")
			 {
				 alert("You have entered an invalid IP address!");
				 document.addDetailsForm.ipAddressBulb.focus();
				 return false;
			 }
			 else if (inputText == "255.255.255.255")
			 {
				 alert("You have entered an invalid IP address!");
				 document.addDetailsForm.ipAddressBulb.focus();
				 return false;
			 }
			 else if(inputText.match(ipformat))
				 return true;
			 else
			 {
				 alert("You have entered an invalid IP address!");
				 document.addDetailsForm.ipAddressBulb.focus();
				 return false;
			 }
		 }

    </script>

@stop

@section('content')
	<div id="content">
	<div class="container-fluid">
		{{ Form::open(array('route'=>'bulb.store','class'=>'form-horizontal')) }}
		<!-- <form class="form-horizontal" id="addDetailsForm" name="addDetailsForm" role="form" action="./processaddlight.php" onsubmit="return ValidateIPaddress(document.getElementById('ipAddressBulb').value);" method="post"> -->
		  
		  <div class="form-group">
			{{Form::label('name', 'Name', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-10">
				{{Form::text('name',Input::old('name'),array('class'=>'form-control','placeholder'=>'light bulb name', 'required','autofocus'))}}
			</div>
		  </div>
		  
		  <div class="form-group">
			{{Form::label('ip', 'IP Address', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-10">
			  {{Form::text('ip',Input::old('name'),array('class'=>'form-control','placeholder'=>'192.168.1.101', 'required'))}}
			</div>
		  </div>
		  <div class="form-group">
			{{Form::label('address', 'Address', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-10">
				{{Form::textarea('address','address',array('class'=>'form-control','placeholder'=>'address','required','size'=>'30x5'))}}
			</div>
		  </div>
		  <div class="form-group">
			{{Form::label('cluster', 'Cluster', array('class' => 'col-sm-2 control-label'))}}
			
			<div class="col-sm-10">
				<input type="radio" name="optionsRadios" id="addNewCluster" value="new" onclick="document.getElementById('newCluster').disabled = false; document.getElementById('existingClusters').disabled = true;">
				<label>Add this bulb to a new cluster.
				<input type="text" class="form-control" name="newCluster" id="newCluster" placeholder="new cluster name" disabled="disabled" required></label>
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>--OR--</strong><br>
				<input type="radio" name="optionsRadios" id="selectCluster" value="existing" checked onclick="document.getElementById('newCluster').disabled = true; document.getElementById('existingClusters').disabled = false;">
				<label>Include this bulb to an existing cluster.
					<select class="form-control" id="existingClusters" name="existingClusters">
						
						@foreach ($clusters as $c)
							<option value={{$c->id}}>{{$c->name}}</option>	
						@endforeach

					</select>
				</label>
			</div>
		  
		  </div>
		  	<!-- Submit hidden form -->
			{{ Form::hidden('longitude', $longitude) }}
		  	{{ Form::hidden('latitude', $latitude) }}
		
		{{ Form::submit('Add Light Bulb',array('class'=>'form-group col-sm-offset-2 col-sm-10 btn btn-warning btn-lg btn-block'))}}
	</div>
	</div>	
@stop


