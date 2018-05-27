<?php

namespace App\Model;

use App\Model\BaseModel;

class Country extends BaseModel
{
  function __construct(){
    parent::__construct('country', 'idcountry');
  }
}
