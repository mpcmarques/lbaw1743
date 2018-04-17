<?php

namespace App;

use App\BaseModel;

class Project extends BaseModel
{
  function __construct(){
    parent::__construct('project', 'idproject');
  }
}
