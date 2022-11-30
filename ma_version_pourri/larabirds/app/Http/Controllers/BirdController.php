<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BirdController extends Controller
{

    /**
     * Add a new bird's description
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addBird( Request $request )
    {
      if ( !$request->filled(['where','species','scName','description']) )
        return redirect()->route('formarticle')->with('message','Some POST data are missing.');

      $bird = new Bird;
      $bird->user_id = $request->session()->get('user')->id;
      $bird->observed_in = $request->where;
      $bird->species = $request->species;
      $bird->scientific_name = $request->scName;
      $bird->description = $request->description;

      try
      {
        $article->save();
      }
      catch (\Illuminate\Database\QueryException $e)
      {
        return redirect()->route('addBird')
          ->with('message','Sorry, an error occur durng bird\'s description saving. Please try again.');
      }

      return redirect()->route('account')->with('message','New bird\'s description created!');
    }

}
