<?php

namespace App\Policies;

use App\Model\Comment;
use App\Model\User;
use App\Model\Project;
use App\Model\Task;

use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy {

    use HandlesAuthorization;

    public function delete(User $user, Comment $comment){
      $task = Task::findOrFail($comment->idtask);
      $project = Project::findOrFail($task->idproject);

      if($task->project->editors->contains('iduser', $user->iduser)
          || $comment->user->iduser == $user->iduser
          || $user->type == 'admin'){
        return true;
      }
      return false;
    }
}
