/**
 * Created by 10Code-portatil-3 on 07/04/2018.
 */

/* Comprueba si el dispositivo tiene un id asignado (usuario aceptó las notificaciones) y si lo tiene envía llamada ajax
para intentar asignárselo al usuario conectado si estuviese logueado.
 */
function checkAndSetPlayerId(url, token) {
    OneSignal.push(function() {
        /* Si no tiene id devuelve null */
        OneSignal.getUserId(function(userId) {
            //console.log("OneSignal User ID:", userId);
            // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316

            if(userId != null){

                var data = new FormData();
                data.append('_token', token);
                data.append('push_id', userId);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (result) {
                        console.log(result);
                    }
                });
            }
        });
    });
}