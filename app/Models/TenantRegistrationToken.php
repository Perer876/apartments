<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class TenantRegistrationToken extends Model
{
    use HasFactory;

    public $plain_token = '';

    protected $guarded = [];

    protected $dates = [
        'expires_at', 'consumed_at',
    ];

    public static function create(array $attributes = [])
    {
        $model = static::query()->create($attributes);

        dd($model);

        return $model;
    }

    public function consume($user_id = null)
    {
        $this->tenant->user_id = $user_id ?? Auth::id();
        $this->tenant->save();
        $this->consumed_at = now();
        $this->save();
    }

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

    public static function hasToken($plainToken)
    {
        $token = TenantRegistrationToken::where('token', hash('sha256', $plainToken))->first();
        $token->plain_token = $plainToken;
        return $token;
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return TenantRegistrationToken::hasToken($value);
    }
}
