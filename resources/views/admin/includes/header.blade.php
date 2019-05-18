<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
        <span class="logo-mini">
            <img src="{{ asset('public/plugins/logo-icon.png') }}" style="height: 16px;">
        </span>
        <span class="logo-lg">
            <img src="{{ asset('public/plugins/logo.png') }}" style="height: 51px;">
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ asset ( 'public/plugins/Themes/AdminLTE/dist/img/user2-160x160.jpg' ) }}" class="img-circle" alt="">
                            <p>
                                {{ Auth::user()->name }}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ url('/my_profile') }}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    <button type="submit" class="btn btn-default btn-flat"  value="Sign out"/>Sign out
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->

            </ul>
        </div>
    </nav>
</header>