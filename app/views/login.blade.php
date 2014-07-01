@extends('layouts.login_default')

@section('header_css')
	{{ HTML::style('css/signin.css'); }}
@stop

@section('content')
	<div class="container">
		<div class="form-signin">	
			{{ Form::open(array('url' => 'login'))  }}			
				<h1 class="text-center"><strong><span class="company-branding">i</span>Law<strong></h1>
				
				<h3 class="form-signin-heading">Please sign in</h3>
				
					{{ Form::text('username',Input::old('name'),array('class'=>'form-control','placeholder'=>'Username','required','autofocus')) }}				
					{{ Form::password('password',array('class'=>'form-control','placeholder'=>'Password')) }}
					
					<div class="checkbox">
						{{ Form::checkbox('remember') }}
						{{ Form::label('Remember me') }}
					</div>
				
					{{ Form::submit('Sign In', array('class'=>'btn btn-lg btn-warning btn-block')) }}
			{{ Form::close() }}
		</div>
	</div>
@stop
