<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;

class SearchUsersController extends Controller
{
    public function show($text)
    {
      return view('search.users_card');
    }
}