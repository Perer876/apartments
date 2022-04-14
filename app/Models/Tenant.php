<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Tenant extends Model
{
    use HasFactory;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'birthday',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
        ];
    }

    /**
     * Accesor to the computed attribute name
     * 
     * @return string
     */
    public function getNameAttribute()
    {
        return ucwords($this->first_name . ' ' . $this->last_name);
    }
}
