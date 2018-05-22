<?php

namespace App\Policies;


use App\Model\Project;

use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy {

    use HandlesAuthorization;

    public function delete(User $user, Project $project){
        return $user->userid == $project->owner->userid;
    }

}