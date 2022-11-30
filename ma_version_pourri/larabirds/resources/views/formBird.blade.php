@extends('layouts.app')

@section('title','Add new bird's observation')

@section('main')
	@parent
	<form action="{{ route('addBird') }}" method="post">
		@csrf
		<label for="where">Where?</label>       <input type="text" id="where" name="where" required>
		<label for="species">Species</label><input type="text" id="species"  name="species"  required>
		<label for="scName">Scientific Name</label> 	<input type="text" id="scName" name="scName" required>
		<label for="description">Description</label> 	<input type="text" id="description" name="description" required>
		<input type="submit" value="add">
	</form>
	<p>
		Go back to <a href="{{ route('account') }}">Home</a>.
	</p>
@endsection
