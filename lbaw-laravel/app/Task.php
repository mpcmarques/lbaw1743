<?php

namespace App;

use App\BaseModel;

class Task extends BaseModel
{
  function __construct(){
    parent::__construct('task', 'idtask');
  }
}
