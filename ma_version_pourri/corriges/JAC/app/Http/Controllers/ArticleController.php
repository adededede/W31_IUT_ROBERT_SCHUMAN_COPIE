<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\UserEloquent;

class ArticleController extends Controller
{

	/**
	 * Show the required article
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function show( Request $request, int $id )
	{
		return view('article')
			->with('article',Article::findOrFail($id))
			->with('message',$request->session()->get('message'));
	}

	/**
	 * Show the three last articles
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function last( Request $request )
	{
		$lastArticles = Article::where('published',1)
			->orderBy('published_on','desc')
			->take(3)
			->get();

		return view('home')
			->with('articles',$lastArticles)
			->with('message',$request->session()->get('message'));
	}

	/**
	 * Show the form to write a new article
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function formArticle( Request $request )
	{
		return view('writearticle')
			->with('message',$request->session()->get('message'));
	}

	/**
	 * Show the form to edit an article
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int $article_id
	 * @return \Illuminate\Http\Response
	 */
	public function formeditarticle( Request $request, int $article_id )
	{
		return view('articleedit')
			->with('article',Article::find($article_id))
			->with('message',$request->session()->get('message'));
	}

	/**
	 * Add a new article
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function write( Request $request )
	{
		if ( !$request->filled(['title','abstract','content']) )
			return redirect()->route('formarticle')->with('message','Some POST data are missing.');

		$article = new Article;
		$article->author_id = $request->session()->get('user')->id;
		$article->title = $request->title;
		$article->abstract = $request->abstract;
		$article->content = $request->content;
		$article->published = (bool) $request->publish;
		$article->published_on = $article->published ? now() : null;
        $article->last_update = $article->published_on;

		try
		{
			$article->save();
		}
		catch (\Illuminate\Database\QueryException $e)
		{
			return redirect()->route('formarticle')
				->with('message','Sorry, an error occur durng article saving. Please try again.');
		}

		return redirect()->route('account')->with('message','New article created!');
	}

	/**
	 * Chnage the publication status on/off
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int $article_id
	 * @return \Illuminate\Http\Response
	 */
	public function toggleStatus( Request $request, int $article_id )
	{
		// if ( $article_id == NULL )
		// 	return redirect()->route('formarticle')->with('message','Some POST data are missing.');

		$currentDate= now();

		$article = Article::find($article_id);
		if ( $article->published )
		{
			$article->published = false;
			$article->published_on = null;
		}
		else
		{
			$article->published = true;
			$article->published_on = $currentDate;
		}

		try
		{
			$article->save();
		}
		catch (\Illuminate\Database\QueryException $e)
		{
			return redirect()->route('myarticles')
				->with('message','Sorry, an error occur durng article update. Please try again.');
		}

		return redirect()->route('myarticles');
	}

	/**
	 * Edit an article
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int $article_id
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Request $request, int $article_id )
	{
		if ( !$request->filled(['title','abstract','content']) )
			return redirect()->route('myarticles')->with('message','Some POST data are missing.');

		$article = Article::find($article_id);
		$article->title = $request->title;
		$article->abstract = $request->abstract;
		$article->content = $request->content;
		$article->last_update = now();

		try
		{
			$article->save();
		}
		catch (\Illuminate\Database\QueryException $e)
		{
			return redirect()->route('myarticles')
				->with('message','Sorry, an error occur durng article saving. Please try again.');
		}

		return redirect()->route('myarticles')->with('message','Article updated!');
	}
}
