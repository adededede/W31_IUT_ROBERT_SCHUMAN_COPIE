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

	<article>
		<h2>{{ $article->title }}</h2>
		<section>
			{{ $article->abstract }}
		</section>
		<section>
			Publié le : {{ $article->published_on }}.
			@if ( $article->published_on != $article->last_update )
				Mis à jour le : {{ $article->last_udate }}.
			@endif
		</section>
		<section>
			{{ $article->content }}
		</section>
	</article>

@endsection
