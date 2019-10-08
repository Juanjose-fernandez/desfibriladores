<!DOCTYPE html>
<html class="smart-style-1" lang="es-ES">
<head>
    <meta charset="utf-8">
    <title> SOS Music </title>
    <meta name="description" content="SOS Music">
    <meta name="author" content="10Code - Software Desing S.L.">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- #CSS Links -->
    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('css/font-awesome.min.css')}}">

    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('css/smartadmin-production-plugins.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('css/smartadmin-production.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('css/smartadmin-skins.min.css')}}">

    <!-- Select Picker -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('js/plugin/bootstrap-select/bootstrap-select.min.css')}}">

    <!-- Custom css -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('css/custom.css')}}">

    <!-- #FAVICONS -->
   <link rel="shortcut icon" href="{{URL::to('img/favicon/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{URL::to('img/favicon/favicon.ico')}}" type="image/x-icon">

    <!-- #GOOGLE FONT -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    <!-- #APP SCREEN / ICONS -->
    <!-- Specifying a Webpage Icon for Web Clip
         Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
    <link rel="apple-touch-icon" href="{{URL::to('img/splash/sptouch-icon-iphone.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{URL::to('img/splash/touch-icon-ipad.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{URL::to('img/splash/touch-icon-iphone-retina.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{URL::to('img/splash/touch-icon-ipad-retina.png')}}">

    <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Startup image for web apps -->
    <link rel="apple-touch-startup-image" href="{{URL::to('img/splash/ipad-landscape.png')}}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="{{URL::to('img/splash/ipad-portrait.png')}}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="{{URL::to('img/splash/iphone.png')}}" media="screen and (max-device-width: 320px)">


    <!-- iziModal -->
    <link href="{{URL::to('js/plugin/iziModal_1_6/css/iziModal.min.css')}}" rel="stylesheet">


    <!-- Otras hojas de estilo y hojas de estilos personalizadas -->
    @yield('styles')


</head>

<!--

TABLE OF CONTENTS.

Use search to find needed section.

===================================================================

|  01. #CSS Links                |  all CSS links and file paths  |
|  02. #FAVICONS                 |  Favicon links and file paths  |
|  03. #GOOGLE FONT              |  Google font link              |
|  04. #APP SCREEN / ICONS       |  app icons, screen backdrops   |
|  05. #BODY                     |  body tag                      |
|  06. #HEADER                   |  header tag                    |
|  07. #PROJECTS                 |  project lists                 |
|  08. #TOGGLE LAYOUT BUTTONS    |  layout buttons and actions    |
|  09. #MOBILE                   |  mobile view dropdown          |
|  10. #SEARCH                   |  search field                  |
|  11. #NAVIGATION               |  left panel & navigation       |
|  12. #MAIN PANEL               |  main panel                    |
|  13. #MAIN CONTENT             |  content holder                |
|  14. #PAGE FOOTER              |  page footer                   |
|  15. #SHORTCUT AREA            |  dropdown shortcuts area       |
|  16. #PLUGINS                  |  all scripts and plugins       |

===================================================================

-->

<!-- #BODY -->
<!-- Possible Classes

    * 'smart-style-{SKIN#}'
    * 'smart-rtl'         - Switch theme mode to RTL
    * 'menu-on-top'       - Switch to top navigation (no DOM change required)
    * 'no-menu'			  - Hides the menu completely
    * 'hidden-menu'       - Hides the main menu but still accessable by hovering over left edge
    * 'fixed-header'      - Fixes the header
    * 'fixed-navigation'  - Fixes the main menu
    * 'fixed-ribbon'      - Fixes breadcrumb
    * 'fixed-page-footer' - Fixes footer
    * 'container'         - boxed layout mode (non-responsive: will not work with fixed-navigation & fixed-ribbon)
-->
<body class="smart-style-1 fixed-header fixed-navigation " >

<!-- #HEADER -->
@include('layouts.default-header2')
<!-- END HEADER -->

