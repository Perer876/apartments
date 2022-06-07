<div>
    <div class="row">
        <div class="col-12 col-md-4 order-md-1">
            <h5>
                {{ __('Browser Sessions') }}
            </h5>
            <p class="text-subtitle text-muted">
                {{ __('Manage and logout your active sessions on other browsers and devices.') }}
            </p>
        </div>
        <div class="col-12 col-md-8 order-md-2">
            <div class="card shadow-sm m-0">
                <div class="card-content">
                    <div class="card-body">

                        <p class="card-text">
                            {{ __('If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.') }}
                        </p>

                        @if (count($this->sessions) > 0)
                            <div>
                                <!-- Other Browser Sessions -->
                                @foreach ($this->sessions as $session)
                                    <div class="d-flex justify-content-start mb-2">
                                        <div>
                                            @if ($session->agent->isDesktop())
                                                <i class="bi bi-pc-display-horizontal fs-2"></i>
                                            @else
                                                <i class="bi bi-phone"></i>
                                            @endif
                                        </div>

                                        <div class="ms-3">
                                            <div class="card-text fw-bold">
                                                {{ $session->agent->platform() ? $session->agent->platform() : 'Unknown' }} - {{ $session->agent->browser() ? $session->agent->browser() : 'Unknown' }}
                                            </div>

                                            <div>
                                                <div class="card-text">
                                                    {{ $session->ip_address }},

                                                    @if ($session->is_current_device)
                                                        <span class="badge rounded-pill bg-light-success">{{ __('This device') }}</span>
                                                    @else
                                                        {{ __('Last active') }} {{ $session->last_active }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="flex items-center mt-5">
                            <button type="button" class="btn btn-primary" wire:click="confirmLogout" wire:loading.attr="disabled">
                                {{ __('Logout Other Browser Sessions') }}
                            </button>

                            <x-jet-action-message class="fs-6 badge bg-light-success" on="loggedOut">
                                {{ __('Done.') }}
                            </x-jet-action-message>
                        </div>

                        <!-- Log Out Other Devices Confirmation Modal -->
                        <x-jet-dialog-modal wire:model="confirmingLogout">
                            <x-slot name="title">
                                <h3 class="card-title">{{ __('Logout Other Browser Sessions') }}</h3>
                            </x-slot>

                            <x-slot name="content">
                                {{ __('Please enter your password to confirm you would like to logout of your other browser sessions across all of your devices.') }}

                                <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                                placeholder="{{ __('Password') }}"
                                                x-ref="password"
                                                wire:model.defer="password"
                                                wire:keydown.enter="logoutOtherBrowserSessions" />

                                    <x-jet-input-error for="password" class="mt-2" />
                                </div>
                            </x-slot>

                            <x-slot name="footer">
                                <button type="button" class="btn btn-secondary" wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                                    {{ __('Cancel') }}
                                </button>

                                <button type="button" class="btn btn-primary ms-3"
                                            wire:click="logoutOtherBrowserSessions"
                                            wire:loading.attr="disabled">
                                    {{ __('Logout Other Browser Sessions') }}
                                </button>
                            </x-slot>
                        </x-jet-dialog-modal>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
