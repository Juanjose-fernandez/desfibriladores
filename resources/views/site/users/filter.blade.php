
<form id="user-filter-form" class="" novalidate="novalidate">

    {{ method_field('put') }}
    <legend >
        {{__('Filtro de usuarios')}}
        <button type="button" class="btn btn-default" data-toggle="collapse" data-target=".users-fieldset" aria-expanded="false">
            <i class="fa fa-search"></i>
        </button>
    </legend>

    <fieldset class="users-fieldset collapse">
        <div class="row m-t-20">

            @include('global.input-b',['type'=>'text','id'=>'f_username','name'=>'f_username','class'=>'input-text',
            'placeholder'=>__('users/list.username'),'icon'=>'fa fa-user', 'required'=>false,'readonly'=>false,'disabled'=>false, 'col'=>'3','value'=>null])

            @include('global.input-b',['type'=>'text','id'=>'f_name','name'=>'f_name','class'=>'input-text',
            'placeholder'=>__('users/list.name'),'icon'=>'fa fa-user', 'required'=>false,'readonly'=>false,'disabled'=>false, 'col'=>'3','value'=>null])

            @include('global.input-b',['type'=>'text','id'=>'f_surname','name'=>'f_surname','class'=>'input-text',
            'placeholder'=>__('users/list.surname'),'icon'=>'fa fa-user', 'required'=>false,'readonly'=>false,'disabled'=>false, 'col'=>'3','value'=>null])

            @include('global.input-b',['type'=>'email','id'=>'f_email','name'=>'f_email','class'=>'input-text',
            'placeholder'=>__('users/list.email'),'icon'=>'fa fa-envelope-o', 'required'=>false,'readonly'=>false,'disabled'=>false, 'col'=>'3','value'=>null])

           {{-- @include('global.input-b',['type'=>'number','id'=>'f_phone','name'=>'f_phone','class'=>'input-text',
            'placeholder'=>__('users/list.phone'),'icon'=>'fa fa-phone', 'required'=>false,'readonly'=>false,'disabled'=>false, 'col'=>'3','value'=>null])
--}}

            @include('global.selectpicker',
                     [
                          'id'=>'f_role_id',
                          'name'=>'f_role_id',
                          'default'=>Lang::get('Seleccione Rol'),
                          'disabled'=>false,
                          'readonly'=>false,
                          'objects'=>$roles,
                          'value'=>'id',
                          'display'=>'display_name',
                          'selected_value'=>null,
                          'col'=>'3 ',
                          'required'=>true

                      ]
                  )

            @include('global.selectpicker',
            [
                 'id'=>'f_active',
                 'name'=>'f_active',
                 'default'=>Lang::get('Activo / Inactivo'),
                 'disabled'=>false,
                 'readonly'=>false,
                 'value'=>'id',
                 'display'=>'name',
                 'objects'=>[
                                ['id'=>0,'name'=>'Inactivo'],
                                ['id'=>1,'name'=>'Activo'],
                             ],
                 'col'=>'3 ','required'=>true, 'selected_value'=>1
             ]
         )



        </div>
    </fieldset>

</form>
