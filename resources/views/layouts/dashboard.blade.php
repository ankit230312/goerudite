<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('assets/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

</head>

<body>

<header class="header">
    {{-- HEADER COMMON --}}
    <button class="mobile-menu-toggle" onclick="toggleSidebar()">☰</button>

    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="https://i.postimg.cc/LX4qQXh4/Logo-Icon.png" width="150">
        </a>
    </div>

    <div class="search-bar">
        <input type="text" placeholder="Search for books, publishers, or ISBNs...">
    </div>

    <div class="header-right">
        <button class="browse-btn">Browse Catalogs 📚</button>
        <div class="dashboard-wrapper">
            <button class="dashboard-btn">
                <span>{{ strtoupper(auth()->user()->role) }}</span>
                <span class="arrow">▼</span>
            </button>

            <div class="dashboard-dropdown">
                <ul>
                    <li class="verified">
                        ✔ KYC STATUS: VERIFIED
                    </li>
                    <li><a href="{{ route('logout') }}">Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>

<div class="main-container">
    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">
        @include('partials.sidebar')
    </aside>

    {{-- PAGE CONTENT --}}
    <main class="content">
        @yield('content')
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('active');
}
</script>

@stack('scripts')
</body>
</html>
