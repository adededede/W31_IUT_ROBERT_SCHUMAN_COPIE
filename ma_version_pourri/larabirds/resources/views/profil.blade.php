@extends('layouts.app')

@section('title','My profil')

@section('main')
	@parent
	<p>
		Hello {{ $user->login }} !<br>
		Your informations:
	</p>
	<ul>
		<li>Firstname: {{ $name->name }}</li>
		<li>Lastname: {{ $lastname->lastname }}</li>

	</ul>
	<p><a href="{{ route('account') }}">Go back Home</a></p>
@endsection
