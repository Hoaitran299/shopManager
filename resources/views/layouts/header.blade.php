<nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="margin-left: 0px">
    <div class="container" style="margin-left: 0px">
        <a href="#" class="navbar-brand" style="width: 200px;">
            <img src="{{ asset('img/logo.png') }}" width="100%" height="100%" alt="RiverCrane Vietnam" style="opacity: .8">
        </a>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('products') }}" class="nav-link justify-content-center align-items-center">Sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('customers') }}" class="nav-link">Khách hàng</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link">Users</a>
                </li>
            </ul>
            
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
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
    </div>
</nav>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $childMenu? $childMenu :$TitlePage }}</h1>
            </div>
            <div class="col-sm-6" >
                <ol class="breadcrumb float-sm-right menuRight">
                    <li class="breadcrumb-item menu1"><a href="{{$redirect}}">{{ $TitlePage }}</a></li>
                    <li class="breadcrumb-item menu2">{{ $childMenu }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr id="hrTitle">