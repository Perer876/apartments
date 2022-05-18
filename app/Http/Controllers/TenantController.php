<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Tenant::class);
        return view('resources.tenants.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Tenant::class);
        return view('resources.tenants.form');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        $this->authorize('view', $tenant);
        return view('resources.tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenant $tenant)
    {
        $this->authorize('update', $tenant);
        return view('resources.tenants.form', compact('tenant'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy($tenant)
    {
        $tenant = Tenant::onlyTrashed()->where('id', $tenant)->first();

        $this->authorize('delete', $tenant);

        $tenant->forceDelete();

        session()->push('messages', [
            'text' => 'El inquilino ha sido borrado para siempre.',
            'color' => 'warning',
            'icon' => 'bi bi-person-x'
        ]);

        return redirect()->route('tenants.archived');
    }

    
    /**
     * Display a listing of the soft deleted records.
     *
     * @return \Illuminate\Http\Response
     */
    public function archived()
    {
        $this->authorize('tenants.archive');
        return view('resources.tenants.archive', ['tenants' => Tenant::onlyTrashed()->get()]);
    }

    /**
     * Soft deletes the passed model.
     *
     * @param  \App\Models\Tenant $tenant
     * @return \Illuminate\Http\Response
     */
    public function archive(Tenant $tenant)
    {
        $this->authorize('archive', $tenant);

        $tenant->delete();

        session()->push('messages', [
            'text' => 'El inquilino ' . $tenant->name . ' ha sido archivado.',
            'link' => [
                'href' => route('tenants.archived'), 
                'text' => 'Ver archivo'
            ],
            'color' => 'primary',
            'icon' => 'bi bi-archive'
        ]);

        return redirect()->route('tenants.index');
    }

    /**
     * Restore the soft deleted model.
     *
     * @param  \App\Models\Tenant $tenant
     * @return \Illuminate\Http\Response
     */
    public function restore($tenant)
    {
        $tenant = Tenant::onlyTrashed()->where('id', $tenant)->first();

        $this->authorize('archive', $tenant);

        $tenant->restore();

        session()->push('messages', [
            'text' => 'Se ha restaurado el inquilino.',
            'color' => 'primary',
            'icon' => 'bi bi-archive'
        ]);

        return redirect()->route('tenants.show', $tenant);
    }
}
