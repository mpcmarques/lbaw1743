<?php

namespace App\Policies;

use App\Model\Project;
use App\Model\Task;
use App\Model\User;
use App\Model\Comment;

use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy {

    use HandlesAuthorization;

    public function edit(User $user, Task $task){
      $project = Project::findOrFail($task->idproject);

      if($task->creator->iduser == $user->iduser
          || $task->project->editors->contains('iduser', $user->iduser)
          || $task->assigned->contains('iduser', $user->iduser)){
        return true;
      }
      return false;
    }

    public function delete(User $user, Task $task){
      $project = Project::findOrFail($task->idproject);

      if($task->creator->iduser == $user->iduser
          || $task->project->editors->contains('iduser', $user->iduser)){
        return true;
      }
      return false;
    }

    public function assign(User $user, Task $task){
      $project = Project::findOrFail($task->idproject);

      if($task->project->members->contains('iduser', $user->iduser)
          && !$task->assigned->contains('iduser', $user->iduser)){
        return true;
      }
      return false;
    }

    public function unassign(User $user, Task $task){
      $project = Project::findOrFail($task->idproject);

      if($task->assigned->contains('iduser', $user->iduser)){
        return true;
      }
      return false;
    }

    public function comment(User $user, Task $task){
      $project = Project::findOrFail($task->idproject);

      if($task->project->members->contains('iduser', $user->iduser) || $user->type == 'admin'){
        return true;
      }
      return false;
    }

    public function createCloseRequest(User $user, Task $task){
      $project = Project::findOrFail($task->idproject);

      if($task->project->editors->contains('iduser', $user->iduser)
          || $task->assigned->contains('iduser', $user->iduser) ){
        return true;
      }
      return false;
    }

    public function completeCloseRequest(User $user, Task $task){
      $project = Project::findOrFail($task->idproject);

      if($task->project->editors->contains('iduser', $user->iduser)){
        return true;
      }
      return false;
    }
}
