<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;
use App\Models\Apartment;

class Contract extends Pivot
{
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
        return $query->where('user_id', $user_id);
    }

    public function scopeOfCurrentUser($query)
    {
        return $query->ofLessor(Auth::id());
    }
}
