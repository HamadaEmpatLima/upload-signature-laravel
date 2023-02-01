@php
    $names = explode(' ', session('name') ?? 'User');
    $firstName = $names[0];
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img class="img-circle elevation-2" src="https://eu.ui-avatars.com/api/?name={{ $firstName }}&size=250"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $firstName }}</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('document.index') }}" class="nav-link @yield('document')">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Documents
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile.index') }}" class="nav-link @yield('profile')">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
