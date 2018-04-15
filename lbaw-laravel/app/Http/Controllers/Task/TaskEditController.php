<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;

class TaskEditController extends Controller
{
    public function show()
    {
      return view('task_edit');
    }
}