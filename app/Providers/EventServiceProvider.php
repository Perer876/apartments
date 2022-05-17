<?php

namespace App\Providers;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\Image;
use App\Observers\ApartmentObserver;
use App\Observers\BuildingObserver;
use App\Observers\ImageObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Image::observe(ImageObserver::class);
        Apartment::observe(ApartmentObserver::class);
        Building::observe(BuildingObserver::class);
    }
}
