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
    // return $query->where('members', 'role', 'Owner');
    return $this->belongsToMany('\App\Model\User', 'joined', 'idproject', 'iduser')->withPivot('role')->where('role', 'Owner');
  }

  /**
   * Get the managers of the project.
   */
  public function managers(){
    // return $query->where('members', 'role', 'Manager');
    return $this->belongsToMany('\App\Model\User', 'joined', 'idproject', 'iduser')->withPivot('role')->where('role', 'Manager');
  }

  public function editors(){
    return $this->belongsToMany('\App\Model\User', 'joined', 'idproject', 'iduser')->withPivot('role')->where('role','!=', 'Member');
  }

  /**
   * Get project image.
   */
  public function getPicture(){
      if (file_exists('img/project/'.$this->idproject.'.png')) {
          return asset('img/project/'.$this->idproject.'.png');
      } else {
          return asset('img/project/default.png');
      }
  }

}
