<nav class="navbar navbar-default navbar-static-top" id="menu-admin" role="navigation" style="margin-bottom: 0;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" style="text-transform: uppercase">Hệ thống Quản lý </a>
    </div>

    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right">
        <!-- User -->
        <!-- image -->
        <li class="dropdown">{{Auth::user()->avatar}}</li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="google.com">
                {{Auth::user()->Fullname}} <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                <li><a href="#" id="info"><i class="fa fa-sign-out fa-fw"></i>Cá nhân</a></li>
                <li><a href="{{route('logout')}}" id="logout"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /<div class="navbar"></div>-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav out" id="side-menu">
                <li class="sidebar-search">
                    <a href="#"></a>

                </li>
                <!-- menu -->
                <li style="display: list-item;">
                    <a href="#"><span class=""></span>Thông tin người dùng<span class="fa arrow "></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li style="display: list-item;"><a href="{{route('user')}}">Thông tin </a></li>
                        <li style="display: list-item;"><a href="#">Tài khoản ngân hàng</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
       
        
    <!-- /.navbar-static-side -->
</nav>
