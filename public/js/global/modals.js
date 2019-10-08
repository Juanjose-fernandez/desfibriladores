
var defaultoptions = {
    //width:800,                                      //Ancho de modal puede usarse %, px,em, sin nada son px.
    headerColor:"#1b1e24",                          //Color de la cabecera
    title:"",                                       //Titulo de la cabecera
    subtitle:"",                                   //Subtitulo de la cabecera
    icon:'fa fa-table',                              //Icono de la cabecera
    iconText:'',                                //Texto al icono de la cabecera
    iconColor:"white",                              //Color del icono y texto de icono
    appenTo:'',                                     //Donde se colocara el modal
    appenToOverlay:'',                              //Donde se colocara la superposición del modal, la capa externa al modal
    rtl: false,                                     //Opción de derecha a izquierda el header
    borderBottom:true,                              //Aplica borde al modal
    padding:0,                                      //Padding del contenido respecto al borde del modal
    radius:3,                                       //Border-radios que se le aplicara al modal
    zindex: 999,                                    //Altura del modal
    iframe: false,                                  //Si se coloca esta Opción en true se creara el modal con un iframe que contendra todo el contenido.
    iframeHeight: 400,                              //Altura fija del iframe interno del modal.
    iframeUrl: '',                                  //Url del iframe.
    group:'group-im',                               //Si colocas varios modales con el mismo nombre de grupo se puede navegar entre ellos.
    loop: false,                                    //Permite el ciclo con madales del mismo grupo.
    arrowKeys: false,                                //Permite navegar con las flechas entre modales del mismo grupo
    navigateCaption: true,                          //Muestra flechas de navegación.
    fullscreen:true,                                //Icono de pantalla completa.
    openFullscreen:false,                           //Abre el modal a pantalla completa
    closeOnEscape:true,                             //Se cierra el modal pulsando esc.
    closeButton: true,                              //Muestra un botón de cerrar la ventana en el header.
    overlay:true,                                   //Activa o desactiva el cubrir el fondo cuando sale el modal.
    overlayClose: true,                             //El modal se cierra si se hace clic fuera del modal
    overlayColor: 'rgba(0,0,0,0.4)',                //Color de la capa de sombreado cuando se invoca el modal
    timeout:0,                                      //Cantidad de tiempo en milisegundos que estará el modal visible. 0 ilimitado
    timeoutProgressbar: true,                       //Muestra una barra indicando el tiempo.
    timeoutProgressbarColor:'rgba(255,255,255,0.5)',//Color de la barra de progreso del tiempo
    pauseOnHover: true,                             //Pausa el progreso del tiempo si el cursor está dentro del modal.
    transitionIn: 'comingIn',                       //Transición de entrada del modal: comingIn, bounceInDown, bounceInUp, fadeInDown, fadeInUp, fadeInLeft, fadeInRight, flipInX.
    transitionOut: 'bounceOutDown',                 //Transición de salida del modal:comingOut, bounceOutDown, bounceOutUp, fadeOutDown, fadeOutUp, , fadeOutLeft, fadeOutRight, flipOutX.
    transitionInOverlay:'fadeIn',                   //Transición de overlay al abrirse.
    transitionOutOverlay:'fadeOut'                  //Transición de overlay al cerrarse.
};

var imodal= $('#modal').iziModal(
    defaultoptions
);

