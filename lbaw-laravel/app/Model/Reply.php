<?php

namespace App\Model;

use App\Model\BaseModel;

class Reply extends BaseModel
{
  function __construct(){
    parent::__construct('reply', 'idreply');
  }
}
