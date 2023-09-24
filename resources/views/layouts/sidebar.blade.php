<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item {{ request()->is('home') ? 'active' : '' }} ">
            <a href="{{ route('home') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @role('user')
            <li class="sidebar-item {{ request()->is('pengguna/list-activity*') ? 'active' : '' }} ">
                <a href="{{ route('pengguna.index-list-activity') }}" class='sidebar-link'>
                    <i class="bi bi-activity"></i>
                    <span>Kegiatan</span>
                </a>
            </li>
        @endrole

        @role('operator')
            <li
                class="sidebar-item has-sub
            {{ request()->is('operator/user*') ? 'active' : '' }} ||
            {{ request()->is('operator/employee*') ? 'active' : '' }} 
            ">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-people"></i>
                    <span>Data User</span>
                </a>
                <ul class="submenu">
                    {{-- menu operator have controller is name UserController --}}
                    {{-- operator is admin --}}
                    <li class="submenu-item {{ request()->is('operator/user*') ? 'active' : '' }}">
                        <a href="{{ route('operator.user.index') }}">
                            Operator
                        </a>
                    </li>
                    {{-- menu pengguna have controller is name emplooyeeControoler  --}}

                    <li class="submenu-item {{ request()->is('operator/employee*') ? 'active' : '' }}">
                        <a href="{{ route('operator.employee.index') }}">
                            Pengguna
                        </a>
                    </li>
                </ul>
            </li>

            <li
                class="sidebar-item has-sub
            {{ request()->is('operator/activity-categories*') ? 'active' : '' }} ||
            {{ request()->is('operator/activities*') ? 'active' : '' }}
            ">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-stack"></i>
                    <span>Kegiatan</span>
                </a>

                <ul class="submenu">
                    <li class="submenu-item {{ request()->is('operator/activity-categories*') ? 'active' : '' }}">
                        <a href="{{ route('operator.activity-categories.index') }}">
                            Kategori Kegiatan
                        </a>
                    </li>

                    <li class="submenu-item {{ request()->is('operator/activities*') ? 'active' : '' }}">
                        <a href="{{ route('operator.activities.index') }}">
                            Kegiatan
                        </a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item {{ request()->is('operator/report*') ? 'active' : '' }} ">
                <a href="{{ route('operator.index-report') }}" class='sidebar-link'>
                    <i class="bi bi-flag-fill"></i>
                    <span>Laporan</span>
                </a>
            </li>
        @endrole
    </ul>
</div>
