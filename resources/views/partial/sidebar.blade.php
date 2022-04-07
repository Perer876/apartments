<div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="index.html"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" srcset=""></a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>
            
            <x-sidebar-item icon="bi bi-egg-fill" route="bienvenido" href="/bienvenido">
                Dashboard
            </x-sidebar-item>

            <x-sidebar-item icon="bi bi-house-fill" route="buildings" href="/buildings">
                Edificios
            </x-sidebar-item>
            
            <x-sidebar-item icon="bi bi-door-closed-fill" route="apartments" href="/apartments">
                Departamentos
            </x-sidebar-item>
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
