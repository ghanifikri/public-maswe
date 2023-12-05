<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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

        Gate::define('menage_orders', function($user){
            return $user->hasAnyPermission([
                'order_show',
                'order_delete',
                'order_update'
            ]);
        });

        Gate::define('menage_homePage', function($user){
            return $user->hasAnyPermission([
                'homepage_show',
            ]);
        });

        Gate::define('menage_aboutPage', function($user){
            return $user->hasAnyPermission([
                'aboutpage_show',
            ]);
        });

        Gate::define('menage_productPage', function($user){
            return $user->hasAnyPermission([
                'product_show',
            ]);
        });

        Gate::define('menage_galleryPage', function($user){
            return $user->hasAnyPermission([
                'gallery_show',
            ]);
        });

        Gate::define('menage_messagePage', function($user){
            return $user->hasAnyPermission([
                'messagepage_show',
            ]);
        });

        Gate::define('menage_roles', function($user){
            return $user->hasAnyPermission([
                'role_show',
                'role_create',
                'role_update',
                'role_detail',
                'role_delete'
            ]);
        });

        Gate::define('menage_users', function($user){
            return $user->hasAnyPermission([
                'user_show',
                'user_create',
                'user_update',
                'user_detail',
                'user_delete'
            ]);
        });
    }
}
