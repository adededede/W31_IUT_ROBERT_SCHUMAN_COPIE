@extends('layouts.app')

@section('title','Just Another CMS')

@section('main')
	@parent

	<section>
		<ul>
			<li><a href="{{ route('account') }}">My account</a></li>
			<li><a href="{{ route('signup') }}">Signup</a></li>
		</ul>
	</section>

	@foreach ($articles as $article)
		<article>
			<h2><a href={{ route('article',$article->id) }}>{{$loop->index + 1}} - {{ $article->title }}</a></h2>
			<section>
				{{ $article->abstract }}
			</section>
			<section>
				Publié le : {{ $article->published_on }}.
			</section>
		</article>
	@endforeach

@endsection
