20<!DOCTYPE HTML>
<html>
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		
		{{ HTML::style('css/foundation.css'); }}
  		{{ HTML::script('js/vendor/modernizr.js'); }}
     	{{ HTML::script('js/vendor/jquery.js'); }}
   		{{ HTML::script('js/foundation.min.js'); }}
		<!-- Common CSS -->
		{{ HTML::style('css/home.css'); }}
		{{ HTML::style('css/foundation-icons.css'); }}
		@yield("page_title")
		
		@yield("header_css")
		@yield("header_js")
		
	</head>
	<body>
		<!-- Header Menu -->
		<div class="fixed">
			<nav class="top-bar" data-topbar>
			  <ul class="title-area">
			    <li class="name">
			      <h1><a href="#">iLaw</a></h1>
			    </li>
			     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
			    
			  </ul>

			  <section class="top-bar-section">
			    <!-- Right Nav Section -->
			    <ul class="right">
			     
			     <li class="has-dropdown">
			        <a href="#"> Messages </a>
			        <ul class="dropdown">
			          <li><a href="#"></a></li>
			        </ul>
			      </li>
			      <li class="has-dropdown">
			        <a href="#"> Profile </a>
			        <ul class="dropdown">
			          <li><a href="#">First link in dropdown</a></li>
			        </ul>
			      </li>
			    </ul>
			  </section>
			</nav>
		</div>
	

		<!-- End Header Menu -->

		<!-- SIDEBAR -->

		<div class="row">
				<div id='map-canvas'>
		</div>
		
		<div class="row">
			<div class="large-12 columns">
				<div id="sample-block" align="left">
					<ul class="side-nav">
						<li><a href="#">Link 1</a></li>
						<li><a href="#">Link 2</a></li>
						<li><a href="#">Link 3</a></li>
						<li><a href="#">Link 4</a></li>
					</ul>
				</div>
			</div>
		</div>
		
		@yield('content')
		<!-- FOOTER -->
		<!-- 	<div id="footer">
		      <div class="container-fluid">
		        <p class="text-muted">&copy; 2014 Solatronics <small class="pull-right"><a href="#">about</a> &#8226; <a href="#">contact</a> &#8226; <a href="#">help</a></small></p>
		      </div>
			</div> -->
		<!-- FOOTER -->

		<script>
      $(document).foundation();
    </script>
	</body>
</html>
