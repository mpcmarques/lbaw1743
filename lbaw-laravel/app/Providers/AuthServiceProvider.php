<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Model\Project;
use App\Model\Task;
use App\Model\Comment;
use App\Policies\ProjectPolicy;
use App\Policies\TaskPolicy;
use App\Policies\CommentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /*
     * The policy mappings for the application.
     *
     * @var array*/
    protected $policies = [
      Project::class => ProjectPolicy::class,
      Task::class => TaskPolicy::class,
      Comment::class => CommentPolicy::class
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
