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
       return $this->hasMany('App\Model\Task', 'idtask', 'idproject');
   }

   /**
     * Get the members for the project.
     */
    public function posts()
    {
        return $this->hasMany('\App\Model\Post', 'idpost', 'idproject');
    }

   /**
     * Get the members for the project.
     */
    public function members()
    {
        return $this->belongsToMany('\App\Model\User', 'joined', 'idproject', 'iduser')->withPivot('role');
    }
}