<!-- #MAIN PANEL -->
<div id="main" role="main" style="margin-left:0px !important">
    <div id="loader" class="loader" style="display: none;">
        <div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>


    <!-- col -->
    <div id="content"  style="height: -webkit-fill-available;">
        @yield('content')
    </div>
    <!-- end col -->

    <!-- MODAL -->
    <div id="modal">
        <!--Contenido-->
    </div>
    <!-- END MODAL -->


    <!-- end row -->

    <!-- END #MAIN CONTENT -->

</div>
<!-- END #MAIN PANEL -->

<!-- #PAGE FOOTER -->
@include('layouts.default-footer')
<!-- END FOOTER -->

<!-- #SHORTCUT AREA : With large tiles (activated via clicking user name tag)
     Note: These tiles are completely responsive, you can add as many as you like -->
<!-- END SHORTCUT AREA -->

<!--================================================== -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)
<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>-->


<!-- #PLUGINS -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }' src="{{URL::to('js/plugin/pace/pace.min.js')}}"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="{{URL::to('js/libs/jquery-2.1.1.min.js')}}"><\/script>');
    }
</script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="{{URL::to('js/libs/jquery-ui-1.10.3.min.js')}}"><\/script>');
    }
    var sound_path_default="{{URL::to('/sound/')}}"+"/";//route for notifications sounds
</script>

<!-- IMPORTANT: APP CONFIG -->
<script src="{{URL::to('js/app.config.js')}}"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="{{URL::to('js/plugin/jquery-touch/jquery.ui.touch-punch.min.js')}}"></script>

<!-- BOOTSTRAP JS -->
<script src="{{URL::to('js/bootstrap/bootstrap.min.js')}}"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="{{URL::to('js/notification/SmartNotification.min.js')}}"></script>



<!-- JARVIS WIDGETS -->
<script src="{{URL::to('js/smartwidgets/jarvis.widget.min.js')}}"></script>

<!-- SPARKLINES -->
<script src="{{URL::to('js/plugin/sparkline/jquery.sparkline.min.js')}}"></script>

<!-- JQUERY VALIDATE -->
<script src="{{URL::to('js/plugin/jquery-validate/jquery.validate.min.js')}}"></script>
<script src="{{URL::to('js/plugin/jquery-validate/additional-methods.min.js')}}"></script>
<script src="{{URL::to('js/plugin/jquery-validate/localization/messages_es.min.js')}}"></script>

<!-- JQUERY MASKED INPUT -->
<script src="{{URL::to('js/plugin/masked-input/jquery.maskedinput.min.js')}}"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="{{URL::to('js/plugin/select2/select2.min.js')}}"></script>

<!-- SELECT PICKER -->
<script src="{{URL::to('js/plugin/bootstrap-select/bootstrap-select.min.js')}}"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="{{URL::to('js/plugin/bootstrap-slider/bootstrap-slider.min.js')}}"></script>

<!-- browser msie issue fix -->
<script src="{{URL::to('js/plugin/msie-fix/jquery.mb.browser.min.js')}}"></script>

<!-- FastClick: For mobile devices -->
<script src="{{URL::to('js/plugin/fastclick/fastclick.min.js')}}"></script>

<!-- SmartChat UI : plugin -->
<script src="{{URL::to('js/smart-chat-ui/smart.chat.ui.min.js')}}"></script>
<script src="{{URL::to('js/smart-chat-ui/smart.chat.manager.min.js')}}"></script>

<!-- DATATABLES -->
<script src="{{URL::to('js/plugin/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::to('js/plugin/datatables/dataTables.colVis.min.js')}}"></script>
<script src="{{URL::to('js/plugin/datatables/dataTables.tableTools.min.js')}}"></script>
<script src="{{URL::to('js/plugin/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{URL::to('js/plugin/datatable-responsive/datatables.responsive.min.js')}}"></script>

