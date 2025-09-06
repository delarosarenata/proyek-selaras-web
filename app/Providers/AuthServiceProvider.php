<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    // app/Providers/AuthServiceProvider.php

    // app/Providers/AuthServiceProvider.php

    public function boot(): void
    {
        // Gerbang untuk akses umum halaman admin (SEMUA ROLE)
        Gate::define('view-admin-pages', function (User $user) {
            return in_array($user->role, ['admin', 'supervisor', 'petugas']);
        });

        // Gerbang untuk MELIHAT halaman manajemen user (Admin & Supervisor)
        Gate::define('view-user-management', function (User $user) {
            return in_array($user->role, ['admin', 'supervisor']);
        });

        // Gerbang BARU yang SANGAT KETAT hanya untuk AKSI BERBAHAYA (HANYA Admin)
        Gate::define('perform-admin-actions', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
