<!DOCTYPE html>
<html lang="en-us" id="extr-page">
<head>
    <meta charset="utf-8">
    <title> ESFOREM 1.0</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- #CSS Links -->
    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('css/font-awesome.min.css') }}">

    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('css/smartadmin-production.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('css/smartadmin-skins.min.css') }}">

    <!-- SmartAdmin RTL Support -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('css/smartadmin-rtl.min.css') }}">


    <!-- We recommend you use "your_style.css" to override SmartAdmin
         specific styles this will also ensure you retrain your customization with each SmartAdmin update.
    <link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->

    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="{{URL::to('img/favicon/favicon.png')}}" type="image/x-icon">
    <link rel="icon" href="{{URL::to('img/favicon/favicon.png')}}" type="image/x-icon">


    <!-- #GOOGLE FONT -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    <!-- #APP SCREEN / ICONS -->
    <!-- Specifying a Webpage Icon for Web Clip
         Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
    <link rel="apple-touch-icon" href="img/splash/sptouch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/splash/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/splash/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/splash/touch-icon-ipad-retina.png">

    <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Startup image for web apps -->
    <link rel="apple-touch-startup-image" href="img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="img/splash/iphone.png" media="screen and (max-device-width: 320px)">

</head>

<body class="animated fadeInDown">




<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">

        <div class="row margin-top-10">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->has('email'))
                <div class="alert alert-danger">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 ">
                <div class="well no-padding">
                    <form action="{{ route('password.email') }}" method="POST" class="smart-form client-form">
                        <header>
                            Contraseña olvidada
                        </header>

                        <fieldset>
                            <div class="col-md-12" style="margin-bottom: 20px">
                                <div class="text-center" >
                                    <img class="img-responsive" src="{{URL::to('img/logos/logo.png')}}" style="" alt="ESFOREM 1.0">
                                </div>
                            </div>

                            <section>
                                <label class="label">Introduce tu correo electrónico</label>
                                <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                    <input type="email" name="email">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-envelope txt-color-teal"></i>Introduce tu correo electrónico para restaurar la contraseña</b></label>
                                <div class="note">
                                    <a href="{{URL::to('/')}}">¡He recordado mi contraseña!</a>
                                </div>
                            </section>
                        </fieldset>
                        <footer>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-refresh"></i> Restaurar contraseña
                            </button>
                        </footer>
                        {{csrf_field()}}
                    </form>

                </div>



            </div>
        </div>
    </div>

</div>

<!--================================================== -->

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script> if (!window.jQuery) { document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');} </script>

<!--<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script> if (!window.jQuery.ui) { document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');} </script>-->

<!-- IMPORTANT: APP CONFIG -->

<script src="{{ URL::asset('js/app.config.seed.js') }}"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events
<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

<!-- BOOTSTRAP JS -->

<script src="{{ URL::asset('js/bootstrap/bootstrap.min.js') }}"></script>

<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->

<!-- MAIN APP JS FILE -->

<script src="{{ URL::asset('js/app.seed.js') }}"></script>

</body>
</html>