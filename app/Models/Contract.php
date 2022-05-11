<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Contract extends Pivot
{
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
}
