<?php

namespace App\Model;

use App\Model\BaseModel;

class Task extends BaseModel
{
  function __construct(){
    parent::__construct('task', 'idtask');
  }
}
