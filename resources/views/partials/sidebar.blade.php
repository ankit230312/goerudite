<div class="profile-section">
    <div class="profile-icon">{{ strtoupper(substr(auth()->user()->role,0,1)) }}</div>
    <div class="profile-name">{{ ucfirst(auth()->user()->role) }}</div>
    <div class="profile-status">VERIFIED</div>
</div>

<nav>
    @if(auth()->user()->role === 'administrator')
        <a href="{{ route('admin.dashboard') }}" class="menu-item active">🏠 Admin Hub</a>
        <a href="{{ route('admin.student_record') }}" class="menu-item">👥 Student Records</a>
        <a href="{{ route('admin.profile') }}" class="menu-item">👥 School Profile</a>
        <a href="{{ route('admin.rfq_inbox') }}" class="menu-item">📨 RFQ Inbox</a>
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
