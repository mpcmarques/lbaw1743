<?php

namespace App\Model;

use App\Model\BaseModel;

class CloseRequest extends BaseModel
{
  function __construct(){
    parent::__construct('closerequest', 'idrequest');
  }

  function user(){
    return $this->belongsTo('App\Model\User', 'iduser');
  }
}
