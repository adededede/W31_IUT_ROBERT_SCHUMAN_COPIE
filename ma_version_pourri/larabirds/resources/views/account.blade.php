@extends('layouts.app')

@section('title','Account')

@section('main')
	@parent
	<p>
		Hello {{ $user->login }} !<br>
		Welcome on your account.
	</p>
	<ul>
		<li><a href="{{ route('formpassword') }}">Change password.</a></li>
		<li><a href="{{ route('deleteuser') }}">Delete my account.</a></li>
		<li><a href="{{ route('profil') }}">Profil.</a></li>
		
	</ul>
	<p><a href="{{ route('signout') }}">Sign out.</a></p>
@endsection
