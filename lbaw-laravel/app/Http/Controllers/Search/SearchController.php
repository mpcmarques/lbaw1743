<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
  
  public function show($text){
    // TODO: Use text variable to make a search
    $search_result = null;
    
    return view('search.projects_card', ['search_result' => null]);
  }
  
  public function search(Request $request)
  {
    
    $text = $request->input('search-text');

    if(is_null($text))
      return redirect()->back();
    else
      return redirect('/search/'.$text);
  }
}