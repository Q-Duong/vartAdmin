<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\EnReport' => 'App\Policies\EnReportPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin',function($user){
            return $user->role == 'admin';
        });

        Gate::define('isSubAdmin',function($user){
            return $user->role == 'subAdmin';
        });

        Gate::define('isStaffRegister',function($user){
            return $user->role == 'staffRegister';
        });

        Gate::define('isStaffReport',function($user){
            return $user->role == 'staffReport';
        });

        Gate::define('isStaffInter',function($user){
            return $user->role == 'staffInter';
        });
    }
}
