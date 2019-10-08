function cancelAlert(title, content) {
    $.smallBox({
        title: title,
        content: content,
        color: config_notifications['info']['color'],
        timeout: 5000,
        icon: config_notifications['info']['icon']
    })
}

function successAlert(title, content) {
    $.smallBox({
        title: title,
        content: content,
        color: config_notifications['success']['color'],
        timeout: config_notifications['success']['timeout'],
        icon: config_notifications['success']['icon']
    })
}

function errorAlert(title, content) {


    $.smallBox({
        title: title,
        content: content,
        color: config_notifications['error']['color'],
        timeout: 5000,
        icon: config_notifications['error']['icon']
    })
}


<!-- Function to print Notifications -->
function showNotifications(big_notifications,small_notifications,form_errors){

    console.log(big_notifications);
    console.log(small_notifications);
    console.log(form_errors);
    if(form_errors){
        $.smallBox({
            title : config_notifications['error']['title'],
            content : config_notifications['form_error_message'],
            color : config_notifications['error']['color'],
            timeout: config_notifications['error']['timeout'],
            icon : config_notifications['error']['icon']
            //number : "3"
        });
    }

    jQuery.each( big_notifications, function( i, types ) {
        jQuery.each( types, function( j, notification ) {
            $.bigBox({
                title : config_notifications[i]['title'],
                content : notification,
                color : config_notifications[i]['color'],
                timeout: config_notifications[i]['timeout'],
                icon : config_notifications[i]['icon']
                //number : "3"
            });
        });
    });

    jQuery.each( small_notifications, function( i, types ) {
        jQuery.each( types, function( j, notification ) {
            $.smallBox({
                title : config_notifications[i]['title'],
                content : notification,
                color : config_notifications[i]['color'],
                timeout: config_notifications[i]['timeout'],
                icon : config_notifications[i]['icon']
                //number : "3"
            });
        });
    });
}