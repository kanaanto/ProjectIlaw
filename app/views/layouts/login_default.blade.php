<!DOCTYPE HTML>
<html>
	<head>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->
		{{ HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'); }}
		<!-- Optional theme -->
		{{ HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css'); }}
		
		{{ HTML::style('css/home.css'); }}
		
		
		@yield("page_title")
		
		@yield("header_css")
	
	</head>

	<body>

		@yield('header')

		@yield('content')

		<!-- Load script files at the bottom of the page -->
		{{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'); }}
		{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'); }}
	</body>

</html>

		
		