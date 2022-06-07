<div>
    <div class="row">
        <div class="col-12 col-md-4 order-md-1">
            <h5>
                {{ __('Two Factor Authentication') }}
            </h5>
            <p class="text-subtitle text-muted">
                {{ __('Add additional security to your account using two factor authentication.') }}
            </p>
        </div>
        <div class="col-12 col-md-8 order-md-2">
            <div class="card shadow-sm m-0">
                <div class="card-content">
                    <div class="card-body">

                        <h3 class="card-title">
                            @if ($this->enabled)
                                {{ __('You have enabled two factor authentication.') }}
                            @else
                                {{ __('You have not enabled two factor authentication.') }}
                            @endif
                        </h3>

                        <div class="card-text">
                            <p>
                                {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
                            </p>
                        </div>

                        @if ($this->enabled)
                            @if ($showingQrCode)
                                <div class="card-text">
                                    <p>
                                        {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                                    </p>
                                </div>

                                <div class="my-4 text-center">
                                    {!! $this->user->twoFactorQrCodeSvg() !!}
                                </div>
                            @endif

                            @if ($showingRecoveryCodes)
                                <div class="card-text">
                                    <p>
                                        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                                    </p>
                                </div>

                                <div class="mt-4 px-4 py-4 font-monospace fw-lighter bg-light-secondary rounded">
                                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                                        <div>{{ $code }}</div>
                                    @endforeach
                                </div>
                            @endif
                        @endif

                        <div class="d-grid gap-2 d-sm-block mb-3 mt-5">
                            @if (! $this->enabled)
                                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                                    <button type="button" class="btn btn-primary" wire:loading.attr="disabled">
                                        {{ __('Enable') }}
                                    </button>
                                </x-jet-confirms-password>
                            @else
                                @if ($showingRecoveryCodes)
                                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                                        <button type="button" class="btn btn-secondary me-3">
                                            {{ __('Regenerate Recovery Codes') }}
                                        </button>
                                    </x-jet-confirms-password>
                                @else
                                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                                        <button type="button" class="btn btn-secondary me-3">
                                            {{ __('Show Recovery Codes') }}
                                        </button>
                                    </x-jet-confirms-password>
                                @endif

                                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                                    <button type="button" class="btn btn-danger mt-ms-0" wire:loading.attr="disabled">
                                        {{ __('Disable') }}
                                    </button>
                                </x-jet-confirms-password>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
