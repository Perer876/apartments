<x-base>
    @include('partial.sidebar')
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Perfil</h3>
                <p class="text-subtitle text-muted">Editar información del perfil.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    <x-breadcrumb.item href="{{route('home')}}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item>Perfil</x-breadcrumb.item>
                </x-breadcrumb>
            </div>
        </div>
    </div>
    
    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
        <div class="py-3">
            @livewire('profile.update-profile-information-form')
        </div>
        <hr>
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="py-3">
            @livewire('profile.update-password-form')
        </div>
        <hr>
    @endif

    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        <div class="py-3">
            @livewire('profile.two-factor-authentication-form')
        </div>
        <hr>
    @endif

    {{-- <div class="mt-10 sm:mt-0">
        @livewire('profile.logout-other-browser-sessions-form')
    </div> --}}

    {{-- @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
        <x-jet-section-border />

        <div class="mt-10 sm:mt-0">
            @livewire('profile.delete-user-form')
        </div>
    @endif --}}
    @push('stylesheets')
        @livewireStyles
    @endpush
    @push('scripts')
        @livewireScripts
    @endpush
</x-base>