<!-- NOTIFICACIONES PUSH ONESIGNAL-->
<script src="{{URL::to('js/push-notification/custom-onesignal-push.js')}}"></script>

<!--[if IE 8]>
<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
<![endif]-->

<!-- MAIN APP JS FILE -->
<script src="{{URL::to('js/app.min.js')}}"></script>


<!--IziModal-->
<script src="{{URL::to('js/plugin/iziModal_1_6/js/iziModal.min.js')}}"></script>
<!-- IZI MODAL CONFIG -->
<script src="{{URL::to('js/global/modals.js')}}"></script>

<!-- Sweetaleert css -->
<link rel="stylesheet" type="text/css" media="screen" href="{{URL::asset('js/plugin/sweetalert2/sweetalert2.min.css')}}">



<!-- Notifications Configuration -->
<script type="text/javascript">

    var config_notifications=[];
    config_notifications['warning']=[];
    config_notifications['warning']['color']="#C79121";
    config_notifications['warning']['title']="{{Lang::get('global.warning')}}";
    config_notifications['warning']['icon']="fa fa-warning shake animated";
    config_notifications['warning']['timeout']=null;

    config_notifications['error']=[];
    config_notifications['error']['color']="#C46A69";
    config_notifications['error']['title']="{{Lang::get('global.error')}}";
    config_notifications['error']['icon']="fa fa-ban shake animated";
    config_notifications['error']['timeout']=null;

    config_notifications['info']=[];
    config_notifications['info']['color']="#3276B1";
    config_notifications['info']['title']="{{Lang::get('global.info')}}";
    config_notifications['info']['icon']="fa fa-bell swing animated";
    config_notifications['info']['timeout']=null;

    config_notifications['success']=[];
    config_notifications['success']['color']="#739E73";
    config_notifications['success']['title']="{{Lang::get('global.success')}}";
    config_notifications['success']['icon']="fa fa-check swing animated";
    config_notifications['success']['timeout']=5000;
    config_notifications['form_error_message']='Revise los campos del formulario';

</script>

<!-- Your GOOGLE ANALYTICS CODE Below -->
<script type="text/javascript">



    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet : 1024,
        phone : 480
    };

    <!-- LOAD -->
    $(window).load(function(){

        var urlSetPushIdAuthUser = "{{URL::to('push/user/set-id')}}";
        var token = "{{csrf_token()}}";

        pageSetUp();
        var big_notifications = JSON.parse('{!! json_encode(session("smart_notifications_big")) !!}');
        if(!big_notifications){
            big_notifications="";
        }

        var small_notifications = JSON.parse('{!! json_encode(session("smart_notifications_small")) !!}');
        if(!small_notifications){
            small_notifications="";
        }

        var form_errors=false;
        @if (count($errors->all()) > 0)
        form_errors=true;
        @endif
        showNotifications(big_notifications,small_notifications,form_errors);

        // Cada vez que se accede a una página se comprueba si aceptó las notificaciones.
        checkAndSetPlayerId(urlSetPushIdAuthUser, token);

    });


</script>

<!-- JQUERY Validator Config-->
<script src="{{URL::to('js/global/validator-config.js')}}"></script>
<!-- Alert  -->
<script src="{{URL::to('js/global/alerts.js')}}"></script>
<!-- SweetAlert -->
<script src="{{URL::asset('/js/plugin/sweetalert2/sweetalert2.min.js')}}"></script>


<!--AJAX CONFIG-->
<script>
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});

//Mensaje de error Default para todas las llamadas
$( document ).ajaxError(function() {
    errorAlert("{{Lang::get('error.ajax-title')}}", "{{Lang::get('error.ajax-content')}}");
});




