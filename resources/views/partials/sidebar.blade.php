<div class="profile-section">
    <div class="profile-icon">{{ strtoupper(substr(auth()->user()->role,0,1)) }}</div>
    <div class="profile-name">{{ ucfirst(auth()->user()->role) }}</div>
    <div class="profile-status">VERIFIED</div>
</div>

<nav>
    @if(auth()->user()->role === 'administrator')

        <a href="{{ route('admin.dashboard') }}"
        class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            🏠 Admin Hub
        </a>

        <a href="{{ route('admin.student_record') }}"
        class="menu-item {{ request()->routeIs('admin.student_record') ? 'active' : '' }}">
            👥 Student Records
        </a>

        <a href="{{ route('admin.profile') }}"
        class="menu-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            🏫 School Profile
        </a>

        <a href="{{ route('admin.rfq_inbox') }}"
        class="menu-item {{ request()->routeIs('admin.rfq_inbox*') ? 'active' : '' }}">
            📨 RFQ Inbox
        </a>

        <a href="{{ route('admin.manage_records') }}"
        class="menu-item {{ request()->routeIs('admin.manage_records*') ? 'active' : '' }}">
            📋 Manage Records
        </a>

    @endif

    @if(auth()->user()->role === 'distributor')
        <a href="{{ route('distributor.dashboard') }}" class="menu-item">🏠 Distributor Hub</a>
        <a href="#" class="menu-item">📦 Orders</a>
    @endif

    @if(auth()->user()->role === 'retailer')
        <a href="{{ route('retailer.dashboard') }}" class="menu-item">🏠 Retailer Hub</a>
        <a href="#" class="menu-item">🛒 My Orders</a>
    @endif

    @if(auth()->user()->role === 'publisher')
        <a href="{{ route('publisher.dashboard') }}" class="menu-item">🏠 Publisher Hub</a>
        <a href="#" class="menu-item">📚 My Books</a>
    @endif

    <a href="{{ route('logout') }}" class="menu-item sign-out">🚪 Sign Out</a>
</nav>
