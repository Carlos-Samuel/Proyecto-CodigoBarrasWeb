<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-calculator"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->



<li class="nav-item">
    <a class="nav-link" href="/dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Facturas
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Components</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Buttons</a>
            <a class="collapse-item" href="cards.html">Cards</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Utilities</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Administrativo
</div>

<!-- Nav Item - Pages Collapse Menu -->
<!--
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Pages</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
        </div>
    </div>
</li>
-->
<!-- Nav Item - Charts -->
<!--
<li class="nav-item">
    <a class="nav-link" href="/cuentas">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Plan de cuentas</span></a>
</li>
-->
<!-- Asistencia -->
<!--
<li class="nav-item">
    <a class="nav-link" href="/ayuda">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Ayuda</span></a>
</li>
-->
<!-- Nav Item - Tables -->
<!-- Nav Item - Para Permisos -->
<!--
<li class="nav-item">
    <a class="nav-link" href="/indexController">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Permisos</span></a>
</li>
-->
<!-- Nav Item - Tables -->
@if(HelperPer::checkPermisos(1))
<li class="nav-item">
    <a class="nav-link" href="/obtenerRut">
        <i class="fas fa-fw fa-table"></i>
        <span>Rut</span></a>
</li>
@endif

<li class="nav-item">
    <a class="nav-link" href="/ticketsIndex">
        <i class="fas fa-fw fa-table"></i>
        <span>Tickets</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="/tercerosIndex">
        <i class="fas fa-fw fa-table"></i>
        <span>Terceros</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="/graficosIndex">
        <i class="fas fa-fw fa-table"></i>
        <span>Graficos</span></a>
</li>
<!--
<li class="nav-item">
    <a class="nav-link" href="/graficosMapas">
        <i class="fas fa-fw fa-table"></i>
        <span>Grafico Mapa</span></a>
</li>
-->
<li class="nav-item">
    <a class="nav-link" href="{{ route('facturas.create') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Facturas</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="">
        <i class="fas fa-fw fa-table"></i>
        <span>Informe 1</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="">
        <i class="fas fa-fw fa-table"></i>
        <span>Informe 2</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="">
        <i class="fas fa-fw fa-table"></i>
        <span>Informe 3</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('metodos_de_pago.index') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Formas de Pago</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('usuarios.index') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Usuarios</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->
<!--
<div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="{{ asset('img/undraw_rocket.svg') }}" alt="...">
    <p class="text-center mb-2"><strong>Pruebas de pruebas</strong> lo mismo pero en minuscula</p>
    <a class="btn btn-success btn-sm" href="#">Y esto es un link</a>
</div>
-->

</ul>
<!-- End of Sidebar -->