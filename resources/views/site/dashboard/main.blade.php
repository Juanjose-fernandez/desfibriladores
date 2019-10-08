@extends('layouts.default')

{{-- STYLES --}}
@section('styles')
    <!-- Datetimepicker-->
    <link rel="stylesheet" href="{{ URL::asset('js/plugin/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
@endsection

{{-- Web site Title --}}
@section('breadcrumb')
    <div>
    @include('site.includes.breadcrumb',['breadcrumbs'=>['Estadísticas','Principal']])
    <a id="btn-helper" href="javascript:void(0);" class="btn btn-info btn-circle m-t-5"><i class="glyphicon glyphicon-info-sign"></i></a>
    </div>
@endsection

<!-- actions buttons for view -->
@section('view_buttons')
    <a href="{{URL::previous()}}" id="add" class="btn btn-info btn-sm" data-title="add"><i class="fa fa-arrow-left"></i> {{Lang::get('global.back')}}</a>
@endsection

@section('content')

    <div style="height: 100vh;">

    <div id="modal-helper">
    </div>

<h1 class="text-center">Estadísticas</h1>
<div class="col-md-6">
    <h3 class="text-center">Reparto de tiempo de estudio</h3>
    <div id="study-percentage-chart">
        @include('site.dashboard.study-time-chart')
    </div>

    <div class="row text-center">
        @include('global.input-b',['type'=>'date','id'=>'fecha_inicio','name'=>'fecha_inicio','class'=>'','label'=>Lang::get('Fecha inicio'),'col'=>'6' ,
                                                      'value'=>''])
        @include('global.input-b',['type'=>'date','id'=>'fecha_fin','name'=>'fecha_fin','class'=>'','label'=>Lang::get('Fecha fin') ,'col'=>'6' ,
                                                  'value'=>''])
        <button class="btn btn-success" id="date-filter">Aplicar filtro</button>
    </div>

</div>

<div class="col-xs-12 col-md-6">
    <h3 class="text-center">Simulador</h3>
    <div class="col-xs-6 col-md-6">

        <h4 class="text-center">Carga diaria aproximada</h4>
        <div class="col-md-12 text-center">
            @include('global.input-b',['type'=>'date','id'=>'target-date','name'=>'target-date','class'=>'','label'=>Lang::get('Fecha objetivo'),'col'=>'12' ,
                                                          'value'=>''])
            <button class="btn btn-success" id="calc-daily-study-time">Calcular</button>
        </div>

        <div class="text-center">
            <div id="result1"></div>
        </div>

    </div>

    <div class="col-xs-6 col-md-6">
        <h4 class="text-center">Vuelta completa</h4>
        <div class="col-md-12 text-center">

            @include('global.clockpicker',
                [
                     'id'=>'daily_study_time',
                     'name'=>'daily_study_time',
                     'class'=>'input-hide-keyboard',
                     'default' => isset($unit) ? $unit->duration_in_timestamps : null,
                     'value' => isset($unit) ? $unit->duration_in_timestamps : null,
                     'autoclose' => true,
                     'placement' => 'top',
                     'label' => __('Tiempo de estudio diario'),
                     'col' => 12
                 ]
            )
            <button class="btn btn-success" id="calc-finish-date">Calcular</button>
        </div>

        <div class="text-center">
            <div id="result2"></div>
        </div>
    </div>


</div>
    </div>

@endsection

