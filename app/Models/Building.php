<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Apartment;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\Auth;

class Building extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'alias',
        'street',
        'number',
        'postcode',
        'city',
        'state',
        'builded_at',
        'user_id',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'alias' => $this->alias,
            'street' => $this->street,
            'number' => $this->number,
            'postcode' => $this->postcode,
            'city' => $this->city,
            'state' => $this->state,
            'builded_at' => $this->builded_at,
        ];
    }

    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }

    public function lessor()
    {
        return $this->belongsTo(User::class);
    }

    public function getAddressAttribute()
    {
        return $this->street . ' #' . $this->number;
    }

    public function getLocationAttribute()
    {
        return ucfirst($this->city) . ', ' . ucfirst($this->state);
    }

    public function getHrefAttribute()
    {
        return route('buildings.show', ['building' => $this], false);
    }

    public function scopeOfLessor($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function scopeOfCurrentUser($query)
    {
        return $query->when(Auth::user()->hasRole('lessor'), function ($query) {
            $query->ofLessor(Auth::id());
        });
    }

    public function scopeSearching($query, $term)
    {
        if(strlen($term) !== 0)
        {
            $query->whereIn('buildings.id', 
                Building::search($term)->query(function ($query) {
                    $query->select('id');
                })->get()
            );
        }
    }
}
