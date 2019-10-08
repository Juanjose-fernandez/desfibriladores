<?php
return [

    'key'=> env('REDSYS_KEY','sq7HjrUOBfKmC576ILgskD5srU870gJ7'),
    'url_ok'=> env('REDSYS_URL_OK','http://localhost:8888/mother/public/redsys/finish-payment'),
    'url_ko'=> env('REDSYS_URL_KO','http://localhost:8888/mother/public/redsys/finish-payment'),
    'url_merchant'=> env('REDSYS_MERCHANT_URL','https://sis-t.redsys.es:25443/sis/realizarPago'),
    'merchantcode'=> env('REDSYS_MERCHANT_CODE','344783311'),//hecacode.1010!
    'terminal'=> env('REDSYS_TERMINAL','001'),
    'enviroment'=> env('REDSYS_ENVIROMENT','test'),
    'url_notification'=> env('REDSYS_URL_NOTIFICATION','http://92.59.127.189:8888/mother/public/redsys/notification'),
    'tradename'=> env('REDSYS_TRADENAME','Mother'),
    'titular'=> env('REDSYS_TITULAR','Mother'),
    'description'=> env('REDSYS_DESCRIPTION','Mother payment')
];
