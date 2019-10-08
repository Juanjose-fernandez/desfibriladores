
function loadClientDatatable(){
    if(oClientTable !=null){
        oClientTable.draw();
    }else {

        oClientTable = $('#oClientTable').DataTable( {
            rowId: 'id',
            "lengthChange": false,
            "bFilter":false,
            responsive: true,
            "processing": true,
            "serverSide": true,
            "ajax":{
                url:urlClientDataTable,
                data: function (d) {
                    d.filter_id =$('#filter_id').val();
                    d.filter_business_name = $('#filter_business_name').val();
                    d.filter_address = $('#filter_address').val();
                    d.filter_postcode=$('#filter_postcode').val();
                    d.filter_municipality=$('#filter_municipality').val();
                    d.filter_province=$('#filter_province').val();
                    d.filter_fiscal_code=$('#filter_fiscal_code').val();
                    d.filter_phone=$('#filter_phone').val();
                    d.filter_email=$('#filter_email').val();
                    d.filter_created_at=$('#filter_created_at').val();
                    d.filter_updated_at=$('#filter_updated_at').val();
                }
            } ,
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!this.responsiveHelper_dt_basic) {
                    this.responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#oClientTable'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                this.responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                this.responsiveHelper_dt_basic.respond();


            },
            "oLanguage": {
                "sUrl": sUrl
            },
            "columns": [
                {data:"id", name:"id"},
                {data:"business_name", name:"business_name"},
                {data:"address", name:"address"},
                {data:"postcode", name:"postcode"},
                {data:"municipality", name:"municipality"},
                {data:"province", name:"province"},
                {data:"fiscal_code", name:"fiscal_code"},
                {data:"phone", name:"phone"},
                {data:"email", name:"email"},
                {data:"actions", name:"actions"}
            ]
        });

    }

}



//Filtros
$('#filter_id, #filter_business_name,#filter_address,#filter_municipality,#filter_province,#filter_postcode, #filter_email').keyup(function () {

    delay(function () {
        oClientTable.draw();
    },500);
});

$("#oClientTable tbody").on("click", ".btn-delete", function () {
    sweetDelete($(this).data('href'), '¿Está seguro?', 'Va a proceder a eliminar el registro',  oClientTable);
});
