<?php

namespace App\Observers;

use App\Models\Apartment;

class ApartmentObserver
{
    /**
     * Handle the Apartment "deleted" event.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return void
     */
    public function deleted(Apartment $apartment)
    {
        foreach ($apartment->images as $image) {
            $image->delete();
        }
    }
}
