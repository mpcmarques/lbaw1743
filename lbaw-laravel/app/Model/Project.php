<?php

namespace App\Model;

use App\Model\BaseModel;

class Project extends BaseModel
{
  function __construct(){
    parent::__construct('project', 'idproject');
  }
}
