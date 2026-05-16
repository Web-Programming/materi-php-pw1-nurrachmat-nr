<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">PT. ABC</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap d-flex align-items-center px-3">
      @auth
        <span class="text-white me-3">Halo, <strong>{{ Auth::user()->name }}</strong></span>
        <form action="{{ url('/logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
        </form>
      @else
        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-sm me-2">Login</a>
        <a href="{{ url('/register') }}" class="btn btn-light btn-sm">Daftar</a>
      @endauth
    </div>
  </div>
</header>