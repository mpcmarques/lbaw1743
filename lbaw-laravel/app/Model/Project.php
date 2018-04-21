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
       return $this->hasMany('App\Model\Task', 'idproject', 'idtask');
   }
}
