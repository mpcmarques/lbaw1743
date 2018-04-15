<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function show()
    {
      return view('task');
    }
}