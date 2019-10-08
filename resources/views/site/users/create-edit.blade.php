
<div class="well">
    <form id="create_user_form" class="" novalidate="novalidate" method="post"  action="{{isset($user) ?route('admin.user.update',['id'=>$user->getId()]) : route('admin.user.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}

        @if(isset($user))
            <input type="hidden" name="_method" value="put"/>
        @endif


        <fieldset>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @include('global.input-b',['type'=>'text','id'=>'username' ,'label'=>'users/list.username','name'=>'username', 'icon'=>'fa fa-user', 'required'=>false, 'col'=>'6','value'=>isset($user)  ? $user->getUsername() : null])
                        @include('global.input-b',['type'=>'text','id'=>'email' ,'label'=>'users/list.email','name'=>'email', 'icon'=>'fa fa-envelope-o', 'required'=>false, 'col'=>'6','value'=>isset($user)  ? $user->getEmail() : null])
                    </div>

                    <div class="row">
                        @include('global.input-b',['type'=>'text','id'=>'name' ,'label'=>'users/list.name','name'=>'name', 'icon'=>'fa fa-user', 'required'=>false, 'col'=>'6','value'=>isset($user)  ? $user->getName() : null])
                        @include('global.input-b',['type'=>'text','id'=>'surname' ,'label'=>'users/list.surname','name'=>'surname', 'icon'=>'fa fa-user', 'required'=>false, 'col'=>'6','value'=>isset($user)  ? $user->getSurname() : null])
                    </div>

                    @if(!isset($user))
                        <div class="row">
                            @include('global.input-b',['type'=>'password','id'=>'password' ,'label'=>'users/list.password','name'=>'password', 'icon'=>'fa fa-key', 'required'=>false, 'col'=>'6','value'=>isset($user)  ? $user->getPassword() : null])
                            @include('global.input-b',['type'=>'password','id'=>'password_confirm' ,'label'=>'users/list.password.confirm','name'=>'password_confirm', 'icon'=>'fa fa-key', 'required'=>false, 'col'=>'6','value'=>isset($user)  ? $user->getPassword() : null])
                        </div>
                    @endif

                    <div class="row">

                        @include('global.selectpicker',
                           [
                            'id'=>'role_id',
                            'name'=>'role_id',
                            'label'=>'Rol',
                            'default'=>Lang::get('Seleccione Rol'),
                            'disabled'=>false,
                            'readonly'=>false,
                            'objects'=>$roles,
                            'value'=>'id',
                            'display'=>'display_name',
                            'selected_value'=> isset($user) ? $user->getRoles()->first()->getId(): null ,
                            'col'=>'6',
                            'required'=>false
                            ]
                        )

                        @include('global.selectpicker',
                            [
                             'id'=>'active',
                             'name'=>'active',
                             'label'=>'Estado',
                             'default'=>Lang::get('Activo / Inactivo'),
                             'disabled'=>false,
                             'readonly'=>false,
                             'value'=>'id',
                             'display'=>'name',
                             'objects'=>[
                                ['id'=>0,'name'=>'Inactivo'],
                                ['id'=>1,'name'=>'Activo'],
                             ],
                             'col'=>'6','required'=>false,
                             'selected_value'=>isset($user)   ? $user->getActive() : 1
                            ]
                        )

                    </div>

                </div>
            </div>



        </fieldset>

        <footer>
            <button type="submit" id="btn-save-user" class="btn btn-success btn-block ">{{Lang::get('Guardar')}}</button>
        </footer>

    </form>
</div>



    <!-- SELECT PICKER -->
    <script src="{{URL::to('js/plugin/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{URL::to('js/global/alerts.js')}}"></script>
    <!--Datepicker-->
    <script type="text/javascript" src="{{URL::asset('/js/plugin/datetimepicker/js/collapse.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/plugin/datetimepicker/js/transition.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/plugin/datetimepicker/js/moment.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/plugin/datetimepicker/js/locales/locale-es.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/plugin/datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>

    <script type="text/javascript">



        $('.datetimepicker').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            format: 'DD/MM/YYYY'
        });

        $('.selectpicker').selectpicker();



            // Form validation
            $('#create_user_form').validate({
                lang: 'ES',
/*                rules: {
                    username: 'required',
                    user_name: 'required',
                    user_surname: 'required',
                    user_email: {
                        required: true,
                        email: true
                    },
                    user_role_id:'required',
                    user_active:'required'

                },*/
                submitHandler: function(){

                    var url = $('#create_user_form').prop('action');


                    $.post( url, $( "#create_user_form" ).serialize() ).done(function(response){
                        $('#modal').iziModal('close');
                        oUsersTable.draw();

                    });

                }

            });




    </script>

