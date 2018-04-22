<?php

namespace App\Model;

use App\Model\BaseModel;

class Tag extends BaseModel
{
  function __construct(){
    parent::__construct('tag', 'idtag');
  }
}
