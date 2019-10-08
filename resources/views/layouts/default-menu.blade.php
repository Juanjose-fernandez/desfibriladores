<aside id="left-panel">

    <!-- User info modified -->
    <div class="login-info header-dropdown-list-fix">
        <div class=""> <!-- User image size is adjusted inside CSS, it should stay as is -->
            <a href="javascript:void(0);" class="dropdown-toggle no-margin userdropdown" id="show-shortcut" data-toggle="dropdown" aria-expanded="false">
                @if(Auth::user()->avatar)
                    <img src="{{URL::to(Auth::user()->getAvatar())}}" alt="me" class="online" />
                @else
                    <img src="{{URL::to('img/avatars/male.png')}}" alt="me" class="online" />
                @endif
                <span>
                    {{Auth::user()->name.' '.Auth::user()->surname}}
                </span>
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-right">

                <li>
                    <a href="{{URL::to('profile')}}" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>erfil</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i>Pantalla Completa</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{URL::to('/logout')}}" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong>Cerrar sesión</strong></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- end user info -->

    <!-- NAVIGATION : This navigation is also responsive

    To make this navigation dynamic please make sure to link the node
    (the reference to the nav > ul) after page load. Or the navigation
    will not initialize.
    -->
    <nav>
        <!--
        NOTE: Notice the gaps after each icon usage <i></i>..
        Please note that these links work a bit different than
        traditional href="" links. See documentation for details.
        -->

        <ul>
       {{--     <li class="">
                <a href="{{URL::to('/')}}" title="blank_"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Home</span></a>
            </li>--}}


            @can('webmaster')

                <li class="">
                    <a href="{{route('admin.user.list')}}" title="blank_"><i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">Usuarios</span></a>
                </li>
                <li class="">
                    <a href="{{route('admin.client.index')}}" title="blank_"><i class="fa fa-lg fa-fw  fa-user-md"></i> <span class="menu-item-parent">Clientes</span></a>
                </li>

            @endcan


           @can('techncial')


            @endcan



        </ul>
    </nav>

    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

</aside>