<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
    <div class="sidebar-brand-text mx-3">Admin CB</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->

<li class="nav-item">
    <a class="nav-link" href="/home">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
@if(HelperPer::checkPermisos(1))
<!-- Heading -->
<div class="sidebar-heading">
    Facturas
</div>

<li class="nav-item">
    <a class="nav-link" href="{{ route('facturas.create') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Facturas</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
@endif

@if(HelperPer::checkPermisos(2) || HelperPer::checkPermisos(3) || HelperPer::checkPermisos(4) || HelperPer::checkPermisos(5) || HelperPer::checkPermisos(6))
<!-- Heading -->
<div class="sidebar-heading">
    Administrativo
</div>
@endif
<!-- Nav Item - Tables -->

@if(HelperPer::checkPermisos(2))
<li class="nav-item">
    <a class="nav-link" href="{{ route('informes.informe1') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Consolidado de ventas por medio de pago</span>
    </a>
</li>
@endif

@if(HelperPer::checkPermisos(3))
<li class="nav-item">
    <a class="nav-link" href="{{ route('informes.informe2') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Detalle de ventas por medio de pago</span>
    </a>
</li>
@endif

@if(HelperPer::checkPermisos(4))
<li class="nav-item">
    <a class="nav-link" href="">
        <i class="fas fa-fw fa-table"></i>
        <span>Informe 3</span>
    </a>
</li>
@endif

@if(HelperPer::checkPermisos(5))
<li class="nav-item">
    <a class="nav-link" href="{{ route('metodos_de_pago.index') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Formas de Pago</span>
    </a>
</li>
@endif

@if(HelperPer::checkPermisos(6))
<li class="nav-item">
    <a class="nav-link" href="{{ route('usuarios.index') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Usuarios</span>
    </a>
</li>
@endif

@if(HelperPer::checkPermisos(2) || HelperPer::checkPermisos(3) || HelperPer::checkPermisos(4) || HelperPer::checkPermisos(5) || HelperPer::checkPermisos(6))
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
@endif

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->