$(document).on('click', '.url_imodal', function (event) {

    $('#modal').iziModal('resetContent');
    var values_modal=null;
    event.preventDefault();
    if ($(this).attr('data-request')){
        data_reform = $(this).attr('data-request').replace(/'/g,"\"");
        $.ajax({
            url: $(this).attr('href'),
            data:{
                data:data_reform,
            },
            success: function (data) {
                $("#modal .iziModal-content").html(data);
            }
        });
    }else{
        $.get($(this).attr('href'), function(data) {
            $("#modal .iziModal-content").html(data);
        })
            .error(function(){
                $('#modal').iziModal('close');
            })
        ;

    }

    if ($(this).attr('data-title')){
        imodal.iziModal('setTitle', $(this).attr('data-title'));
    }
    if ($(this).attr('data-subtitle')){
        imodal.iziModal('setSubtitle', $(this).attr('data-subtitle'));
    }
    if ($(this).attr('data-ico')){
        imodal.iziModal('setIcon', $(this).attr('data-ico'));
    }
    if ($(this).attr('data-width-expresion') == '%'){
        if ($(this).attr('data-width')){
            imodal.iziModal('setWidth', $(this).attr('data-width')+"%");
        }
    }else{
        if ($(this).attr('data-width')){
            imodal.iziModal('setWidth', $(this).attr('data-width')+"px");
        }
    }
    imodal.iziModal('open');
});




var defaultoptions2 = {
    //width:800,                                      //Ancho de modal puede usarse %, px,em, sin nada son px.
    headerColor:"#1b1e24",                          //Color de la cabecera
    title:"",                                       //Titulo de la cabecera
    subtitle:"",                                   //Subtitulo de la cabecera
    icon:'fa fa-table',                              //Icono de la cabecera
    iconText:'',                                //Texto al icono de la cabecera
    iconColor:"white",                              //Color del icono y texto de icono
    appenTo:'',                                     //Donde se colocara el modal
    appenToOverlay:'',                              //Donde se colocara la superposición del modal, la capa externa al modal
    rtl: false,                                     //Opción de derecha a izquierda el header
    borderBottom:true,                              //Aplica borde al modal
    padding:0,                                      //Padding del contenido respecto al borde del modal
    radius:3,                                       //Border-radios que se le aplicara al modal
    zindex: 999,                                    //Altura del modal
    iframe: false,                                  //Si se coloca esta Opción en true se creara el modal con un iframe que contendra todo el contenido.
    iframeHeight: 400,                              //Altura fija del iframe interno del modal.
    iframeUrl: '',                                  //Url del iframe.
    group:'group-im-two',                               //Si colocas varios modales con el mismo nombre de grupo se puede navegar entre ellos.
    loop: false,                                    //Permite el ciclo con madales del mismo grupo.
    arrowKeys: true,                                //Permite navegar con las flechas entre modales del mismo grupo
    navigateCaption: true,                          //Muestra flechas de navegación.
    fullscreen:true,                                //Icono de pantalla completa.
    openFullscreen:false,                           //Abre el modal a pantalla completa
    closeOnEscape:true,                             //Se cierra el modal pulsando esc.
    closeButton: true,                              //Muestra un botón de cerrar la ventana en el header.
    overlay:true,                                   //Activa o desactiva el cubrir el fondo cuando sale el modal.
    overlayClose: true,                             //El modal se cierra si se hace clic fuera del modal
    overlayColor: 'rgba(0,0,0,0.4)',                //Color de la capa de sombreado cuando se invoca el modal
    timeout:0,                                      //Cantidad de tiempo en milisegundos que estará el modal visible. 0 ilimitado
    timeoutProgressbar: true,                       //Muestra una barra indicando el tiempo.
    timeoutProgressbarColor:'rgba(255,255,255,0.5)',//Color de la barra de progreso del tiempo
    pauseOnHover: true,                             //Pausa el progreso del tiempo si el cursor está dentro del modal.
    transitionIn: 'comingIn',                       //Transición de entrada del modal: comingIn, bounceInDown, bounceInUp, fadeInDown, fadeInUp, fadeInLeft, fadeInRight, flipInX.
    transitionOut: 'bounceOutDown',                 //Transición de salida del modal:comingOut, bounceOutDown, bounceOutUp, fadeOutDown, fadeOutUp, , fadeOutLeft, fadeOutRight, flipOutX.
    transitionInOverlay:'fadeIn',                   //Transición de overlay al abrirse.
    transitionOutOverlay:'fadeOut'                  //Transición de overlay al cerrarse.
};



$(document).on('click', '.url_imodal2', function (event) {
    var imodal2= $('#modal_2').iziModal(
        defaultoptions2
    );

    $('#modal_2').iziModal('resetContent');
    var values_modal=null;
    event.preventDefault();
    if ($(this).attr('data-request')){
        data_reform = $(this).attr('data-request').replace(/'/g,"\"");
        $.ajax({
            url: $(this).attr('href'),
            data:{
                data:data_reform,
            },
            success: function (data) {
                $("#modal_2 .iziModal-content").html(data);
            }
        });
    }else{
        $.get($(this).attr('href'), function(data) {
            $("#modal_2 .iziModal-content").html(data);
        });
    }

    if ($(this).attr('data-title')){
        imodal2.iziModal('setTitle', $(this).attr('data-title'));
    }
    if ($(this).attr('data-subtitle')){
        imodal2.iziModal('setSubtitle', $(this).attr('data-subtitle'));
    }
    if ($(this).attr('data-ico')){
        imodal2.iziModal('setIcon', $(this).attr('data-ico'));
    }
    if ($(this).attr('data-width-expresion') == '%'){
        if ($(this).attr('data-width')){
            imodal2.iziModal('setWidth', $(this).attr('data-width')+"%");
        }
    }else{
        if ($(this).attr('data-width')){
            imodal2.iziModal('setWidth', $(this).attr('data-width')+"px");
        }
    }
    imodal2.iziModal('open');
});


