<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-dark navbar-shadow navbar-brand-center" style="background-color: @yield('header-color', '#339966 ')">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="javascript:void(0);"><i class="ft-menu"></i></a></li>
                    <li class="dropdown nav-item mega-dropdown d-none d-lg-block"><a class="dropdown-toggle nav-link" @role('admin') href="@yield('header-hrefadm', route('admin.dashboard'))" @else href="@yield('header-href', route('dashboard'))" @endrole><span class="mr-1 user-name text-bold-700">@yield('header-title', 'MA KANJENG SEPUH SIDAYU')</span></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    @if (auth()->user()->hasRole('teacher') && request()->is('dashboard'))
                    <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link btn-modal" id="dropdown-flag"  href="javascript:void(0);" data-href="{{ route('kelas-mapel.create') }}" data-container=".app-modal" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-plus fa-lg"></i></a>
                    </li>
                    @endif
                    @if (auth()->user()->hasRole('teacher') && request()->is('kelas-mapel/*'))
                    @yield('header-clas')
                    @endif
                    @if (auth()->user()->hasRole('teacher') && request()->is('*/ujian/*'))
                    @yield('header-clas-exam')
                    @endif
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="avatar avatar-online"><img src="{{ auth()->user()->avatar ? asset('storage/images/' . auth()->user()->avatar) : asset('assets/images/profile.png') }}" alt="avatar"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="fa fa-user"></i> Edit Profile</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>