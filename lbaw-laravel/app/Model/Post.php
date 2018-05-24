<?php

namespace App\Model;

use App\Model\BaseModel;

class Post extends BaseModel
{
  function __construct(){
    parent::__construct('forumpost', 'idpost');
  }

  public function user(){
    return $this->belongsTo('App\Model\User', 'iduser');
  }

  public function replys(){
    return $this->hasMany('App\Model\Reply', 'idpost');
  }
}
