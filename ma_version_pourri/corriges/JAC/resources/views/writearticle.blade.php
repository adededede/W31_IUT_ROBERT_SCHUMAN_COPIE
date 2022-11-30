@extends('layouts.app')

@section('title','New article')

@section('main')
	@parent

	<section>
		<ul>
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('account') }}">My Account</a></li>
		</ul>
	</section>

	<form action="{{ route('savearticle') }}" method="post">
		@csrf
		<label for="article_title">Title</label>        <input type="text" id="article_title"    name="title"    required autofocus>
		<label for="article_abstract">Abstract</label>  <input type="text" id="article_abstract" name="abstract" required>
		<label for="article_content">Content</label>    <textarea id="article_content" name="content" required></textarea>
		<label for="article_publish">Publish now</label><input type="checkbox" id="article_publish" name="publish">
		<input type="submit" value="Save">
	</form>

@endsection
