<!--Tabla dentro de widget-->
@include('global.widget-list',[
    'id'=>'oClientTable',
    'title'=>Lang::get('Listado de Clientes'),
    'striped'=>false,
    'icon'=>'fa fa-table',
    'toolbar'=>true,
    'toolbar_content'=>view('site.client.filter'),
    'buttons'=>'
         <div class="col-xs-12 m-b-10">
             <a id="btn-new-client"
                href="'.route('admin.client.create').'"
                data-title="Nuevo Cliente"
                data-ico="fa fa-plus"
                class="url_imodal btn btn-success btn-sm pull-right" data-title="add">
                <i class="fa fa-plus"></i> '.__('global.new').'
             </a>
         </div>
    ',
   'columns'=>[
       ['ID','','expand'],
       ['Nombre','',''],
       ['Dirección','phone',''],
       ['Código postal','phone',''],
       ['Municipio','phone',''],
       ['Provincia','phone',''],
       ['Código fiscal','phone',''],
       ['Phone','phone',''],
       ['Email','phone',''],
       ['global.actions','phone,tablet','']
     ],
    'tfoot'=>false,
])