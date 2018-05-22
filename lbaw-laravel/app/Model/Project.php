<?php

namespace App\Model;

use App\Model\BaseModel;

class Project extends BaseModel
{
  function __construct(){
    parent::__construct('project', 'idproject');
  }

  /**
  * Get the tasks for the project.
  */
  public function tasks()
  {
    return $this->hasMany('App\Model\Task', 'idproject');
  }

  /**
  * Get the members for the project.
  */
  public function posts()
  {
    return $this->hasMany('\App\Model\Post', 'idproject');
  }

  /**
  * Get the members for the project.
  */
  public function members()
  {
    return $this->belongsToMany('\App\Model\User', 'joined', 'idproject', 'iduser')->withPivot('role');
  }

  public function scopeNameDescriptionPublic($query, $text){
    return $query->where('name', 'like', "%{$text}%")->orWhere('description', 'like', "%{$text}%")->where('private', '=', 'false');
  }

  /**
   * Get the owner of the project.
   */
  public function owner(){
    return $query->where('members', 'role', 'OWNER');
  }
}
