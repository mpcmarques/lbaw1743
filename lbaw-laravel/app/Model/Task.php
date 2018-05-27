<?php

namespace App\Model;

use App\Model\BaseModel;

class Task extends BaseModel
{
  function __construct(){
    parent::__construct('task', 'idtask');
  }

  /**
  * Get the users assigned to the task
  */
  public function assigned() {
    return $this->belongsToMany('\App\Model\User', 'assigned', 'idtask', 'iduser');
  }

  /**
   * Get the user that created the task
   */
  public function creator(){
    return $this->belongsTo('App\Model\User', 'iduser');
  }

  /**
  * Tasks comments
   */
  public function comments() {
    return $this->hasMany('App\Model\Comment', 'idtask')->orderBy('lasteditdate', 'ASC');
  }

  /**
   * Get the close requests for the task
   */
  public function closeRequest(){
    return $this->hasMany('App\Model\CloseRequest', 'idtask');
  }

  public function project(){
    return $this->belongsTo('App\Model\Project', 'idproject');
  }

  /**
  * Get the tags for the task
  */
  public function tags() {
    return $this->belongsToMany('\App\Model\Tag', 'tagged', 'idtask', 'idtag');
  }
}
