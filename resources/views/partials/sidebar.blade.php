@php
    $sidebarProfileUrl = auth()->user()->profile ? asset('storage/' . auth()->user()->profile) : null;
@endphp
<div class="profile-section">
    <div class="profile-icon @if ($sidebarProfileUrl) has-photo @endif"
        @if ($sidebarProfileUrl) style="background-image:url('{{ $sidebarProfileUrl }}')" @endif>
        @if (!$sidebarProfileUrl)
            {{ strtoupper(substr(auth()->user()->role, 0, 1)) }}
        @endif
    </div>
    <div class="profile-name">{{ ucfirst(auth()->user()->role) }}</div>
    <div class="profile-status">VERIFIED</div>
</div>

<nav>
    @if (auth()->user()->role === 'administrator')
        <a href="{{ route('admin.dashboard') }}"
            class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            Admin Hub
        </a>

        <a href="{{ route('admin.student_record') }}"
            class="menu-item {{ request()->routeIs('admin.student_record') ? 'active' : '' }}">
            Student Records
        </a>

        <a href="{{ route('admin.profile') }}"
            class="menu-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            School Profile
        </a>

        <a href="{{ route('admin.rfq_inbox') }}"
            class="menu-item {{ request()->routeIs('admin.rfq_inbox*') ? 'active' : '' }}">
            RFQ Inbox
        </a>

        <a href="{{ route('admin.manage_records') }}"
            class="menu-item {{ request()->routeIs('admin.manage_records*') ? 'active' : '' }}">
            Manage Records
        </a>

        <div class="dropdown">

            <a href="#" class="menu-item dropdown-toggle " type="button" id="masterDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                Manage Academy
            </a>
            <ul class="dropdown-menu" aria-labelledby="masterDropdown">

                <li>
                    <a class="dropdown-item {{ request()->routeIs('admin.boards') ? 'active' : '' }}"
                        href="{{ route('admin.boards') }}"> Boards</a>
                </li>
                <li>
                    <a class="dropdown-item {{ request()->routeIs('admin.academic_sessions') ? 'active' : '' }}"
                        href="{{ route('admin.academic_sessions') }}"> Academic Sessions</a>
                </li>
                <li>
                    <a class="dropdown-item {{ request()->routeIs('admin.mediums') ? 'active' : '' }}"
                        href="{{ route('admin.mediums') }}"> Create Regional (Medium)</a>
                </li>

            </ul>
        </div>
    @endif

    @if (auth()->user()->role === 'distributor')
        <a href="{{ route('distributor.dashboard') }}" class="menu-item"> Distributor Hub</a>
        <a href="{{ route('distributor.manage_cateloge') }}" class="menu-item"> Catalogue</a>


        <a href="{{ route('distributor.profile') }}"
            class="menu-item {{ request()->routeIs('distributor.profile') ? 'active' : '' }}">
            Distributor Profile
        </a>

        <a href="{{ route('distributor.rfq_inbox') }}"
            class="menu-item {{ request()->routeIs('distributor.rfq_inbox*') ? 'active' : '' }}">
            RFQ Inbox
        </a>

        <a href="{{ route('distributor.manage_records') }}"
            class="menu-item {{ request()->routeIs('distributor.manage_records*') ? 'active' : '' }}">
            Manage Records
        </a>
        <div class="dropdown">

            <a href="#" class="menu-item dropdown-toggle " type="button" id="masterDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                Manage Academy
            </a>
            <ul class="dropdown-menu" aria-labelledby="masterDropdown">

                <li>
                    <a class="dropdown-item {{ request()->routeIs('distributor.boards') ? 'active' : '' }}"
                        href="{{ route('distributor.boards') }}"> Boards</a>
                </li>
                <li>
                    <a class="dropdown-item {{ request()->routeIs('distributor.academic_sessions') ? 'active' : '' }}"
                        href="{{ route('distributor.academic_sessions') }}"> Academic Sessions</a>
                </li>
                <li>
                    <a class="dropdown-item {{ request()->routeIs('distributor.mediums') ? 'active' : '' }}"
                        href="{{ route('distributor.mediums') }}"> Create Regional (Medium)</a>
                </li>

            </ul>
        </div>
    @endif

    @if (auth()->user()->role === 'retailer')
        <a href="{{ route('retailer.dashboard') }}" class="menu-item"> Retailer Hub</a>
        <a href="{{ route('retailer.manage_catalogue') }}" class="menu-item"> Catalogue</a>
        <a href="{{ route('retailer.profile') }}"
            class="menu-item {{ request()->routeIs('retailer.profile') ? 'active' : '' }}">
            Retailer Profile
        </a>
        <a href="{{ route('retailer.rfq_inbox') }}"
            class="menu-item {{ request()->routeIs('retailer.rfq_inbox*') ? 'active' : '' }}">
            RFQ Inbox
        </a>
        <a href="{{ route('retailer.manage_records') }}"
            class="menu-item {{ request()->routeIs('retailer.manage_records') ? 'active' : '' }}"> My Orders</a>

        <div class="dropdown">

            <a href="#" class="menu-item dropdown-toggle " type="button" id="masterDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                Manage Academy
            </a>
            <ul class="dropdown-menu" aria-labelledby="masterDropdown">

                <li>
                    <a class="dropdown-item {{ request()->routeIs('retailer.boards') ? 'active' : '' }}"
                        href="{{ route('retailer.boards') }}"> Boards</a>
                </li>
                <li>
                    <a class="dropdown-item {{ request()->routeIs('retailer.academic_sessions') ? 'active' : '' }}"
                        href="{{ route('retailer.academic_sessions') }}"> Academic Sessions</a>
                </li>
                <li>
                    <a class="dropdown-item {{ request()->routeIs('retailer.mediums') ? 'active' : '' }}"
                        href="{{ route('retailer.mediums') }}"> Create Regional (Medium)</a>
                </li>

            </ul>
        </div>
    @endif

    @if (auth()->user()->role === 'publisher')
        <a href="{{ route('publisher.dashboard') }}" class="menu-item"> Publisher Hub</a>
        <a href="{{ route('publisher.profile') }}"
            class="menu-item {{ request()->routeIs('publisher.profile') ? 'active' : '' }}">
            Publisher Profile
        </a>
        <a href="{{ route('publisher.rfq_inbox') }}"
            class="menu-item {{ request()->routeIs('publisher.rfq_inbox*') ? 'active' : '' }}">
            RFQ Inbox
        </a>
        <a href="{{ route('publisher.manage_records') }}"
            class="menu-item {{ request()->routeIs('publisher.manage_records*') ? 'active' : '' }}">
            Manage Records
        </a>
    @endif

    <a href="{{ route('logout') }}" class="menu-item sign-out"> Sign Out</a>
</nav>
