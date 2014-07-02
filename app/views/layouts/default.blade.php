<!DOCTYPE HTML>
<html>
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
		<!-- Latest compiled and minified JavaScript -->
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<title>Sign in | iLaw</title>

		{{ HTML::style('css/home.css'); }}

		@yield("header_css")

	</head>

	<body>

		<!-- Header Menu -->
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
		<!-- End Header Menu -->

		<!-- SIDEBAR -->
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
								<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"./cluster.php?clusterid=".{{$c->clusterid}}."\">{{$c->name}}</a></li>
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
								<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"./view.php?bulbid=".{{$b->id}}."\">{{$b->name}}</a></li>
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
								<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"./readings.php?bulbid=".{{$r->id}}."\">{{$r->name}}</a></li>
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
							<?php $datenow = date("Y-m-d") ?>

							@foreach($schedules as $s)
								@if($s->end_date > $datenow)
									<li role="presentation"><a role="menuitem" tabindex="-1" href="./viewschedule.php?scheduleid="{{$s->scheduleid}}">On {{$s->start_date}} to {{$s->end_date}} from {{$s->start_time}} to {{$s->end_time}}</a></li>
								@endif
							@endforeach
							<li role="presentation" class="divider"></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="./addschedule.php">Schedule an Event</a></li>
			      </ul>
					</li>
				</ul>
			</div>
		<!-- END SIDEBAR -->
		@yield('content')
	</body>
</html>
