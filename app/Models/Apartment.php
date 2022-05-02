<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Building;
use Laravel\Scout\Searchable;

class Apartment extends Model
{
    use HasFactory;
    use Searchable;

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

    public function getHrefAttribute()
    {
        return route('apartments.show', ['apartment' => $this], false);
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
