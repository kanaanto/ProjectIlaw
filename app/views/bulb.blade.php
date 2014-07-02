@extends('layouts.default')

@section('header_css')

	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

	<title>Light | iLaw</title>

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
			padding-left: 10px;
			width: 73%;
			color: white;
		}
		#slider-range-min {
			margin-top: 17px;
		}

		#slider-range-min .ui-slider-range { background: #FF9900; }
  		#slider-range-min .ui-slider-handle { border-color: #FF9900; }
  		.liveChart {
			width: 100%;
			margin: 0px auto;
		}

		.embed-container {
			height: 0;
			width: 100%;
			padding-bottom: 56.25%;
			overflow: hidden;
			position: relative;
		}

		.embed-container iframe {
			width: 100%;
			height: 100%;
			position: absolute;
			top: 0;
			left: 0;
		}
	</style>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
	<script>

		var map;
		var markerArray = {{json_encode($marker)}};

		function initialize() {

		 	var mapOptions = {
			zoom: 17,
			styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]}]

		  };
		    var map = new google.maps.Map(document.getElementById('map-canvas'),
			    mapOptions);



			var options = {
				map: map,
				position: new google.maps.LatLng(markerArray.latitude, markerArray.longtitude),
			  };

			var infoWindow = new google.maps.InfoWindow(options);

			map.setCenter(options.position);

			if (markerArray.state == "on")
				var iconColor = 'http://maps.google.com/mapfiles/ms/icons/orange.png';
			else if (markerArray.state == "off")
				var iconColor = 'http://maps.google.com/mapfiles/ms/icons/orange-dot.png';
			else
				var iconColor = 'http://maps.google.com/mapfiles/ms/icons/grey.png';

			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(markerArray.latitude, markerArray.longtitude),
				map: map,
				icon: iconColor,
				title: markerArray.address
			});


			google.maps.event.addListener(marker, 'click', (function(marker) {
					return function(){
						infoWindow.setContent('<a href="./view.php?bulbid='+markerArray.id+'">' + markerArray.name + '</a>');
						infoWindow.open(map, marker);
					}
			})(marker));

			google.maps.event.addDomListener(document.getElementById('slideON'),"click",function() {
			  marker.setIcon('http://maps.google.com/mapfiles/ms/icons/orange.png');
			});

			google.maps.event.addDomListener(document.getElementById('slideOFF'),"click",function() {
			  marker.setIcon('http://maps.google.com/mapfiles/ms/icons/orange-dot.png');
			});

			var offsetx = 1- (screen.width * 0.375);
			var offsety = 1 - (screen.height * 0.10);
			map.panBy(offsetx, offsety);
		}

		google.maps.event.addDomListener(window, 'load', initialize);
    </script>

@stop

