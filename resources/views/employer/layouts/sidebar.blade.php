<!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{url('employer/dashboard')}}"><span class="brand-logo">
                            </span>
                        <h2 class="brand-text">{{config('app.name')}}</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('employer/dashboard')}}"><i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Email">Dashboard</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('employer/posted-jobs')}}"><i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Email">Posted Jobs</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->