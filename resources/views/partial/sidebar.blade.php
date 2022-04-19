<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="logo px-5 py-2">
            <a href="/"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" class="img-fluid"></a>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <x-sidebar.item icon="bi bi-egg-fill" route="bienvenido" href="/bienvenido">
                    Home
                </x-sidebar.item>

                <x-sidebar.item icon="bi bi-house-fill" route="buildings" href="/buildings">
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

                <x-sidebar.item icon="bi bi-door-closed-fill" route="apartments" href="/apartments">
                    Departamentos
                </x-sidebar.item>

                <x-sidebar.item icon="bi bi-person-fill" route="tenants" href="/tenants">
                    Inquilinos
                </x-sidebar.item>
            </ul>
        </div>
    </div>
</div>
<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
