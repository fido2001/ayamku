<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Ayam-Ku</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">AK</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">DASHBOARD</li>
            <li class="@if(Request::fullUrl() == 'http://127.0.0.1:8000/admin' || Request::fullUrl() == 'http://127.0.0.1:8000/peternak' || Request::fullUrl() == 'http://127.0.0.1:8000/distributor') active @endif">
                <a href="#" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">FITUR</li>
            @if (Request::segment(1)=='admin')
                <li class="nav-item dropdown @if (Request::segment(1) == 'admin' and Request::segment(2) == 'kecamatan') active @endif">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i><span>Master Data</span></a>
                    <ul class="dropdown-menu">
                        <li class="@if (Request::segment(1) == 'admin' and Request::segment(2) == 'kecamatan')
                        active @endif"><a class="nav-link" href="{{ route('kecamatan.index') }}">Data Kecamatan</a></li>
                    </ul>
                </li>
            @endif
            <li class="menu-header">Pages</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
                <ul class="dropdown-menu">
                    <li><a href="auth-forgot-password.html">Forgot Password</a></li> 
                    <li><a href="auth-login.html">Login</a></li> 
                    <li><a href="auth-register.html">Register</a></li> 
                    <li><a href="auth-reset-password.html">Reset Password</a></li> 
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-exclamation"></i> <span>Errors</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="errors-503.html">503</a></li> 
                    <li><a class="nav-link" href="errors-403.html">403</a></li> 
                    <li><a class="nav-link" href="errors-404.html">404</a></li> 
                    <li><a class="nav-link" href="errors-500.html">500</a></li> 
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i> <span>Features</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="features-activities.html">Activities</a></li>
                    <li><a class="nav-link" href="features-post-create.html">Post Create</a></li>
                    <li><a class="nav-link" href="features-posts.html">Posts</a></li>
                    <li><a class="nav-link" href="features-profile.html">Profile</a></li>
                    <li><a class="nav-link" href="features-settings.html">Settings</a></li>
                    <li><a class="nav-link" href="features-setting-detail.html">Setting Detail</a></li>
                    <li><a class="nav-link" href="features-tickets.html">Tickets</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i> <span>Utilities</span></a>
                <ul class="dropdown-menu">
                    <li><a href="utilities-contact.html">Contact</a></li>
                    <li><a class="nav-link" href="utilities-invoice.html">Invoice</a></li>
                    <li><a href="utilities-subscribe.html">Subscribe</a></li>
                </ul>
            </li>
        </ul>      
    </aside>
</div>