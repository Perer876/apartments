<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Http\Requests\StoreContractRequest;

class ContractController extends Controller
{
    public function create (Tenant $tenant)
    {
        return view('resources.contracts.form', compact('tenant'));
    }

    public function store (StoreContractRequest $request, Tenant $tenant)
    {
        dd($request->all());
    }
}
