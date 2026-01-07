<nav class="navbar navbar-expand-lg fixed-top navbar-light go-navbar">
    <div class="container-fluid px-4">

        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="https://i.postimg.cc/LX4qQXh4/Logo-Icon.png" alt="Header Logo" width="150">
        </a>

        <!-- SEARCH (DESKTOP) -->
        <form class="search-bar d-none d-lg-flex">
            <input type="text" placeholder="Search for books, publishers, or ISBNs…">
        </form>

        <!-- TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">

                <!-- SEARCH (MOBILE) -->
                 <li class="nav-item d-lg-none my-2">
                    <form class="search-bar w-100">
                        <input type="text" placeholder="Search books, publishers, ISBNs…">
                    </form>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('solutions') ? 'active' : '' }}" href="{{ route('solutions') }}">Solutions</a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pricing') ? 'active' : '' }}" href="{{ route('pricing') }}">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact Us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1 {{ request()->routeIs('catalog') ? 'active' : '' }}"
                        href="{{ route('catalog') }}"><i class="bi bi-bag"></i> <span>Catalog</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link login-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">🛒 Login</a>
                </li>

                <li class="nav-item">
                     <a href="{{ route('login-register') }}" class="btn btn-getstarted">
                        Get Started
                     </a>
                </li>

            </ul>
        </div>
    </div>
</nav>