@section('content2')
	<div id="content">
		<div class="container-fluid">
			<form class="form-horizontal">
				<div class="form-group">
					<label for="nameBulb" class="control-label col-sm-offset-1 col-sm-2">Name</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="nameBulb" name="nameBulb" value ={{$marker->name}} disabled>
					</div>
				</div>
				<div class="form-group">
					<label for="switch" class="control-label col-sm-offset-1 col-sm-2">Address</label>
					<div class="col-sm-9">
						<textarea class="form-control" rows="2" id="addressBulb" name="addressBulb" disabled>{{$marker->address}}</textarea>
					</div>
				</div>
				<div id="lightControl">
					<div class="form-group">
						<label for="switch" class="control-label col-sm-offset-1 col-sm-2">Switch</label>
						<div class="col-sm-9" id="switch">

							@if($marker->state === "on")
								<div id="switchedON" class="btn-group" style="">
							@else
								<div id="switchedON" class="btn-group" style="display:none">
							@endif
									<button id="clickOFF" type="button" class="btn btn-warning btn-lg active">&nbsp;ON&nbsp;</button>
									<button id="slideOFF" onclick="toggledisplay('switchedON');" type="button" class="btn btn-default btn-lg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
								</div>

								{{--*/ $offline = '' /*--}}

								@if ($marker->state === "off")
									<div id="switchedOFF" class="btn-group" style="">
								@elseif ($marker->state === "on")
									<div id="switchedOFF" class="btn-group" style="display:none">
								@else
									<div id="switchedOFF" class="btn-group" style="">
									{{--*/ $offline = 'disabled' /*--}}
								@endif
										<button id="slideON" onclick="toggledisplay('switchedOFF');" type="button" class="btn btn-default btn-lg" <?php echo $offline?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
										<button id="clickON" type="button" class="btn btn-default btn-lg active" {{$offline}}>OFF&nbsp;</button>
									</div>

							<script>

							var state = markerArray.state;
							var level = markerArray.currbrightness;

							function switchON() {
								var ip = markerArray.ip;
								var bulbid = markerArray.id;

								$.get('http://'+ip+'/ilawcontrol.php?state=on&level=1&mode=control', {},
									function(data){
										console.log(data);
									});
								$.get('./bulbDB.php?bulbid='+bulbid+'&state=on&level=1&mode=control', {},
									function(data){
										console.log(data);
									});
								state = "on";
							}
							function switchOFF() {
								var ip = markerArray.ip;
								var bulbid = markerArray.id;

								$.get('http://'+ip+'/ilawcontrol.php?state=off&level=0&mode=control', {},
									function(data){
										console.log(data);
									});
								$.get('./bulbDB.php?bulbid='+bulbid+'&state=off&level=0&mode=control', {},
									function(data){
										console.log(data);
									});
								state = "off";
							}

							function toggledisplay(elementID)
							{
								(function(style) {
									style.display = style.display === 'none' ? '' : 'none';
								})(document.getElementById(elementID).style);
								if (elementID == 'switchedON')
								{
									(function(style) {
										style.display = style.display === 'none' ? '' : 'none';
									})(document.getElementById('switchedOFF').style);
									document.getElementById('brightness').value = "0";
									$('#slider-range-min').slider( "value", 0 );
									$('#slider-range-min').slider({ disabled: true });
									switchOFF();
								}
								if (elementID == 'switchedOFF')
								{
									(function(style) {
										style.display = style.display === 'none' ? '' : 'none';
									})(document.getElementById('switchedON').style);
									document.getElementById('brightness').value = "1";
									$('#slider-range-min').slider( "value", 1 );
									$('#slider-range-min').slider({ disabled: false });
									switchON();
								}
							}
							</script>
						</div>
					</div>

					<div class="form-group" id="brightnessSlider">

					<label for="brightness" class="col-sm-offset-1 col-sm-2 control-label">Brightness</label>
	  				<div class="col-sm-2">
		  				<input type="text" class="form-control input-lg" id="brightness" disabled>
		  			</div>
					<div class="col-sm-7">
	  					<div id="slider-range-min"></div>
					</div>
					<script>

						state = markerArray.state;
						level = markerArray.currbrightness;

						$('#slider-range-min .ui-slider-handle').draggable();
						$(function() {
							$( "#slider-range-min" ).slider({
								range: "min",
								value: level, //current brightness given a particular light
								min: 0,
								max: 100,
								slide: function( event, ui ) {
									$( "#brightness" ).val( ui.value );
								}
							});
							$( "#brightness" ).val( $( "#slider-range-min" ).slider( "value" ) );
						});
						$('#slider-range-min').on( "slidechange", function( event, ui ) {
							var level = $( "#slider-range-min" ).slider( "value" );
							var ip = markerArray.ip;
							var bulbid = markerArray.id;

							if(state == "on"){
								$.get('http://'+ip+'/ilawcontrol.php?state=on&level='+level+'&mode=control', {},
									function(data){
										console.log(data);
									});
								$.get('./bulbDB.php?bulbid='+bulbid+'&state=on&level='+level+'&mode=control', {},
									function(data){
										console.log(data);
									});
							}
						});
						if ((state == "cnbr") || (state == "off"))
							$('#slider-range-min').slider({ disabled: true });
						else
							$('#slider-range-min').slider({ disabled: false });
					</script>

				</div>
				</div>
			</form>
		</div>
	</div>
@stop
