<!doctype html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html> <!--<![endif]-->

 @include('layouts.header')
    <body class="">
        <header>
            <nav class="navbar navbar-default navbar-fixed-top  no-margin" role="navigation">
                <div class="navbar-brand-group">
                    <a class="navbar-sidebar-toggle navbar-link" data-sidebar-toggle>
                        <i class="fa fa-lg fa-fw fa-bars"></i>
                    </a>
                    <a class="navbar-brand hidden-xxs" href="{{url('/')}}">
                        <span class="sc-visible">
                            V
                        </span>
                        <span class="sc-hidden">
                            <span class="bold">Tasks Management</span>
                            Portal
                        </span>
                    </a>
                </div>
                <ul class="nav navbar-nav navbar-nav-expanded pull-right margin-md-right">
                    <li class="hidden-xs">
                        <form class="navbar-form">
                            <div class="navbar-search">
                                <input type="text" placeholder="Search &hellip;" class="form-control">
                                <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </li>
                    @include('layouts.messages')
                    
                    @include('layouts.notif')
                    
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle navbar-user" href="javascript:;">
                            <img class="img-circle" src="{{ url('/') }}/demo/images/profile.jpg">
                                <span class="hidden-xs">{{ Auth::user()->first_name }}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu pull-right-xs">
                            <li class="arrow"></li>
                            <li><a href="pages-profile.html">Profile</a></li>
                            <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
                            <li><a href="javascript:;">Messages</a></li>
                            <li><a href="javascript:;">Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/logout')}}">Log Out</a></li>
                        </ul>
                    </li>
                </ul>

            </nav>
        </header>
        <div class="page-wrapper">
            <aside class="sidebar sidebar-default" style="position: fixed;">
                <div class="sidebar-profile">
                    <img class="img-circle profile-image" src="{{ url('/') }}/demo/images/profile.jpg">
                     <div class="profile-body">
                        <h4>{{Auth::user()->first_name}}&nbsp;{{Auth::user()->last_name}}</h4>

                        <div class="sidebar-user-links">
                            <a class="btn btn-link btn-xs" href="{{url('/dashboard')}}" data-placement="bottom" data-toggle="tooltip" data-original-title="Profile"><i class="fa fa-user"></i></a>
                            <a class="btn btn-link btn-xs" href="javascript:;"       data-placement="bottom" data-toggle="tooltip" data-original-title="Messages"><i class="fa fa-envelope"></i></a>
                            <a class="btn btn-link btn-xs" href="javascript:;"       data-placement="bottom" data-toggle="tooltip" data-original-title="Settings"><i class="fa fa-cog"></i></a>
                            <a class="btn btn-link btn-xs" href="{{url('/logout')}}" data-placement="bottom" data-toggle="tooltip" data-original-title="Logout"><i class="fa fa-sign-out"></i></a>
                        </div>
                    </div>
                </div>
           @include('layouts.sidenav')
            </aside>
            <div class="page-content">
                
                @yield('content')
            </div>
        </div>
        @include ('layouts.footer')

    </body>
</html>
