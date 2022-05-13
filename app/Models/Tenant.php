<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Apartment;
use App\Models\Contract;
use App\Models\TenantRegistrationToken;

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
        'user_id',
        'renter_user_id',
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

    public function lessor()
    {
        return $this->belongsTo(User::class, 'lessor_user_id');
    }

    public function lastestContract()
    {
        return $this->hasOne(Contract::class)->latestOfMany();
    }

/*     public function currentContract()
    {
        return $this->hasOne(Contract::class)->ofMany(['start_at' => 'MAX'], function ($query){
            $query->where('end_at', '>', now());
        });
    } */

/*     public function scopeJoinContract($query)
    {
        return $query->leftJoin('contract', 'tenants.id', '=', 'contract.tenant_id');
    } */

    public function scopeWithStatus($query)
    {
        $now = now()->format("'Y-m-d'");
        return $query->addSelect(['status' => Contract::select(
                DB::raw('IF(cancelled_at is not null, 0, 
                    IF('.$now.' < start_at, 1, 
                        IF('.$now.' >= end_at, 2, 3)
                    )
                )')
            )
            ->whereColumn('tenant_id', 'tenants.id')
            ->orderByDesc('updated_at')
            ->limit(1)
        ]);
    }

    /*public function contracts()
    {
        return $this->belongsToMany(Apartment::class, 'contract');
    } */

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
        if ($this->birthday) return $this->birthday->diffInYears(now());
    }

    /**
     * Shorter way to call the reference to a single model
     * 
     * @return string
     */
    public function getHrefAttribute()
    {
        return route('tenants.show', ['tenant' => $this], false);
    }

    public function scopeOfLessor($query, $user_id)
    {
        return $query->where('lessor_user_id', $user_id);
    }

    public function scopeOfCurrentUser($query)
    {
        return $query->ofLessor(Auth::id());
    }

    public function scopeSearching($query, $term)
    {
        if(strlen($term) !== 0)
        {
            $query->whereIn('tenants.id', 
                Tenant::search($term)->query(function ($query) {
                    $query->select('id')->limit(50);
                })->get()
            );
        }
    }
}
