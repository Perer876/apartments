<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Carbon\Carbon;

use App\Models\TenantRegistrationToken;
use App\Models\User;

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

    protected $casts = [
        'birthday' => 'datetime:Y/m/d'
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
            'age' => $this->age,
        ];
    }

    public function registration_tokens()
    {
        return $this->hasMany(TenantRegistrationToken::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    /**
     * Accesor to the computed attribute age
     * 
     * @return string
     */
    public function getAgeAttribute()
    {
        if ($this->birthday != null) 
            return Carbon::create($this->birthday)->diffInYears(Carbon::now());
    }

    /**
     * Shorter way to call the reference to a single model
     * 
     * @return string
     */
    public function getHrefAttribute()
    {
        /* return '/tenants/' . $this->id; */
        return route('tenants.show', ['tenant' => $this], false);
    }
}
