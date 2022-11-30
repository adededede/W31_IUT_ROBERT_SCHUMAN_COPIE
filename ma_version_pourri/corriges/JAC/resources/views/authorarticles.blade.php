@extends('layouts.app')

@section('title','My articles')

@section('main')
	@parent

	<section>
		<ul>
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('account') }}">My Account</a></li>
		</ul>
	</section>

	@foreach ($user->articles as $article)
		<article>
			<h2>{{$loop->index + 1}} - {{ $article->title }}</a></h2>
			<section>
				{{ $article->abstract }}
			</section>
			<section>
				@if ($article->published_on != null)
					Publié le : {{ $article->published_on }}.<br>
				@endif
				Mis à jour le : {{ $article->last_update }}.
			</section>
			<section>
				{{ $article->content }}
			</section>
			<section>
				State: {{ $article->published ? 'Published' : 'Not published' }}.
			</section>
			<section>
				<a href="formeditarticle/{{ $article->id }}">Edit</a> -
				<a href="changestatus/{{ $article->id }}">Change status</a>
			</section>
		</article>
	@endforeach

@endsection
