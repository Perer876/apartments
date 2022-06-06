<div>
    @php
        if(!isset($this->firstload)) $this->firstload = true;
        else $this->firstload = false;
    @endphp
    <div class="row">
        <div class="col-12 col-md-4 order-md-1">
            <h5>
                {{ __('Profile Information') }}
            </h5>
            <p class="text-subtitle text-muted">
                {{ __('Update your account\'s profile information and email address.') }}
            </p>
        </div>
        <div class="col-12 col-md-8 order-md-2">
            <div class="card shadow-sm m-0">
                <div class="card-content">
                    <div class="card-body">
                        <form wire:submit.prevent="updateProfileInformation">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <div x-data="{photoName: null, photoPreview: null}">
                                    <!-- Profile Photo File Input -->
                                    <input type="file" class="visually-hidden"
                                        wire:model="photo"
                                        x-ref="photo"
                                        x-on:change="
                                            photoName = $refs.photo.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                photoPreview = e.target.result;
                                            };
                                            reader.readAsDataURL($refs.photo.files[0]);
                                        "/>

                                    <div class="form-group">
                                        <label for="photo">
                                            {{ __('Photo') }}
                                        </label>
                                        <br>
                                        <!-- Current Profile Photo -->
                                        <div class="text-sm-start text-center" x-show="! photoPreview">
                                            <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-circle" width="150em">
                                        </div>
    
                                        <!-- New Profile Photo Preview -->
                                        <div class="text-sm-start text-center" x-show="photoPreview" style="display: none;">
                                            <img x-bind:src="photoPreview" alt="{{ $this->user->name }}" class="rounded-circle" width="150em">
                                        </div>

                                        <div class="d-grid gap-2 d-sm-block my-3">
                                            <button class="btn btn-outline-info " type="button" x-on:click.prevent="$refs.photo.click()">
                                                {{ __('Select A New Photo') }}
                                            </button>
        
                                            @if ($this->user->profile_photo_path)
                                                <button type="button" class="btn btn-outline-danger ms-0 ms-sm-2" wire:click="deleteProfilePhoto">
                                                    {{ __('Remove Photo') }}
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                    @error('photo')
                                        <span class="badge bg-light-danger text-wrap">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif


                            <x-forms.input 
                                label="{{ __('Name') }}"
                                wire:model.defer="state.name"
                                name="name"
                                type="text"
                                validate="{{$this->firstload ? null : 'yes'}}"
                                placeholder="{{ __('Name') }}"
                            />
                            
                            <x-forms.input 
                                label="{{ __('Email') }}"
                                wire:model.defer="state.email"
                                name="email"
                                type="email"
                                validate="{{$this->firstload ? null : 'yes'}}"
                                placeholder="{{ __('Email') }}"
                            />

                            <div class="d-flex w-100 justify-content-between align-items-start mb-1">
                                <button class="btn btn-primary mt-2" type="submit"
                                    wire:loading.attr="disabled" wire:target="photo">
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