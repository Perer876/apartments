<?php

namespace App\Observers;

use App\Models\Building;

class BuildingObserver
{
    /**
     * Handle the Building "deleted" event.
     *
     * @param  \App\Models\Building  $building
     * @return void
     */
    public function deleting(Building $building)
    {
        foreach($building->apartments as $apartment)
        {
            $apartment->delete();
        }
    }
}
