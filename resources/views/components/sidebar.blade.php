<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Admin</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">HI</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>
            <li class="menu-header">Pages</li>
            <li class="{{ request()->routeIs('users.index') || request()->is('users/create') || request()->is('users/*/edit') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}"><i class="fas fa-users"></i> <span>Users</span></a>
            </li>

        </ul>
    </aside>
</div>
