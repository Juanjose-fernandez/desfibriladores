

<!--Tabla dentro de widget-->
@include('global.widget-list',[
    'id'=>'users_table',
    'title'=>Lang::get('Listado de Usuarios'),
    'striped'=>false,
    'icon'=>'fa fa-table',
    'toolbar'=>true,
    'toolbar_content'=>view('site.users.filter',['roles'=>$roles]),
    'buttons'=>'
         <div class="col-xs-12 m-b-10">
             <a id="btn-new-user"
                href="'.route('admin.user.create').'"
                data-title="Nuevo Usuario"
                data-ico="fa fa-plus"
                class="url_imodal btn btn-success btn-sm pull-right" data-title="add">
                <i class="fa fa-plus"></i> '.__('global.new').'
             </a>
         </div>
    ',
   'columns'=>[
       ['Usuario','','expand'],
       ['Nombre','phone',''],
       ['Apellidos','phone',''],
       ['Email','phone',''],
       ['Rol','phone',''],
       ['Activo','phone,tablet',''],
       ['global.actions','phone,tablet','']
     ],
    'tfoot'=>false,
])