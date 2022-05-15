<div class="accordion" id="cardAccordion">
    <div id="headingOne" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" role="button">
        <div class="user-menu d-flex ms-3">
            <div class="user-img d-flex align-items-center me-3">
                <div class="avatar avatar-lg">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    @else
                        <img src="{{asset('assets/images/faces/1.jpg')}}" alt="{{ Auth::user()->name }}">
                    @endif
                </div>
            </div>
            <div class="user-name text-end user-select-none">
                <h6 class="mb-0 fs-5 text-gray-600">{{Auth::user()->name}}</h6>
                <p class="mb-0 text-sm text-gray-600">
                    @role('lessor')
                        Arrendador
                    @elserole('tenant')
                        Inquilino
                    @endrole
                </p>
            </div>
        </div>
    </div>
    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#cardAccordion">
        <li class="sidebar-title">Perfil</li>
        <x-sidebar.item icon="bi-person" route="user" href="/user/profile">
            Mi perfil
        </x-sidebar.item>

        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
            <x-sidebar.item icon="bi-journal-code" route="api-tokens" href="{{ route('api-tokens.index') }}">
                {{ __('API Tokens') }}
            </x-sidebar.item>
        @endif

        <form method="POST" action="{{ route('logout') }}" x-data>
            @csrf
            <x-sidebar.item icon="bi-box-arrow-left" route="logout" href="{{ route('logout') }}" @click.prevent="$root.submit();">
                Cerrar sesión
            </x-sidebar.item>
        </form>

        <!-- Team Management -->
        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
            <div class="border-t border-gray-200"></div>

            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Manage Team') }}
            </div>

            <!-- Team Settings -->
            <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                {{ __('Team Settings') }}
            </x-jet-responsive-nav-link>

            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                    {{ __('Create New Team') }}
                </x-jet-responsive-nav-link>
            @endcan

            <div class="border-t border-gray-200"></div>

            <!-- Team Switcher -->
            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Switch Teams') }}
            </div>

            @foreach (Auth::user()->allTeams() as $team)
                <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
            @endforeach
        @endif
    </div>
{{--     @push('stylesheets')
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush --}}
</div>