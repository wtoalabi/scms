<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Platform\Phones\Policies\PhonePolicy;
use App\Platform\Phones\Phone;
use App\Platform\Groups\Policies\GroupPolicy;
use App\Platform\Groups\Group;
use App\Platform\Contacts\Policies\ContactPolicy;
use App\Platform\Contacts\Contact;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Phone::class => PhonePolicy::class,
        Group::class => GroupPolicy::class,
        Contact::class => ContactPolicy::class,
        // 'App\Model' => 'App\Policies\ModelPolicy',
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
