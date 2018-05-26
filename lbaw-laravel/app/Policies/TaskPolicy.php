<?php

namespace App\Policies;

use App\Model\Project;
use App\Model\Task;

use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy {

    use HandlesAuthorization;

    public function show(Project $project, Task $task){
        return $task->idproject == $project->idproject;
    }
}
