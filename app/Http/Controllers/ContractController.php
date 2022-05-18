<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Tenant;
use App\Http\Requests\StoreContractRequest;
use App\Models\Apartment;
use Carbon\Carbon;

class ContractController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Contract::class);
        return view('resources.contracts.index');
    }

    public function create(Tenant $tenant)
    {
        $this->authorize('create', [Contract::class, $tenant]);
        return view('resources.contracts.form', compact('tenant'));
    }

    public function store(StoreContractRequest $request, Tenant $tenant)
    {
        $this->authorize('create', [Contract::class, $tenant]);

        $validated = $request->validated();

        $end_at = new Carbon($validated['start_at']);
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

        session()->push('messages', [
            'text' => 'Se creo el nuevo contrato correctamente',
            'icon' => 'bi bi-check2-circle'
        ]);

        return redirect()->route('tenants.show', $validated['tenant_id']);
    }

    public function cancel(Contract $contract)
    {
        $this->authorize('cancel', $contract);

        $contract->cancelled_at = now();
        $contract->save();

        session()->push('messages', [
            'text' => 'Se cancelo el contrato',
            'color' => 'warning',
            'icon' => 'bi-emoji-frown'
        ]);

        return redirect(url()->previous());
    }
}
