jQuery.validator.setDefaults({
    debug:false,
    errorClass: "has-error",
    validClass: "has-success",
    errorElement: "span",
    ignore: ":hidden",
    success: function ( label ) {
        console.log("SUCCESS");
        var form_group = label.closest( ".form-group" );
        form_group.removeClass( 'has-error' ).addClass( 'has-success' );

    },
    errorPlacement: function ( error, element ) {
        console.log("ERROR");
        var form_group = element.closest( ".form-group");
        console.log(form_group);
        form_group.removeClass( 'has-success' ).addClass( 'has-error' );
        form_group.removeClass( 'has-success' ).addClass( 'has-error' );
        var errorSpan= form_group.find('.help-block');
        errorSpan.html(error);

    },
    highlight: function ( element, errorClass, validClass ) {
       var form_group = element.closest( ".form-group");
       form_group.classList.add(errorClass);
       form_group.classList.remove(validClass);
    },
    unhighlight: function (element, errorClass, validClass) {
        var form_group = element.closest( ".form-group");
        form_group.classList.add(validClass);
        form_group.classList.remove(errorClass);
    }

});
