<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\URL;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        if($request->input('target_url') && $request->input('target_url') != URL::full())
        {
            return redirect($request->input('target_url'));
        }
        return redirect()->route('home');
    }
}
