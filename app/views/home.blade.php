@extends('layouts.default')

@section('header_css')
	{{ HTML::style('css/home.css'); }}
	<title>Home | iLaw</title>
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
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
	<script>
var map;

function initialize() {
  var mapOptions = {
    zoom: 17,
	styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]}]

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
			title: markersArray[i].streetadd
		});
		
		
		google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function(){
					infoWindow.setContent('<a href="' + './view.php?bulbid=' + markersArray[i].id + '">' + markersArray[i].name + '</a>');
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

@section('header')
	
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./"><h3 class="brand-name"><strong><span class="company-branding">i</span>Law</strong></h3></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li id="messages"><a href="#"><span class="glyphicon glyphicon-envelope"></span><span class="badge badge-warning">2</span></a></li>
            <li id="notifications"><a href="#"><span class="glyphicon glyphicon-exclamation-sign"></span><span class="badge badge-warning">1</span></a></li>
            <li id="account" class="active dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> {{ Session::get('username') }}</a>
            	<ul class="dropdown-menu">
            		<li class="dropdown-header"><strong>Account</strong></li>
            		<li><a href="#"><small>Edit Profile</small></a></li>
            		<li><a href="./signout.php"><small>Sign Out</small></a></li>
            	</ul>
            </li>
            <li id="settings" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></a>
            	<ul class="dropdown-menu">
            		<li class="dropdown-header"><strong>Settings</strong></li>
            		<li><a href="#"><small>Custom Reports</small><span class="glyphicon glyphicon-file pull-right"></span></a></li>
            		<li><a href="#"><small>Set Notifications</small><span class="glyphicon glyphicon-flag pull-right"></span></a></li>
            		<?php if(Session::get('username') == 'Admin') echo '<li>'; else echo '<li class="disabled">'?><a href="#"><small>Manage Users<span class="glyphicon glyphicon-user pull-right"></span></small><span class="glyphicon glyphicon-user pull-right"></span></a></li>
            	</ul>
            </li>
        </div>
      </div>
    </div>

@stop

@section('content')

	<div id="map-canvas"></div>
	<div id="float">
	<ul class="list-group list-unstyled">
		<li id="maps" class="dropdown">

			<a href="#" class="list-group-item list-group-item-warning dropdown-toggle" data-toggle="dropdown">
			  <span class="glyphicon glyphicon-map-marker"></span>
			  Maps
			  <span class="badge pull-right badge-warning">{{ $clustersCount }}</span>
			</a>
			
			<ul class="dropdown-menu">
				<li role="presentation" class="dropdown-header">Map Clusters</li>
				
				@foreach ($clusters as $c)
					<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"./cluster.php?clusterid=".{{$c->clusterid}}."\">".{{$c->name}}."</a></li>
				@endforeach
				
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="./addcluster.php">Add a Cluster</a></li>
          </ul>
		
		</li>
		<li id="lights" class="dropdown">
		
			<a href="#" class="list-group-item dropdown-toggle" data-toggle="dropdown">
			  <span class="glyphicon glyphicon-adjust"></span>
			  Lights
			  <span class="badge pull-right"><?php echo $bulbsCount; ?></span>
			</a>
			
			<ul class="dropdown-menu">
				<li role="presentation" class="dropdown-header">Light Bulbs</li>
				
				@foreach ($bulbs as $b)
					<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"./view.php?bulbid=".{{$b->id}}."\">".{{$b->name}}."</a></li>
				@endforeach

				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="./addlight.php">Add a Light</a></li>
          </ul>
		</li>
		<li id="readings" class="dropdown">
		
			<a href="#" class="list-group-item dropdown-toggle" data-toggle="dropdown">
			  <span class="glyphicon glyphicon-signal"></span>
			  Reports
			  <span class="badge pull-right"><?php echo $readingsCount; ?></span>
			</a>
			<ul class="dropdown-menu">
				<li role="presentation" class="dropdown-header">Consumption Reports</li>

				@foreach($readings as $r)
					<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"./readings.php?bulbid=".{{$r->id}}."\">".{{$r->name}}."</a></li>
				@endforeach

				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Customize a Report</a></li>
          </ul>
		</li>
		<li id="schedules" class="dropdown">
		
			<a href="#" class="list-group-item dropdown-toggle" data-toggle="dropdown">
			  <span class="glyphicon glyphicon-calendar"></span>
			  Schedules
			  <span class="badge pull-right"><?php echo $schedulesCount; ?></span>
			</a>
			<ul class="dropdown-menu">
				<li role="presentation" class="dropdown-header">Events</li>
				
				@foreach($schedules as $s)
					if($s->end_date > $datenow){
						<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"./viewschedule.php?scheduleid=".{{$s->scheduleid}}."\">On ".{{$s->start_date}}." to ".{{$s->end_date}}." from ".{{$s->start_time}}." to ".{{$s->end_time}}."</a></li>
					}
				@endforeach

				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="./addschedule.php">Schedule an Event</a></li>
          </ul>
		</li>		
	</ul>
</div>
	
@stop