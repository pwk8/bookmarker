<?php
/**
 * Authentication and authorization service provider.
 *
 * @package PWK8\Bookmarker
 * @author  The Laravel team, with modifications by Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Authentication and authorization service provider.
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Bookmark' => 'App\Policies\BookmarkPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
