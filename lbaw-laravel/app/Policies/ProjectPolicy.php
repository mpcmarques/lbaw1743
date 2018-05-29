<?php

namespace App\Policies;

use App\Model\Project;
use App\Model\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy {

    use HandlesAuthorization;

    public function delete(User $user, Project $project){
        return $user->userid == $project->owner->userid;
    }

    public function show(User $user, Project $project){
        foreach($project->members as $member){
            if ($member->iduser == $user->iduser || !$project->private || $user->type == 'admin')
                return true;
        }

        return false;
    }

    public function options(User $user, Project $project){
      if($project->owner->first()->iduser == $user->iduser){
        return true;
      }
        return false;
    }

    public function manage(User $user, Project $project){
      if($project->editors->contains('iduser', $user->iduser)){
        return true;
      }
        return false;
    }

    public function member(User $user, Project $project){
      if($project->members->contains('iduser', $user->iduser)){
        return true;
      }
        return false;
    }
}