@section('scripts')

    <!--Datepicker-->
    <script type="text/javascript" src="{{URL::asset('/js/plugin/datetimepicker/js/collapse.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/plugin/datetimepicker/js/transition.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/plugin/datetimepicker/js/moment.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/plugin/datetimepicker/js/locales/locale-es.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/plugin/datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>
    <!--Clockpicker-->
    <script src="{{URL::to('js/plugin/clockpicker/bootstrap-clockpicker.min.js')}}"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            $('.clockpicker').clockpicker();

            $('.datetimepicker').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                format: 'DD/MM/YYYY'
            });

            $('#date-filter').click( function (){
                sendDates();
            });

            function sendDates (){
                var fechaIni = $('#fecha_inicio').val();
                var fechaFin = $('#fecha_fin').val();


                var dateNow=new Date();


                var dayNow=dateNow.getUTCDate();
                var monthNow=dateNow.getUTCMonth()+1;
                var yearNow=dateNow.getUTCFullYear();

                dateNow=dayNow+'/'+monthNow+'/'+yearNow;

                if(fechaIni!='' && fechaFin!='' && fechaIni<=fechaFin && fechaFin<=dateNow){
                    $.ajax({
                        url:"{{route('dashboard.study-time-distribution')}}",
                        method: 'GET',
                        data: {fechaIni: fechaIni, fechaFin: fechaFin},
                        dataType: "html",
                        success: function (data) {
                            $('#study-percentage-chart').html(data);
                        }

                    });
                }


                console.log(fechaIni + ' // ' +fechaFin);
            }

            $('#calc-daily-study-time').click(function () {
                $('#result1').html('');
                if($('#target-date').val()!=="")
                       calcDailyStudyTime();
            });

            function calcDailyStudyTime(){
                var targetDate = $('#target-date').val();

                $.ajax({
                    url:"{{URL::to('/dashboard/calc-daily-study-time/')}}",
                    method: 'GET',
                    data: {targetDate: targetDate},
                    dataType: "json",
                    success: function (data) {
                        var string = 'Su biblioteca completa tiene una duración total de';
                        if(data.hours > 0)
                            string +=' ' + data.hours + ' horas y';
                        else
                            string +=' 0 horas y';
                        if(data.minutes > 0)
                            string +=' ' + data.minutes + ' minutos';
                        else
                            string +=' 0 minutos';

                        if(data.dailyHours+data.dailyMinutes==0)
                            string +=". Ya terminó sus estudios.";
                        else {
                            string += '. Debe estudiar';
                            if (data.dailyHours > 0)
                                string += ' ' + data.dailyHours + ' horas';
                            if (data.dailyMinutes > 0)
                                string += ' ' + data.dailyMinutes + ' minutos';

                            string += ' al día durante los próximos ' + data.days + ' días para terminar la vuelta completa en la fecha objetivo.'
                        }

                            $('#result1').html('<h4>Resultado</h4><p>'+string+'</p>');
                    }

                });
            }

            $('#calc-finish-date').click(function () {
                $('#result2').html('');
                if($('#daily_study_time').val()!=="")
                    calcFinishDate();
            });

            function calcFinishDate(){
                var dailyStudyTime = $('#daily_study_time').val();

                $.ajax({
                    url:"{{URL::to('/dashboard/calc-finish-date/')}}",
                    method: 'GET',
                    data: {dailyStudyTime: dailyStudyTime},
                    dataType: "json",
                    success: function (data) {

                        var date = new Date(data.date);

                        var string = 'Su biblioteca completa tiene una duración total de';

                        if(data.hours > 0)
                            string +=' ' + data.hours + ' horas y';
                        else
                            string +=' 0 horas y';

                        if(data.minutes > 0)
                            string +=' ' + data.minutes + ' minutos';
                        else
                            string +=' 0 minutos';

                        if(data.hours+data.minutes==0)
                            string +=". Ya terminó sus estudios.";
                        else
                            string +='. A este ritmo acabaría el '+ date.toLocaleDateString();


                        $('#result2').html('<h4>Resultado</h4><p>'+string+'</p>');
                    }

                });
            }
        });
    </script>

    <!-- SELECT PICKER -->
    <script src="{{URL::to('js/plugin/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{URL::to('js/global/alerts.js')}}"></script>

    <!-- CKEDITOR -->
    <script src="{{URL::to('js/ckeditor/ckeditor.js')}}"></script>


    <script type="text/javascript">
        $("#modal-helper").iziModal();
        $(document).ready(function() {
            $('#btn-helper').click(function(){

                var title="Guía de Ayuda - {!!$help->category !!}";
                $('#modal').iziModal('setTitle', title);
                $('#modal').iziModal('setContent', '<div class="m-t-20 m-b-20 m-l-20 m-r-20">{!!$help->description !!}</div>');
                $('#modal').iziModal('setIcon', 'glyphicon glyphicon-info-sign');
                $('#modal').iziModal('open');
            });

        });
    </script>


@endsection
