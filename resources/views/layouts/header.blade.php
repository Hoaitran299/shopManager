<div class="container-fluid pr-0 pl-0">
    <nav class="navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">
            <a class="navbar-brand" href="{{ route('products') }}"><img src="{{ asset('img/logo.png') }}" width="100%"
                    height="60%" alt="RiverCrane Vietnam"></a>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="" class="nav-link justify-content-center align-items-center">Sản phẩm</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('customers.index') }}" class="nav-link">Khách hàng</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('user.index') }}" class="nav-link">Users</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Shop</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user-circle mr-1"></i>
                    <span class="float-right text-muted text-sm">{{ucfirst(Auth()->user()->name)}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item">
                        <i class="fas fa-right-from-bracket mr-2"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
</div>
