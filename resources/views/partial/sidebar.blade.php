<header>
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div id="sidebar" class="active">
    <div class="sidebar-wrapper shadow-sm active">
        <div class="sidebar-menu">
            <ul class="menu">
                @include('partial.profile-settings')

                <li class="sidebar-title">Menu</li>

                <x-sidebar.item icon="bi-grid-fill" route="home" href="/home">
                    Home
                </x-sidebar.item>

                <x-sidebar.item icon="bi-house-fill" route="buildings" href="/buildings">
                    Edificios
                    <x-slot name="submenu">
                        <x-sidebar.submenu-item href="/buildings">
                            Lista
                        </x-sidebar.submenu-item>
                        <x-sidebar.submenu-item href="/buildings/create">
                            Añadir
                        </x-sidebar.submenu-item>
                    </x-slot>
                </x-sidebar.item>

                <x-sidebar.item icon="bi-door-closed-fill" route="apartments" href="/apartments">
                    Departamentos
                </x-sidebar.item>

                <x-sidebar.item icon="bi-person-fill" route="tenants" href="/tenants">
                    Inquilinos
                </x-sidebar.item>
            </ul>
            {{-- <div class="logo px-5 pt-3">
                <a href="/"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" class="img-fluid w-50  mx-auto d-block"></a>
            </div> --}}
        </div>
    </div>
</div>
