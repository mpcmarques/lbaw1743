<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\User;

class AdminUsersController extends Controller
{
    public function show()
    {

      $users = User::all();

      return view('admin.users_card', ['users' => $users]);
    }
}