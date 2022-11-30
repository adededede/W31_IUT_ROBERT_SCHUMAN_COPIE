@extends('layouts.app')

@section('title','Signup')

@section('main')
	@parent

	<section>
		<ul>
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('signin') }}">Signin</a></li>
		</ul>
	</section>

	<form action="{{ route('adduser') }}" method="post">
		@csrf
		<label for="login">Login</label>             <input type="text"     id="login"    name="login"    required autofocus>
		<label for="password">Password</label>       <input type="password" id="password" name="password" required>
		<label for="confirm">Confirm password</label><input type="password" id="confirm"  name="confirm"  required>
		<input type="submit" value="Signup">
	</form>
@endsection
