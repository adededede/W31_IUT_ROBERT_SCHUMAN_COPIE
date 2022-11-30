@extends('layouts.app')

@section('title','Account')

@section('main')
	@parent
	<p>
		Hello {{ $user }} !<br>
		Welcome on your account.
	</p>
	<ul>
		<li><a href="formpassword">Change password.</a></li>
		<li><a href="deleteuser">Delete my account.</a></li>
	</ul>
	<p><a href="signout">Sign out.</a></p>
@endsection
