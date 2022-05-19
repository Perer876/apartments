<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterTenantLink;
use App\Models\TenantRegistrationToken;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class TenantRegistrationTokenController extends Controller
{
    public function invite(Tenant $tenant)
    {
        $this->authorize('invite', $tenant);
        return view('resources.tenants.invite', compact('tenant'));
    }

    public function send_invite(Request $request, Tenant $tenant)
    {
        $this->authorize('invite', $tenant);
        
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

    public function register(Request $request, TenantRegistrationToken $tenantToken)
    {
        if(! $request->hasValidSignature()) 
        {
            abort(401, "Token de registro invalido");
        }
        
        if($tenantToken->consumed_at !== null)
        {
            abort(401, "Token de registro ya consumido");
        }
        
        $user = Auth::user();
        if($user !== null)
        {
            $this->authorize('tenants.accept');
            return view('auth.accept-invite', compact('user', 'tenantToken'));
        }

        return view('auth.register', compact('tenantToken'));
    }

    public function login(Request $request, TenantRegistrationToken $tenantToken)
    {   
        if($tenantToken->consumed_at !== null)
        {
            abort(401, "Token de registro ya consumido");
        }

        return view('auth.login', compact('tenantToken'));
    }

    public function accept(Request $request)
    {
        $this->authorize('tenants.accept');

        $request->validate([
            'token' => ['required', 'string'],
        ]);

        $tenantToken = TenantRegistrationToken::hasToken($request->input('token'));
        $tenantToken->consume();

        return redirect()->route('home');
    }
}
