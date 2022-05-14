<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use App\Traits\Models\HasContracts;
use Illuminate\Support\Facades\Auth;
use App\Models\Building;
use App\Models\Contract;

class Apartment extends Model
{
    use HasFactory;
    use Searchable;
    use HasContracts;

    protected $fillable = [
        'number',
        'floor',
        'garages',
        'bathrooms',
        'bedrooms',
        'monthly_rent',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'building' => $this->building->alias,
            'number' => $this->number,
            'floor' => $this->floor,
            'garages' => $this->garages,
            'bathrooms' => $this->bathrooms,
            'bedrooms' => $this->bedrooms,
            'monthly_rent' => $this->monthly_rent,
        ];
    }

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'floor' => 0,
        'garages' => 0,
        'bathrooms' => 0,
        'bedrooms' => 0,
        'monthly_rent' => 0.0,
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function lessor()
    {
        return $this->building->lessor();
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function getHrefAttribute()
    {
        return route('apartments.show', ['apartment' => $this], false);
    }

    public function scopeOfLessor($query, $user_id)
    {
        return $query->whereRelation('building', 'user_id', $user_id);
    }

    public function scopeOfCurrentUser($query)
    {
        return $query->ofLessor(Auth::id());
    }

    public function scopeJoinBuilding($query)
    {
        return $query->leftJoin('buildings', 'buildings.id', '=', 'apartments.building_id');
    }
    
    public function scopeJoinContract($query)
    {
        return $query->leftJoin('contract', 'contract.apartment_id', '=', 'apartments.id');
    }

    public function scopeSearching($query, $term)
    {
        if(strlen($term) !== 0)
        {
            $query->whereIn('apartments.id', 
                Apartment::search($term)->query(function ($query) {
                    $query->select('id');
                })->get()
            );
        }
    }
}
