<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
  public function search(Request $request){
    $text = $request->input('search-text');

    if(is_null($text))
      return redirect()->back();
    else
      return redirect('/search/'.$text.'/projects');
  }
}
