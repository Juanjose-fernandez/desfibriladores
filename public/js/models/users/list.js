
function loadUserDatatable(){
    if(oUsersTable !=null){
        oUsersTable.draw();
    }else {

        oUsersTable = $('#users_table').DataTable({
            "serverSide": true,
            responsive: true,
            "sDom": "<'dt-toolbar'<'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "ajax": {
                url: urlUsersData,
                cache: false,
                data: function (d) {
                    d.f_username = $('#f_username').val();
                    d.f_name = $('#f_name').val();
                    d.f_surname = $('#f_surname').val();
                    d.f_email = $('#f_email').val();
                    d.f_role_id = $('#f_role_id').val();
                    d.f_active = $('#f_active').val();
                }
            },
            "oLanguage": {
                "sUrl": urlDatatables
            },
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!this.responsiveHelper_dt_basic) {
                    this.responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#users_table'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                this.responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                this.responsiveHelper_dt_basic.respond();


            },
            "columns": [
                {data: "username", name: "username"},
                {data: "name", name: "name"},
                {data: "surname", name: "surname"},
                {data: "email", name: "email"},
                {data: "role", name: "role"},
                {data: "active", name: "active"},
                {data: "actions", name: "actions"}
            ]
        });
    }

}


//Filtros
$("#f_username,#f_name,#f_surname,#f_email").keyup(function () {
    delay(function () {
        oUsersTable.draw();
    }, 100);

});

$('#f_active,#f_role_id').change(function () {
    oUsersTable.draw();
});
