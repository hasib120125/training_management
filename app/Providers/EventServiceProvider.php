<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
      'Illuminate\Auth\Events\Login' => [
        'App\Listeners\LogSuccessfulLogin',
      ],

      'Illuminate\Auth\Events\Failed' => [
        'App\Listeners\LogFailedLogin',
      ],

      'Illuminate\Auth\Events\Logout' => [
        'App\Listeners\LogSuccessfulLogout',
      ],

      'Illuminate\Auth\Events\Lockout' => [
        'App\Listeners\LogLockout',
      ],
      'Illuminate\Auth\Events\PasswordReset' => [
        'App\Listeners\LogPasswordReset',
      ],
      'App\Events\Event' => [
        'App\Listeners\EventListener',
      ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}