/* La respuesta del servidor tiene que tener este formato

 Error de validación
 if ($validator->fails()) {

 return response([
 'status'  => 'validation-error',
 'data_failed'  => $validator->messages(),
 'title'   => Lang::get('global.default-form-validation-error-title'),
 'message' => Lang::get('global.default-form-validation-error-msg'),
 ]);
 }



 Excepción
 return response()->json([
 'title' => __('global.default-error-title'),
 'message' => __('global.default-error-msg'),
 'debug'=>$e,
 'status' => 'failed'
 ],404);

 Correcto
 return response(['
 title' => __('global.default-success-title'),
 'message' => __('global.default-success-msg'),
 'status' => 'success']);

 */


//Pinta errores de validator de laravel

function showValidationErrors(oResponse){

    console.log('call to showErrorsIfExist');
    console.log(oResponse);

    //Hay errores debemos pintarlos
    $.each(oResponse.data_failed, function(input_id,error){
        console.log("ERROR");
        console.log('element: '+input_id);
        console.log('error: '+error);
        var form_group = $('#'+input_id).closest( ".form-group");
        form_group.removeClass( 'has-success' ).addClass( 'has-error' );
        form_group.removeClass( 'has-success' ).addClass( 'has-error' );
        form_group.find('label').addClass('text-danger');
        form_group.find('input').addClass('border-danger');
        var errorSpan= form_group.find('.help-block');
        errorSpan.html(error);
        errorSpan.show();
    });
    //notificamos que revisen los campos
    errorAlert(oResponse.title, oResponse.message);

};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});

$( document ).ajaxStart(function() {
    $( "#loader" ).show();
});
$( document ).ajaxStop(function() {
    $( "#loader" ).hide();
});
$( document ).ajaxError(function() {
    $( "#loader" ).hide();
});


//Mensaje de error Default para todas las llamadas
$( document ).ajaxError(function(event, oResponse, settings, thrownError) {

    @if(config('app.debug') == true)
        console.log('Error en petición ajax');
        console.log('Respuesta:');
        console.log(oResponse);
        console.log('Respuesta del servidor');
        console.log(serverResponse);
    @endif

    //Recogemos respuesta del servidor
    var serverResponse = oResponse.responseJSON ? oResponse.responseJSON : null;

    //Si el código del servidor es 422 hubo error de validación
    if(oResponse.status == 422){
        //Pintamos errores de validación
        var validationErrors = showValidationErrors(serverResponse);
    }else if(oResponse.status == 404 ){
        //Pintamos excepción
        @if(config('app.debug') == true)
            errorAlert(serverResponse.title,serverResponse.message);
        @endif
    }

});


//Mensaje de success Default para todas las llamadas
$( document ).ajaxSuccess(function(event, oResponse, settings, thrownError) {

    //comprobamos que haya respuesta montada en el servidor
    var serverResponse = oResponse.responseJSON ? oResponse.responseJSON : null;

    @if(config('app.debug') == true)
    console.log('Success en petición ajax');
    console.log('Respuesta:');
    console.log(oResponse);
    console.log('Respuesta del servidor');
    console.log(serverResponse);
    @endif

    //Lanzamos notificación de confirmación
    serverResponse && serverResponse.title  ? successAlert(serverResponse.title,serverResponse.message) : null;

});


</script>


<!--Seet alert for delete-->
<script>

    /*Ejemplo respuesta servidor
     return response(['title' => Lang::get('global.success'), 'message' => Lang::get('Paciente eliminado correctamente'), 'status' => 'success']);
     */

    function sweetDelete(url, title, content, oTable = null) {

        swal({
            title: title,
            text: content,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value)
        {
            $.ajax({
                method: 'post',
                url: url,
                data: {
                    _token: "{{csrf_token()}}"
                },
                success: function (response) {
                    oTable ? oTable.draw() : null ;

                },
                error: function (response) {
                    errorAlert("No se pudo eliminar", 'No fué posible la eliminación  el registro.');
                }
            })
        }else{
            cancelAlert("{{Lang::get('global.canceled')}}", "{{Lang::get('global.canceled.message.confirmation')}}");
        }

    })


    }


</script>


<!--Delay function-->
<script>
    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();
</script>




@yield('scripts')
</body>

</html>