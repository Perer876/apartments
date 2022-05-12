<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

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
    
    public function getActiveAttribute()
    {
        return $this->start_at < now() && $this->end_at > now() && !$this->cancelled_at;
    }
}
