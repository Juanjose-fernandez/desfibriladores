


@extends('layouts.default')
{{-- STYLES --}}
@section('styles')
    <!-- Datetimepicker-->
    <link rel="stylesheet" href="{{ URL::asset('js/plugin/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

@endsection
{{-- Web site Title --}}
@section('breadcrumb')
    <div>
        @include('site.includes.breadcrumb',['breadcrumbs'=>['Clientes','global.listing']])
    </div>
@endsection

<!-- actions buttons for view -->
@section('view_buttons')
    <a href="{{URL::previous()}}" id="add" class="btn btn-info btn-sm" data-title="add"><i class="fa fa-arrow-left"></i> {{Lang::get('global.back')}}</a>
@endsection

@section('content')

    <div id="modal-helper">
    </div>

    <!-- widget grid -->
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
             <!-- User Datatable-->
                @includeIf('site.client.list')
            <!-- End User Datatable-->
            </article>
        </div>
        <!-- end row -->
    </section>
    <!-- end widget grid -->

@endsection

@section('scripts')

    <script>
        var sUrl =  "{{ URL::asset('js/plugin/datatables/spanish.json') }}";
        var urlClientDataTable =  "{{route('admin.client.data')}}";
        var oClientTable =  null;
    </script>

    <script src="{{URL::asset('js/models/clients/list.js')}}"></script>

    <script type="text/javascript">
        //añadir javascript necesario para esta vista aqui.
        $(document).ready(function() {

            loadClientDatatable();
        });

    </script>

@endsection
