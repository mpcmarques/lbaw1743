<?php

namespace App\Model;

use App\Model\BaseModel;

class BannedRecord extends BaseModel
{
  function __construct(){
    parent::__construct('bannedrecord', 'idban');
  }

  function user(){
    return $this->belongsTo('App\Model\User', 'iduser');
  }
}
