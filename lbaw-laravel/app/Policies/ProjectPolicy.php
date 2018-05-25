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
            if ($member->iduser == $user->iduser || !$project->private)
                return true;
        }

        return false;
    }

}
