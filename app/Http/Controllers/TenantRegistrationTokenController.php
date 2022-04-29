<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use Illuminate\Support\Str;

class TenantRegistrationTokenController extends Controller
{
    public function invite(Tenant $tenant)
    {
        return view('resources.tenants.invite', compact('tenant'));
    }

    public function send_invite(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'expires_at' => ['nullable', 'date', 'after:1 week', 'before:2 months'],
        ]);

        $token = Str::random(32);
        $validated['token'] = bcrypt($token);

        $tenant->registration_tokens()->create($validated);

        # Send email

        session()->push('messages', [
            'text' => 'Se ha enviado la invitación.',
            'color' => 'light-primary',
            'icon' => 'bi bi-send',
        ]);
        return redirect('/tenants/' . $tenant->id);
    }
}
