<!DOCTYPE html>
<html lang="en-us" id="extr-page">
<head>
    <meta charset="utf-8">
    <title> Cocnesur 1.0</title>
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

    <link rel="shortcut icon" href="{{ URL::asset('img/favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ URL::asset('img/favicon/favicon.ico') }}" type="image/x-icon">

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

<header id="header">

    <div id="logo-group">
        <span id="logo"> <img src="{{URL::to('img/mother-dark.png')}}" style="max-height: 30px" alt="Mother 1.0"> </span>
    </div>

    <span id="extr-page-header-space"> <span class="hidden-mobile hidden-xs">¿Necesita una cuenta?</span> <a href="{{URL::to('register')}}" class="btn btn-info disabled">Solicitar cuenta</a> </span>

</header>

<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">

        <div class="row margin-top-10">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 ">
                <div class="well no-padding">
                    <form id="register_user_form" action="{{ URL::to('register') }}" method="POST" class="smart-form client-form">
                        {{ csrf_field() }}
                        <header>
                            Registrar usuario
                        </header>

                        <fieldset>
                            <section>
                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label class="control-label">Nombre de usuario</label>

                                    <label class="input">
                                        <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="username" value="{{old('username')}}">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i>Introduce tu nombre de usuario</b>
                                    </label>

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </section>

                            <section>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="control-label">Nombre</label>

                                    <label class="input">
                                        <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="name" value="{{old('name')}}">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i>Introduce tu nombre</b>
                                    </label>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </section>

                            <section>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="control-label">Correo electrónico</label>

                                    <label class="input">
                                        <i class="icon-append fa fa-envelope"></i>
                                        <input type="email" name="email" value="{{old('email')}}">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-envelope txt-color-teal"></i>Introduce tu correo electrónico</b>
                                    </label>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </section>

                            <section>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class=control-label">Contraseña</label>

                                    <label class="input">
                                        <i class="icon-append fa fa-lock"></i>
                                        <input id="password" type="password" class="form-control" name="password" value="{{old('password')}}">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i>Introduce la nueva contraseña</b>

                                    </label>


                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </section>

                            <section>
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password-confirm" class="control-label">Confirmar contraseña</label>

                                    <label class="input">
                                        <i class="icon-append fa fa-lock"></i>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i>Repite la nueva contraseña</b>
                                    </label>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                    @endif

                                </div>
                            </section>
                        </fieldset>
                        <footer>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </footer>
                    </form>

                </div>

                <h5 class="text-center"> - Or sign in using -</h5>

                <ul class="list-inline text-center">
                    <li>
                        <a href="{{URL::to('auth/facebook')}}" class="btn btn-primary btn-circle"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="{{URL::to('auth/google')}}" class="btn btn-danger btn-circle"><i class="fa fa-google"></i></a>
                    </li>
                    <li>
                        <a href="{{URL::to('auth/twitter')}}" class="btn btn-info btn-circle"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="btn btn-warning btn-circle"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>

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

<!-- JQUERY VALIDATE -->
<script src="{{URL::to('js/plugin/jquery-validate/jquery.validate.min.js')}}"></script>
<script src="{{URL::to('js/plugin/jquery-validate/additional-methods.min.js')}}"></script>
<script src="{{URL::to('js/plugin/jquery-validate/localization/messages_es.min.js')}}"></script>

<script type="text/javascript">

    $(document).ready(function() {

//        $('#register_user_form').validate({
//            lang: 'ES',
//            rules: {
//                username: 'required',
//                name: 'required',
//                email: {
//                    required: true,
//                    email: true
//                },
//                password: 'required',
//                password_confirmation: {
//                    required: true,
//                    equalTo: '#password'
//                }
//            }
//        });

    });

</script>

</body>
</html>