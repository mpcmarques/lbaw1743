<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Model\Project;
use App\Model\Task;
use App\Policies\ProjectPolicy;
use App\Policies\TaskPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /*
     * The policy mappings for the application.
     *
     * @var array*/
    protected $policies = [
      Project::class => ProjectPolicy::class,
      Task::class => TaskPolicy::class
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
