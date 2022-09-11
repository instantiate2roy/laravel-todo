<?php

namespace App\Providers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*Sample Gate
         
        Gate::define('update-todo', function (User $user, Todo $todo) {
            return $user->id == $todo->userid
                ? Response::allow()
                : Response::deny('You are not authorized to edit this Task.');
        });
        
        */
        //
    }
}
