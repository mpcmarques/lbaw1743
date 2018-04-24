<?php

namespace App\Http\Controllers\Search;

use App\Model\User;
use App\Http\Controllers\Controller;

class SearchUsersController extends Controller{
  public function show($text){
    $users = User::usernameName($text)->get();

    return view('search.users_card', ['text' => $text, 'users' => $users]);
  }
}
