<?php

namespace App\Http\Controllers\Search;

use App\Model\User;
use App\Http\Controllers\Controller;

class SearchUsersController extends Controller{
  public function show($text){
    $search_username = User::username($text)->get();
    $search_name = User::name($text)->get();

    return view('search.users_card', ['text' => $text, 'search_username' => $search_username, 'search_name' => $search_name]);
  }
}
