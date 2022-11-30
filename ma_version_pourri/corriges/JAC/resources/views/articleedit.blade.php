@extends('layouts.app')

@section('title','Article')

@section('main')
	@parent

	<section>
		<ul>
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('account') }}">My account</a></li>
			<li><a href="{{ route('signup') }}">Signup</a></li>
		</ul>
	</section>

	<form action="{{ route("editarticle", ['article_id' => $article->id ]) }}" method="post">
		@csrf
		<label for="title">Title</label><br>
		<input type="text" name="title" value="{{ $article->title }}"><br>
		<label for="abstract">Abstract</label><br>
		<textarea name="abstract" rows="8" cols="40">{{ $article->abstract }}</textarea><br>
		<label for="content">Content</label><br>
		<textarea name="content" rows="8" cols="40">{{ $article->content }}</textarea><br>
		<input type="submit" value="Save">
	</form>

@endsection
