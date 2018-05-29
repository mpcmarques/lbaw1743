<?php

namespace App\Model;

use App\Model\BaseModel;

class Comment extends BaseModel
{
  function __construct(){
    parent::__construct('comment', 'idcomment');
  }

  function user(){
    return $this->belongsTo('App\Model\User', 'iduser');
  }

  function task(){
    return $this->belongsTo('App\Model\Task', 'idtask');
  }
}
