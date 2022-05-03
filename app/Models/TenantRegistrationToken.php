<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant;

class TenantRegistrationToken extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'expires_at', 'consumed_at',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function getIsExpiredAttribute()
    {
        return $this->expires_at < now(); 
    }

    public function getIsConsumedAttribute()
    {
        return $this->consumend_at ? true : false;
    }

    public function getIsValidAttribute()
    {
        return !$this->is_expired and !$this->is_consumed;
    }
}
