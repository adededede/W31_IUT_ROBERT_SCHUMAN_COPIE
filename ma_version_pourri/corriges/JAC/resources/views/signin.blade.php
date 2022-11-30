@extends('layouts.app')

@section('title','Signin')

@section('main')
	@parent

	<section>
		<ul>
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('signup') }}">Signup</a></li>
		</ul>
	</section>

	<form action="{{ route('authenticate') }}" method="post">
		@csrf
		<label for="login">Login</label>      <input type="text"     id="login"    name="login"    required autofocus>
		<label for="password">Password</label><input type="password" id="password" name="password" required>
		<input type="submit" value="Signin">
	</form>

@endsection
