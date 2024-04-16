<!-- NAVBAR START -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="container">
    <a class="navbar-brand" href="/">ALI TEKNIK</a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#service">Layanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Kontak</a>
        </li>
      </ul>
      @guest
        <div class="menu-auth text-center mt-4 mt-lg-0">
          <a
            href="{{ route('register') }}"
            class="mr-lg-3 btn-daftar d-block d-lg-inline"
            >Daftar</a
          >
          <a
            href="{{ route('login') }}"
            class="btn btn-second d-block d-lg-inline mt-3 mt-lg-0"
            >Masuk</a
          >
        </div>
      @endguest

      @auth
        <!-- Desktop Menu -->
        <ul class="navbar-nav d-none d-lg-flex">
          <li class="nav-item dropdown">
            <a
              href="#"
              class="nav-link p-0"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
            >
              <img
                src="/images/icon-user.png"
                alt=""
                class="rounded-circle profile-picture"
              />
              Hi, {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu">
              @if ( Auth::user()->roles == 'ADMIN' )
              <a href="{{ route('admin-dashboard') }}" class="dropdown-item">Admin</a>
              @endif
              <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>
        </ul>

        <!-- Mobile Menu -->
        <ul class="navbar-nav d-block d-lg-none">
          <li class="nav-item">
            <a href="#" class="nav-link">Hi, {{ Auth::user()->name }}</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link d-inline-block">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>
        </ul>
      @endauth
    </div>
  </div>
</nav>
<!-- NAVBAR END -->