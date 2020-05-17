<?php

namespace App\Providers;

use App\User;
use App\Models\News;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        //News::class => \App\Policies\NewsPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        /**
         * Only permission user auth
         */
        Gate::define('news-auth', function(User $user, News $news){
            return $user->id == $news->user_id;
        });

        /**
         * Get in Database the permission and role in the user auth
         */
        try {
            $permissions = Permission::with('role')->get();
            foreach ($permissions as $permission) {
                Gate::define($permission->name, function (User $user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }
        } catch (Exception $ex) {
            if ($ex->getCode() != '42S02') {
                throw $ex;
            }
        }

        /**
         * Sometimes, you may wish to grant all abilities to a specific user.
         * You may use the before method to define a callback that is run before
         * all other authorization checks:
         * @param mixed $ability (news-index, news-show, news-create, ..)
         */
        Gate::before(function(User $user /*,$ability*/){
            return $user->isRoot(); //  Super Admin with Full Permission
        });
    }
}
