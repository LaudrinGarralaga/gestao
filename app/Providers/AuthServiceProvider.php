<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;
use App\Permission;
use App\Area;

class AuthServiceProvider extends ServiceProvider {

    protected $policies = [
        'App\Area' => 'App\Policies\PostPolicy',
    ];

    public function boot(Gate $gate) {
        $this->registerPolicies($gate);

        /* Gate::define('update', function(User $user, Area $area) {
          return $user->id == $area->user_id;
          });
         */

        /*$permissions = Permission::with('roles')->get();
        foreach ($permissions as $permission) {
            Gate::define($permission->name, function (User $user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }

        Gate::before(function(User $user, $ability) {

            if ($user->hasAnyRoles('adm')) {
                return true;
            }
        });*/
    }

}
