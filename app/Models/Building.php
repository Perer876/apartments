<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Apartment;

class Building extends Model
{
    use HasFactory;

    protected $fillable = ['alias','street','number','postcode','city','state','builded_at'];

    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }
}
