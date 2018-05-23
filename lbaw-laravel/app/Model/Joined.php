<?php

namespace App\Model;

use App\Model\BaseModel;

class Joined extends BaseModel
{
  function __construct(){
    parent::__construct('joined', 'iduser','idproject');
  }
}
