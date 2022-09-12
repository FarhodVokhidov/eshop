<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.category')}}">
                <i class="mdi mdi-view-headline menu-icon"></i>
                <span class="menu-title">Category</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.brands')}}">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">Brand</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
