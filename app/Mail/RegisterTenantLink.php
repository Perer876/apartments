<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class RegisterTenantLink extends Mailable
{
    use Queueable, SerializesModels;

    public $token, $expiresAt;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $expiresAt)
    {
        $this->token = $token;
        $this->expiresAt = $expiresAt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Registrar Inquilino')
            ->markdown('emails.register-tenant-link', [
                'url' => URL::temporarySignedRoute('tenant.register', $this->expiresAt, ['tenantToken' => $this->token]),
            ]);
    }
}
