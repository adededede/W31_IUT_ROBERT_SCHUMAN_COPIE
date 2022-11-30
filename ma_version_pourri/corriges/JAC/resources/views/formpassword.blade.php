@extends('layouts.app')

@section('title','Change password')

@section('main')
	@parent

	<section>
		<ul>
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('account') }}">My Account</a></li>
		</ul>
	</section>

	<form action="{{ route('changepassword') }}" method="post">
		@csrf
		<label for="newpassword">New password</label>        <input type="password" id="newpassword"     name="newpassword"     required>
		<label for="confirmpassword">Confirm password</label><input type="password" id="confirmpassword" name="confirmpassword" required>
		<input type="submit" value="Change my password">
	</form>

@endsection
