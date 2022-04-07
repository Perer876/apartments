<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Building;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = ['number','floor','garages','bathrooms','bedrooms','monthly_rent'];

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
        return $this->hasOne(Building::class);
    }
}
