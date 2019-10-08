@extends('layouts.default')
{{-- STYLES --}}
@section('styles')
    <!-- Datetimepicker-->
    <link rel="stylesheet" href="{{ URL::asset('js/plugin/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
@endsection

{{-- Web site Title --}}
@section('breadcrumb')
    @include('site.includes.breadcrumb',['breadcrumbs'=>['Inputs','Ejemplos']])
@endsection

        <!-- actions buttons for view -->
@section('view_buttons')
    <a href="{{URL::to('/')}}" id="add" class="btn btn-info btn-sm" data-title="add"><i class="fa fa-plus"></i> {{Lang::get('global.back')}}</a>
@endsection

@section('content')

    <!-- widget grid -->
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-z" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">

                <header role="heading">
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>{{Lang::get('Inputs')}}</h2>

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

                        <div class="row">
                            <div class="col-md-12">
                            <a href="#tipo-text" id="add" class="btn btn-success btn-sm" data-title="add"><i class="fa fa-plus"></i> {{Lang::get('Tipo texto')}}</a>
                            <a href="#tipo-number" id="add" class="btn btn-success btn-sm" data-title="add"><i class="fa fa-plus"></i> {{Lang::get('Tipo number')}}</a>
                            <a href="#tipo-password" id="add" class="btn btn-success btn-sm" data-title="add"><i class="fa fa-plus"></i> {{Lang::get('Tipo password')}}</a>
                            <a href="#tipo-email" id="add" class="btn btn-success btn-sm" data-title="add"><i class="fa fa-plus"></i> {{Lang::get('Tipo email')}}</a>
                            <a href="#tipo-check" id="add" class="btn btn-success btn-sm" data-title="add"><i class="fa fa-plus"></i> {{Lang::get('Tipo checkbox')}}</a>
                            <a href="#tipo-radio" id="add" class="btn btn-success btn-sm" data-title="add"><i class="fa fa-plus"></i> {{Lang::get('Tipo radio')}}</a>
                            <a href="#tipo-textarea" id="add" class="btn btn-success btn-sm" data-title="add"><i class="fa fa-plus"></i> {{Lang::get('Tipo textarea')}}</a>
                            <a href="#tipo-date" id="add" class="btn btn-success btn-sm" data-title="add"><i class="fa fa-plus"></i> {{Lang::get('Tipo Fecha')}}</a>
                            </div>
                        </div>

                        <form id="" class="" novalidate="novalidate" method="post" action="" enctype="multipart/form-data">

                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6 col-md-offset-4">
                                            <h2>Parámetros que comparten todos los inputs</h2>

                                            <ul>
                                                <li>id</li>
                                                <li>name  (opcional : si no se setea se utilizará el "id" como "name")</li>
                                                <li>class (opcional)</li>
                                                <li>label (opcional)</li>
                                                <li>value</li>
                                                <li>data_atributes (opcional)
                                                    <ul>
                                                        <li><b>Ejemplo</b></li>
                                                        <li>'data_attributes'=>['nombre_atributo'=>'valor_atributo']</li>
                                                    </ul>
                                                </li>

                                                <li>col</li>
                                                <li>hidden (opcional)</li>
                                                <li>required (opcional)</li>
                                                <li>readonly (opcional)</li>
                                                <li>disabled (opcional)</li>
                                                <li>aling (opcional : si no se setea es un input vertical, si se 'align'=>'horizontal' es horizontal)</li>
                                            </ul>
                                        </div>

                                        <div class="tipo-text">
                                            <div class="col-md-12">
                                                <legend>Tipo Texto</legend>
                                                @include('global.input-b',['type'=>'text','id'=>'example-text'        ,'class'=>'input-text','label'=>Lang::get('Ejemplo texto')         , 'icon'=>'fa fa-user', 'required'=>false,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'text','id'=>'example-text-readonly'    ,'name'=>'text','class'=>'input-text','label'=>Lang::get('Ejemplo texto readonly'), 'icon'=>'fa fa-user', 'required'=>false,'readonly'=>true, 'col'=>'2','value'=>null])
                                                @include('global.input-b',['type'=>'text','id'=>'example-text-disabled'    ,'name'=>'text','class'=>'input-text','label'=>Lang::get('Ejemplo texto disabled'), 'icon'=>'fa fa-user', 'required'=>false, 'disabled'=>true, 'col'=>'2','value'=>null])
                                                @include('global.input-b',['type'=>'text','id'=>'example-text-no-icon'     ,'name'=>'text','class'=>'input-text','label'=>Lang::get('Ejemplo texto sin icono'), 'required'=>false, 'disabled'=>false, 'col'=>'2','value'=>'valor'])
                                                @include('global.input-b',['type'=>'text','id'=>'example-text-horizontal' ,'name'=>'text','class'=>'input-text','label'=>Lang::get('Ejemplo texto horizontal'), 'icon'=>'fa fa-user', 'col'=>'4','aling'=>'horizontal','value'=>null])
                                            </div>


                                            <div class="col-md-12">
                                                <div class="highlight m-l-10">
                                                    <pre><code class="html">@php echo trim('@'."include('global.input-b',['type'=>'text','id'=>'text_example_id','name'=>'example_name','class'=>'input-text','label'=>'Ejemplo texto', 'icon'=>'fa fa-user', 'required'=>false,'readonly'=>false,'disabled'=>false, 'col'=>'12','value'=>null])")@endphp</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h6>Parámetros específicos</h6>
                                                <p>'icon'=>'fa fa-user'  (opcional)</p>
                                                <p>'placeholder'=>'texto que será remplazado'  (opcional)</p>
                                            </div>

                                        </div>


                                        <div class="tipo-number">
                                            <div class="col-md-12">
                                                <legend>Tipo Número</legend>
                                                @include('global.input-b',['type'=>'number','id'=>'example-number','name'=>'example-number','class'=>'input-number','label'=>Lang::get('Ejemplo Número') , 'icon'=>'fa fa-sort-numeric-asc', 'required'=>false,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'number','id'=>'example-number-readonly','name'=>'number','class'=>'input-number','label'=>Lang::get('Ejemplo Número readonly') , 'icon'=>'fa fa-sort-numeric-asc', 'required'=>false,'readonly'=>true,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'number','id'=>'example-number-disabled','name'=>'number','class'=>'input-number','label'=>Lang::get('Ejemplo Número disabled') , 'icon'=>'fa fa-sort-numeric-asc', 'required'=>false,'disabled'=>true,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'number','id'=>'example-no-icon','name'=>'number','class'=>'input-number','label'=>Lang::get('Ejemplo Número sin icono') , 'required'=>false,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'number','id'=>'example-number','class'=>'input-number','label'=>Lang::get('Ejemplo Número') , 'icon'=>'fa fa-sort-numeric-asc', 'required'=>false,'col'=>'4','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'aling'=>'horizontal','value'=>null])
                                            </div>


                                            <div class="col-md-12">
                                                <div class="highlight m-l-10">
                                                    <pre id="tipo-number"><code class="html">@php echo trim('@'."include('global.input-b',['type'=>'number','id'=>'number_example_id','name'=>'number_name','class'=>'input-number','label'=>'Ejemplo Número', 'icon'=>'fa fa-sort-numeric-asc', 'required'=>false,'readonly'=>false,'disabled'=>false, 'col'=>'12','value'=>null])")@endphp</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h6>Parámetros específicos</h6>
                                                <p>'icon'=>'fa fa-user'  (opcional)</p>
                                                <p>'placeholder'=>'texto que será remplazado'  (opcional)</p>
                                            </div>

                                        </div>


                                        <div class="tipo-password">
                                            <div class="col-md-12">
                                                <legend>Tipo Password</legend>
                                                @include('global.input-b',['type'=>'password','id'=>'example-password','name'=>'password','class'=>'input-number','label'=>Lang::get('Ejemplo Password') , 'icon'=>'fa  fa-certificate', 'required'=>false,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'password','id'=>'example-password-readonly','password'=>'number','class'=>'input-number','label'=>Lang::get('Ejemplo Password readonly') , 'icon'=>'fa  fa-certificate', 'required'=>false,'readonly'=>true,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'password','id'=>'example-number-disabled','name'=>'number','class'=>'input-number','label'=>Lang::get('Ejemplo Password disabled') , 'icon'=>'fa  fa-certificate', 'required'=>false,'disabled'=>true,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'password','id'=>'example-no-icon','name'=>'number','class'=>'input-number','label'=>Lang::get('Ejemplo Password sin icono') , 'required'=>false,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'password','id'=>'example-number','class'=>'input-number','label'=>Lang::get('Ejemplo Número') , 'icon'=>'fa fa-certificate', 'required'=>false,'col'=>'4','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'aling'=>'horizontal','value'=>null])
                                            </div>


                                            <div class="col-md-12">
                                                <div class="highlight m-l-10">
                                                    <pre id="tipo-password"><code class="html">@php echo trim('@'."include('global.input-b',['type'=>'password','id'=>'password_example_id','name'=>'password_name','class'=>'input-password','label'=>'Ejemplo password', 'icon'=>'fa fa-certificate', 'required'=>false,'readonly'=>false,'disabled'=>false, 'col'=>'12','value'=>null])")@endphp</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h6>Parámetros específicos</h6>
                                                <p>'icon'=>'fa fa-user'  (opcional)</p>
                                                <p>'placeholder'=>'texto que será remplazado'  (opcional)</p>
                                            </div>

                                        </div>

                                        <div class="tipo-email">
                                            <div class="col-md-12">
                                                <legend>Tipo Email</legend>
                                                @include('global.input-b',['type'=>'email','id'=>'example-email','name'=>'example-number','class'=>'input-number','label'=>Lang::get('Ejemplo Email') , 'icon'=>'fa  fa-envelope', 'required'=>false,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'email','id'=>'example-email-readonly','name'=>'number','class'=>'input-number','label'=>Lang::get('Ejemplo Email readonly') , 'icon'=>'fa  fa-envelope', 'required'=>false,'readonly'=>true,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'email','id'=>'example-email-disabled','name'=>'number','class'=>'input-number','label'=>Lang::get('Ejemplo Email disabled') , 'icon'=>'fa  fa-envelope', 'required'=>false,'disabled'=>true,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'email','id'=>'example-email-no-icon','name'=>'number','class'=>'input-number','label'=>Lang::get('Ejemplo Password sin icono') , 'required'=>false,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'email','id'=>'example-email','class'=>'input-number','label'=>Lang::get('Ejemplo Número') , 'icon'=>'fa fa-envelope', 'required'=>false,'col'=>'4','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'aling'=>'horizontal','value'=>null])
                                            </div>


                                            <div class="col-md-12">
                                                <div class="highlight m-l-10">
                                                    <pre id="tipo-email"><code class="html">@php echo trim('@'."include('global.input-b',['type'=>'email','id'=>'email_example_id','name'=>'email_name','class'=>'input-email','label'=>'Ejemplo Email', 'icon'=>'fa fa-envelope', 'required'=>false,'readonly'=>false,'disabled'=>false, 'col'=>'12','value'=>null])")@endphp</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h6>Parámetros específicos</h6>
                                                <p>'icon'=>'fa fa-user'  (opcional)</p>
                                                <p>'placeholder'=>'texto que será remplazado'  (opcional)</p>
                                            </div>

                                        </div>

                                        <div class="tipo-check">
                                            <div class="col-md-12">
                                                <legend>Tipo Checkbox </legend>
                                                @include('global.input-b',['type'=>'checkbox','id'=>'example-checkbox','name'=>'example-check' ,'class'=>'input-check','label'=>Lang::get('Ejemplo Checkbox') , 'required'=>false,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null,'checked'=>true,'texto'=>'Ejemplo opción1'])
                                                @include('global.input-b',['type'=>'checkbox','id'=>'example-checkbox-readonly','name'=>'check','class'=>'input-check','label'=>Lang::get('Ejemplo Checkbox readonly') , 'icon'=>'fa  fa-envelope', 'required'=>false,'readonly'=>true,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'texto'=>'opcion 2','value'=>null])
                                                @include('global.input-b',['type'=>'checkbox','id'=>'example-checkbox-disabled','name'=>'check','class'=>'input-check','label'=>Lang::get('Ejemplo Checkbox disabled') , 'icon'=>'fa  fa-envelope', 'required'=>false,'disabled'=>true,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'texto'=>'opcion 3','value'=>null])
                                                @include('global.input-b',['type'=>'checkbox','id'=>'example-checkbox','class'=>'input-check','label'=>Lang::get('Ejemplo Checkbox') , 'icon'=>'fa fa-envelope', 'required'=>false,'col'=>'4','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'aling'=>'horizontal','value'=>null,'texto'=>'opcion 4'])

                                            </div>


                                            <div class="col-md-12">
                                                <div class="highlight m-l-10">
                                                    <pre id="tipo-check"><code class="html">@php echo trim('@'."include('global.input-b',['type'=>'checkbox','id'=>'example-checkbox','name'=>'example-check' ,'class'=>'input-check','label'=>Lang::get('Ejemplo Checkbox') , 'required'=>false,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null,'checked'=>true,'texto'=>'Ejemplo opción1'])")@endphp</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h6>Parámetros específicos</h6>
                                                <p>'texto'=>'opcion 1'  (Requerido)</p>
                                                <p>'checked'=>true</p>
                                            </div>

                                        </div>

                                        <div class="tipo-radio">
                                            <div class="col-md-12">
                                                <legend>Tipo Radio</legend>
                                                @include('global.input-b',['type'=>'radio','id'=>'example-radio','name'=>'example-check' ,'class'=>'input-radio','label'=>Lang::get('Ejemplo Radio') , 'required'=>false,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null,'checked'=>true,'texto'=>'Ejemplo opción1'])
                                                @include('global.input-b',['type'=>'radio','id'=>'example-radio-readonly','name'=>'check','class'=>'input-radio','label'=>Lang::get('Ejemplo Radio readonly') , 'icon'=>'fa  fa-envelope', 'required'=>false,'readonly'=>true,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'texto'=>'opcion 2','value'=>null])
                                                @include('global.input-b',['type'=>'radio','id'=>'example-radio-disabled','name'=>'check','class'=>'input-radio','label'=>Lang::get('Ejemplo Radio disabled') , 'icon'=>'fa  fa-envelope', 'required'=>false,'disabled'=>true,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'texto'=>'opcion 3','value'=>null])
                                                @include('global.input-b',['type'=>'radio','id'=>'example-radio','class'=>'input-radio' , 'icon'=>'fa fa-envelope', 'label'=>Lang::get('Ejemplo Radio horizontal'),'required'=>false,'col'=>'3','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'aling'=>'horizontal','value'=>null,'texto'=>'opcion 4'])

                                            </div>


                                            <div class="col-md-12">
                                                <div class="highlight m-l-10">
                                                    <pre id="tipo-radio"><code class="html">@php echo trim('@'."include('global.input-b',['type'=>'radio','id'=>'example-radio','name'=>'example-check' ,'class'=>'input-radio','label'=>Lang::get('Ejemplo Radio') , 'required'=>false,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null,'checked'=>true,'texto'=>'Ejemplo opción1'])")@endphp</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h6>Parámetros específicos</h6>
                                                <p>'texto'=>'opcion 1'  (Requerido)</p>
                                                <p>'checked'=>true</p>
                                            </div>

                                        </div>

                                        <div class="tipo-textarea">
                                            <div class="col-md-12">
                                                <legend>Tipo Texarea</legend>
                                                @include('global.input-b',['type'=>'textarea','id'=>'example-textarea','rows'=>3             ,'class'=>'input-textarea','label'=>Lang::get('Ejemplo texto'), 'required'=>false,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'textarea','id'=>'example-textarea-readonly'    ,'name'=>'textarea','class'=>'input-textarea','label'=>Lang::get('Ejemplo textarea readonly'),  'required'=>false,'readonly'=>true, 'col'=>'2','value'=>null])
                                                @include('global.input-b',['type'=>'textarea','id'=>'example-textarea-disabled'    ,'name'=>'textarea','class'=>'input-textarea','label'=>Lang::get('Ejemplo textarea disabled'), 'required'=>false, 'disabled'=>true, 'col'=>'2','value'=>null])
                                                @include('global.input-b',['type'=>'textarea','id'=>'example-textarea-horizontal' ,'name'=>'textarea' ,'class'=>'input-textarea','label'=>Lang::get('Ejemplo textarea horizontal'), 'col'=>'6','aling'=>'horizontal','value'=>null])
                                            </div>


                                            <div class="col-md-12">
                                                <div class="highlight m-l-10">
                                                    <pre id="tipo-textarea"><code class="html">@php echo trim('@'."include('global.input-b',['type'=>'textarea','id'=>'example-textarea','rows'=>3 ,'class'=>'input-textarea','label'=>Lang::get('Ejemplo texto'), 'required'=>false,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])")@endphp</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h6>Parámetros específicos</h6>
                                                <p>'rows'=>5  (opcional)</p>
                                                <p>'placeholder'=>'texto que será remplazado'  (opcional)</p>
                                            </div>

                                        </div>



                                        <div class="tipo-date">
                                            <div class="col-md-12">
                                                <legend>Tipo Fecha</legend>
                                                @include('global.input-b',['type'=>'date','id'=>'example-date','name'=>'example-date','class'=>'input-date','label'=>Lang::get('Ejemplo Fecha') , 'required'=>false,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'date','id'=>'example-date-readonly','name'=>'date','class'=>'input-date','label'=>Lang::get('Ejemplo Fecha readonly') ,  'required'=>false,'readonly'=>true,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'date','id'=>'example-date-disabled','name'=>'date','class'=>'input-date','label'=>Lang::get('Ejemplo Fecha disabled') , 'required'=>false,'disabled'=>true,'col'=>'2','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'value'=>null])
                                                @include('global.input-b',['type'=>'date','id'=>'example-date','class'=>'input-date','label'=>Lang::get('Ejemplo Fecha') , 'required'=>false,'col'=>'4','data_attributes'=>['nombre_atributo'=>'valor_atributo','nombre_atributo2'=>'valor_atributo2'] ,'aling'=>'horizontal','value'=>null])
                                            </div>


                                            <div class="col-md-12">
                                                <div class="highlight m-l-10">
                                                    <pre id="tipo-date"><code class="html">@php echo trim('@'."include('global.input-b',['type'=>'number','id'=>'number_example_id','name'=>'number_name','class'=>'input-number','label'=>'Ejemplo Número', 'icon'=>'fa fa-sort-numeric-asc', 'required'=>false,'readonly'=>false,'disabled'=>false, 'col'=>'12','value'=>null])")@endphp</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h6>Parámetros específicos</h6>
                                                <p>'icon'=>'fa fa-user'  (opcional)</p>
                                                <p>'placeholder'=>'texto que será remplazado'  (opcional)</p>


                                                <h6>Dependencias</h6>
                                                <div class="col-md-12">
                                                    <div class="highlight m-l-10">
                                                        <pre id="tipo-date">
                                                            <code class="html">
                                                                <xmp>
                                                                <script type="text/javascript" src="{{ URL::asset('js/plugin/datetimepicker/js/collapse.js') }}"></script>
                                                                <script type="text/javascript" src="{{ URL::asset('js/plugin/datetimepicker/js/transition.js') }}"></script>
                                                                <script type="text/javascript" src="{{ URL::asset('js/plugin/datetimepicker/js/moment.js') }}"></script>
                                                                <script type="text/javascript" src="{{ URL::asset('js/plugin/datetimepicker/js/locales/locale-es.js') }}"></script>
                                                                <script type="text/javascript" src="{{ URL::asset('js/plugin/datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
                                                                </xmp>
                                                            </code>
                                                        </pre>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </fieldset>


                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">

                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>


        </div>
        <!-- end row -->
    </section>
    <!-- end widget grid -->

@endsection

@section('scripts')

    <!-- DATETIMEPICKER -->
    <script type="text/javascript" src="{{ URL::asset('js/plugin/datetimepicker/js/collapse.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/plugin/datetimepicker/js/transition.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/plugin/datetimepicker/js/moment.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/plugin/datetimepicker/js/locales/locale-es.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/plugin/datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>


    <script type="text/javascript">

        $(document).ready(function() {
            $('.datetimepicker').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                format: 'DD/MM/YYYY'
            });
        });
    </script>
@endsection
