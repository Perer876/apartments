<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterTenantLink;
use App\Models\TenantRegistrationToken;
use Illuminate\Support\Carbon;

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
        $validated['token'] = hash('sha256', $token);

        $tenant->registration_tokens()->create($validated);

        # Send email
        Mail::to($validated['email'])
            ->queue(new RegisterTenantLink($token, Carbon::create($validated['expires_at'])));

        session()->push('messages', [
            'text' => 'Se ha enviado la invitación.',
            'icon' => 'bi bi-send',
        ]);
        return redirect('/tenants/' . $tenant->id);
    }

    public function register(Request $request, $token) {
        if (! $request->hasValidSignature()) {
            abort(401);
        }
        
        $tenantToken = TenantRegistrationToken::where('token', hash('sha256', $token))->first();

        return view('auth.register', ['email' => $tenantToken->email]);
    }
}
