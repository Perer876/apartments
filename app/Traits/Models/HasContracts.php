<?php

namespace App\Traits\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Contract;

trait HasContracts 
{
    public function lastestContract()
    {
        return $this->hasOne(Contract::class)->latestOfMany();
    }

    public function scopeWithStatus($query)
    {
        return $query->addSelect(['status' => Contract::select(Contract::calculatedStatus())
            ->whereColumn($this->getForeignKey(), $this->getTable() . '.' . $this->getKeyName())
            ->orderByDesc('updated_at')
            ->limit(1)
        ]);
    }

    public function scopeAvailable($query)
    {
        return $query->doesntHave('contracts')
            ->orWhereHas('contracts', function (Builder $query) {
                $query->whereNotNull('cancelled_at')
                    ->orWhere('end_at', '<=', today());
            });
    }

    public function scopeUnavailable($query)
    {
        return $query->whereHas('contracts', function (Builder $query) {
                $query->whereNull('cancelled_at')
                    ->orWhere('start_at', '>', today());
            });
    }

    /* public function currentContract()
    {
        return $this->hasOne(Contract::class)->ofMany(['start_at' => 'MAX'], function ($query){
            $query->where('end_at', '>', now());
        });
    } */

    /* public function scopeJoinContract($query)
    {
        return $query->leftJoin('contract', 'tenants.id', '=', 'contract.tenant_id');
    } */

    /* public function contracts()
    {
        return $this->belongsToMany(Apartment::class, 'contract');
    } */
}