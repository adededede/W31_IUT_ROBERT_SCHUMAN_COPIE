@extends('layouts.app')

@section('title','Change password')

@section('main')
	@parent
	<form action="changepassword" method="post">
		@csrf
		<label for="newpassword">New password</label>        <input type="password" id="newpassword"	 name="newpassword"	    required>
		<label for="confirmpassword">Confirm password</label><input type="password" id="confirmpassword" name="confirmpassword" required>
		<input type="submit" value="Change my password">
	</form>
	<p>
		Go back to <a href="account">Home</a>.
	</p>
@endsection
