<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Tenant;
use App\Http\Requests\StoreContractRequest;
use App\Models\Apartment;

class ContractController extends Controller
{
    public function create(Tenant $tenant)
    {
        return view('resources.contracts.form', compact('tenant'));
    }

    public function store(StoreContractRequest $request)
    {
        $validated = $request->validated();

        $end_at = now();
        if($validated['period'] == 'months')
        {
            $end_at->addMonths($validated['amount']);
        }
        else
        {
            $end_at->addYears($validated['amount']);
        }
        
        $validated['end_at'] = $end_at->format('Y/m/d');
        $validated['monthly_rent'] = Apartment::find($validated['apartment_id'])->monthly_rent;

        Contract::create($validated);

        return redirect()->route('tenants.show', $validated['tenant_id']);
    }

    public function cancel(Contract $contract)
    {
        $contract->cancelled_at = now();
        $contract->save();
        return redirect()->route('tenants.show', $contract->tenant_id);
    }
}
