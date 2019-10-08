<header id="header"  class="margin-top-0 margin-bottom-0">
    <div id="logo-group" class="margin-top-0">

        <!-- PLACE YOUR LOGO HERE -->
        <span id="logo"> <img src="{{URL::asset('img/logos/logo.png')}}" style="max-height: 30px" alt="SOS Music 0.1"> </span>
        <!-- END LOGO PLACEHOLDER -->

    </div>


    <!-- #TOGGLE LAYOUT BUTTONS -->
    <!-- pulled right: nav area -->
    <div class="pull-right" class="margin-top-0">


        <!-- #MOBILE -->
        <!-- Top menu profile link : this shows only when top menu is active -->
        <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
            <li class="">
                <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
                    @if(Auth::user()->avatar)
                        <img src="{{URL::to(Auth::user()->getAvatar())}}" alt="me" class="online" />
                    @else
                        <img src="{{URL::to('img/avatars/male.png')}}" alt="me" class="online" />
                    @endif
                </a>
                <ul class="dropdown-menu pull-right">

                    <li class="divider"></li>
                    <li>
                        <a href="#ajax/profile.html" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{URL::to('/logout')}}" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- logout button -->
        <div id="logout" class="btn-header transparent pull-right">
            <span> <a href="{{URL::to('/logout')}}" title="Sign Out" data-action="userLogout" data-logout-msg=""><i class="fa fa-sign-out"></i></a> </span>
        </div>
        <!-- end logout button -->




        <!-- fullscreen button -->
        <div id="fullscreen" class="btn-header transparent pull-right">
            <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
        </div>
        <!-- end fullscreen button -->

    </div>
    <!-- end pulled right: nav area -->

</header>