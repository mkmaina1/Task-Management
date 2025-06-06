<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('/dashboard') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar icons -->
    <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">3 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-tasks mr-2"></i> 2 new tasks
                    <span class="float-right text-muted text-sm">10 mins</span>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user-plus mr-2"></i> 1 new user
                    <span class="float-right text-muted text-sm">1 hour</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>

        <!-- User Profile Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user-circle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-id-card mr-2"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>


<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">TaskNova</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                <small class="text-muted">{{ Auth::user()->email }}</small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- My Tasks -->
                <li class="nav-item">
                    <a href="{{ route('tasks.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>My Tasks</p>
                    </a>
                </li>

                <!-- Create Task -->
                <li class="nav-item">
                    <a href="{{ route('tasks.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-plus-circle"></i>
                        <p>Create Task</p>
                    </a>
                </li>
           <!--Reports -->
                <li class="nav-item">
    <a href="{{ route('reports.index') }}" class="nav-link">
        <i class="nav-icon fas fa-comments"></i>
        <p>Reports</p>
    </a>
</li>

                    
                <!-- Settings -->
                <li class="nav-item">
                    <a href="{{ route('settings') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Settings</p>
                    </a>
                </li>

                <!-- Admin Panel (only for admins) -->
               @if(Auth::user() && Auth::user()->isAdmin()) 
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tools"></i>
            <p>
                Admin Panel
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage Users</p>
                </a>
            </li>
        </ul>
    </li>
    @endif 
                 <!-- SuperAdmin Panel (only for super_admins) -->
            @if(auth()->check() && auth()->user()->isSuperAdmin())
 <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tools"></i>
            <p>
                Super Admin
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('super_admin.dashboard') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('super_admin.manageusers') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage Users & Admins</p>
                </a>
            </li>
        </ul>
    </li>
    @endif






                <!-- Logout -->
                <li class="nav-item mt-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block btn-sm">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>


