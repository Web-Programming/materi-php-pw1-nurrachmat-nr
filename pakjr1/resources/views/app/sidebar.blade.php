<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
    <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ url('/dashboard') }}">
            <i class="bi bi-house-door me-2"></i>
            Dashboard
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="bi bi-receipt me-2"></i>
            Pesanan
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link {{ request()->is('barang') ? 'active' : '' }}" href="{{ url('/barang') }}">
            <i class="bi bi-box-seam me-2"></i>
            Data Barang
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link {{ request()->is('barang/create') ? 'active' : '' }}" href="{{ url('/barang/create') }}">
            <i class="bi bi-plus-square me-2"></i>
            Tambah Barang
        </a>
        </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Laporan</span>
        <a class="link-secondary" href="#" aria-label="Add a new report">
        <i class="bi bi-plus-circle"></i>
        </a>
    </h6>
    <ul class="nav flex-column mb-2">
        <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="bi bi-file-earmark-text me-2"></i>
            Bulan ini
        </a>
        </li>
    </ul>
    </div>
</nav>