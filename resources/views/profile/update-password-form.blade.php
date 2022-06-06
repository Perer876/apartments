<div>
    @php
        if(!isset($this->firstload)) $this->firstload = true;
        else $this->firstload = false;
    @endphp
    <div class="row">
        <div class="col-12 col-md-4 order-md-1">
            <h5>
                {{ __('Update Password') }}
            </h5>
            <p class="text-subtitle text-muted">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </div>
        <div class="col-12 col-md-8 order-md-2">
            <div class="card shadow-sm m-0">
                <div class="card-content">
                    <div class="card-body">
                        <form wire:submit.prevent="updatePassword">

                            <x-forms.input 
                                label="{{ __('Current Password') }}"
                                wire:model.defer="state.current_password"
                                name="current_password"
                                type="password"
                                validate="{{$this->firstload ? null : 'yes'}}"
                                autocomplete="current-password" 
                            />
                            
                            <x-forms.input 
                                label="{{ __('New Password') }}"
                                wire:model.defer="state.password"
                                name="password"
                                type="password"
                                validate="{{$this->firstload ? null : 'yes'}}"
                                autocomplete="new-password" 
                            />
                            
                            <x-forms.input 
                                label="{{ __('Confirm Password') }}"
                                wire:model.defer="state.password_confirmation"
                                name="password_confirmation"
                                type="password"
                                validate="{{$this->firstload ? null : 'yes'}}"
                                autocomplete="new-password" 
                            />

                            <div class="d-flex w-100 justify-content-between align-items-start mb-1">
                                <button class="btn btn-primary mt-2" type="submit">
                                    {{ __('Save') }}
                                </button>
                                <x-jet-action-message class="fs-6 badge bg-light-success" on="saved">
                                    {{ __('Saved.') }}
                                </x-jet-action-message>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
