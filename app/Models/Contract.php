<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;
use App\Models\Apartment;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\DB;

class Contract extends Pivot
{
    use Searchable;

    public $incrementing = true;

    protected $fillable = [
        'start_at',
        'end_at',
        'amount',
        'period',
        'monthly_rent',
        'user_id',
        'tenant_id',
        'apartment_id',
    ];

    protected $casts = [
        'start_at' => 'date:Y/m/d',
        'end_at' => 'date:Y/m/d',
        'cancelled_at' => 'datetime:Y/m/d h:i:s',
    ];

    public function toSearchableArray()
    {
        return [
            'tenant_name' => $this->tenant->name,
            'apartment_number' => $this->apartment->number,
            'monthly_rent' => $this->monthly_rent,
        ];
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function lessor()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getIsActiveAttribute()
    {
        return $this->start_at <= today() && $this->end_at > today() && !$this->cancelled_at;
    }

    public function getIsFinishedAttribute()
    {
        return $this->end_at <= today() && !$this->cancelled_at;
    }

    public function getIsComingAttribute()
    {
        return $this->start_at > today() && !$this->cancelled_at;
    }

    public function getStatusAttribute()
    {
        if($this->cancelled_at)
        {
            return "cancelled";
        }
        else
        {
            if(today() < $this->start_at)
            {
                return "coming";
            }
            else if(today() >= $this->end_at)
            {
                return "finished";
            }
            return "active";
        }
    }

    public function scopeOfLessor($query, $user_id)
    {
        return $query->where($this->getTable() . '.user_id', $user_id);
    }

    public function scopeOfTenant($query, $user_id)
    {
        $tenant = Tenant::where('user_id', $user_id)->first();
        return $query->where($this->getTable() . '.tenant_id', ($tenant ? $tenant->id : null));
    }

    public function scopeOfCurrentUser($query)
    {
        $user = User::find(Auth::id());
        if($user->hasRole('lessor') )
        {
            $query->ofLessor(Auth::id());
        }
        else if($user->hasRole('tenant'))
        {
            $query->ofTenant(Auth::id());
        }
    }

    public function scopeJoinApartment($query)
    {
        return $query->leftJoin(
            'apartments', 
            'apartments.id', '=', $this->getTable() . '.' . $this->apartment()->getForeignKeyName()
        );
    }

    public function scopeJoinTenant($query)
    {
        return $query->leftJoin(
            'tenants', 
            'tenants.id', '=', $this->getTable() . '.' . $this->tenant()->getForeignKeyName()
        );
    }

    public function scopeSearching($query, $term)
    {
        if(strlen($term) !== 0)
        {
            $query->whereIn($this->getTable() . '.' . $this->getKeyName(), 
                Contract::search($term)->query(function ($query) {
                    $query->select('id');
                })->get()
            );
        }
    }

    public static function calculatedStatus($as = null)
    {
        $now = now()->format("'Y-m-d'");
        return DB::raw('IF(cancelled_at is not null, 0, 
                    IF('.$now.' < start_at, 1, 
                        IF('.$now.' >= end_at, 2, 3)
                    )
                )' . ($as ? (' as ' . $as) : '')
            );
    }

    public static function calculatedPeriod($as = null)
    {
        return DB::raw("IF(period = 'years', amount * 12, amount)" . ($as ? (' as ' . $as) : ''));
    }
}
