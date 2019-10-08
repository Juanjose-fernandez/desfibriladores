@extends('layouts.default')

{{-- STYLES --}}
@section('styles')
    <!-- Dropify Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('css/dropify.css')}}">
    <!-- Datetimepicker-->
    <link rel="stylesheet" href="{{ URL::asset('js/plugin/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
@endsection

{{-- Web site Title --}}
@section('breadcrumb')
    <div>
    @include('site.includes.breadcrumb',['breadcrumbs'=>['users/list.profile','global.edit']])
    </div>
@endsection

<!-- actions buttons for view -->
@section('view_buttons')
    <a href="{{URL::to('/')}}" id="add" class="btn btn-info btn-sm" data-title="add"><i class="fa fa-arrow-left"></i> {{Lang::get('global.back')}}</a>
@endsection

@section('content')

    <!-- Notifications OLDs Notifications -->
    {{--@include('site/includes/notifications')--}}

    <!-- widget grid -->
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">

                    <header role="heading">
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>{{Lang::get('users/list.user_data')}}</h2>
                    </header>

                    <!-- widget div-->
                    <div role="content">

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body">

                            <form id="update_user_profile" class="" novalidate="novalidate" method="post" action="{{URL::to('/profile/update-info')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input id="user_id" name="user_id" type="hidden" value="{{Auth::user()->getId()}}">
                                {{--<legend>--}}
                                {{--{{Lang::get('users/list.user_data')}}--}}
                                {{--</legend>--}}

                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                @include('global.input-b',['type'=>'text','id'=>'user_username' ,'label'=>'users/list.username','name'=>'user_username', 'icon'=>'fa fa-user', 'required'=>true, 'col'=>'6','value'=>Auth::user()->getUsername()])
                                                @include('global.input-b',['type'=>'text','id'=>'user_email' ,'label'=>'users/list.email','name'=>'user_email', 'icon'=>'fa fa-envelope-o', 'required'=>true, 'col'=>'6','value'=>Auth::user()->getEmail()])
                                            </div>
                                            <div class="row">
                                                @include('global.input-b',['type'=>'text','id'=>'user_name' ,'label'=>'users/list.name','name'=>'user_name', 'icon'=>'fa fa-user', 'required'=>false, 'col'=>'6','value'=>Auth::user()->getName()])

                                                @include('global.input-b',['type'=>'text','id'=>'user_surname' ,'label'=>'users/list.surname','name'=>'user_surname', 'icon'=>'fa fa-user', 'required'=>false, 'col'=>'6','value'=>Auth::user()->getSurname()])
                                            </div>

                                            <div class="row">
                                                @include('global.input-b',['type'=>'text','id'=>'phone' ,'label'=>'Teléfono','name'=>'phone', 'icon'=>'fa fa-phone', 'required'=>false, 'col'=>'6','value'=>Auth::user()->getPhone()])
                                            </div>

                                            <div class="row">
                                                @include('global.input-b',['type'=>'date','id'=>'birth_date','name'=>'birth_date','class'=>'','label'=>Lang::get('Fecha nacimiento') , 'required'=>false,'col'=>'6' ,
                                              'value'=>Auth::user()->getBirthDate() ? Auth::user()->getFormatedBirthDate():null])

                                            </div>



                                        </div>
                                    </div>

                                </fieldset>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit"  class="btn btn-success pull-right">Guardar</button>
                                        </div>
                                    </div>
                                </div>


                            </form>

                        </div>
                        <!-- end widget content -->

                    </div>
                    <!-- end widget div -->

                </div>
                <!-- end widget -->

                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-z" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                    <!-- widget options:
                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
                        data-widget-colorbutton="false"
                        data-widget-editbutton="false"
                        data-widget-togglebutton="false"
                        data-widget-deletebutton="false"
                        data-widget-fullscreenbutton="false"
                        data-widget-custombutton="false"
                        data-widget-collapsed="true"
                        data-widget-sortable="false"
                    -->
                    <header role="heading">
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>{{Lang::get('users/list.changepass')}}</h2>

                    </header>

                    <!-- widget div-->
                    <div role="content">

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body">

                            <form id="update_user_pass" class=" " novalidate="novalidate" method="post" action="{{URL::to('/profile/update-pass')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{--<legend>--}}
                                {{--{{Lang::get('users/list.user_data')}}--}}
                                {{--</legend>--}}

                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2">
                                            <div class="row">
                                                @include('global.input-b',['type'=>'password','id'=>'old_user_password' ,'label'=>'Contraseña actual','name'=>'old_user_password', 'icon'=>'fa fa-key', 'required'=>false, 'col'=>'4','value'=>null])
                                                @include('global.input-b',['type'=>'password','id'=>'user_password' ,'label'=>'Nueva Contraseña','name'=>'user_password', 'icon'=>'fa fa-key', 'required'=>false, 'col'=>'4','value'=>null])
                                                @include('global.input-b',['type'=>'password','id'=>'user_password_confirm' ,'label'=>'Repite la contraseña','name'=>'user_password_confirm', 'icon'=>'fa fa-key', 'required'=>false, 'col'=>'4','value'=>null])
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit"  class="btn btn-success pull-right">Guardar</button>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                        <!-- end widget content -->

                    </div>
                    <!-- end widget div -->

                </div>
                <!-- end widget -->

            </article>

        </div>
        <!-- end row -->
    </section>
    <!-- end widget grid -->

@endsection

@section('scripts')

    <!-- DROPIFY -->
    <script src="{{URL::to('js/plugin/dropify/dropify.min.js')}}"></script>

    <!--Datepicker-->
    <script type="text/javascript" src="{{URL::asset('/js/plugin/datetimepicker/js/collapse.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/plugin/datetimepicker/js/transition.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/plugin/datetimepicker/js/moment.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/plugin/datetimepicker/js/locales/locale-es.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/plugin/datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('.datetimepicker').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                format: 'DD/MM/YYYY'
            });

/*
            $("#user_avatar").dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove':  'Remove',
                    'error':   'Ooops, something wrong happended.'
                }
            });
            */

            // Form validation
            $('#update_user_profile').validate({
                lang: 'ES',
                rules: {
                    name: 'required',
                    surname: 'required',
                    email: {
                        required: true,
                        email: true
                    }
                }
            });

            $('#update_user_pass').validate({
                lang: 'ES',
                rules: {
                    old_password: 'required',
                    password: 'required',
                    password_confirm: {
                        required: true,
                        equalTo: '#user_password'
                    }
                }
            });

        });
    </script>


    <script src="{{URL::to('js/global/alerts.js')}}"></script>


    <<script type="text/javascript">

        $(document).ready(function() {


        });
    </script>
@endsection