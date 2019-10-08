@extends('layouts.default')
{{-- STYLES --}}
@section('styles')
    <!-- Datetimepicker-->
    <link rel="stylesheet" href="{{ URL::asset('js/plugin/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <!-- Duallistbox-->
    <link rel="stylesheet" href="{{ URL::asset('js/plugin/duallistbox//duallistbox.css') }}">
@endsection
{{-- Web site Title --}}
@section('breadcrumb')
    <div>
    @include('site.includes.breadcrumb',['breadcrumbs'=>['users/list.users','global.listing']])
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
                 @include('site.users.list',['filter'=>true,'roles'=>$roles])
                <!-- End User Datatable-->
            </article>
        </div>
        <!-- end row -->
    </section>
    <!-- end widget grid -->

@endsection

@section('scripts')

    <script src="{{URL::asset('js/models/users/list.js')}}"></script>

    <script type="text/javascript">
        var urlUsersData = "{{route('admin.user.index')}}";
        var oUsersTable = null;
        var urlDatatables ="{{ URL::asset('js/plugin/datatables/spanish.json') }}";
        var urlRestoreUser = "{{route('admin.user.restore')}}";
        $(document).ready(function() {
            loadUserDatatable();

            $("#users_table tbody").on("click", ".btn-restore", function () {
                $.put(urlRestoreUser,{user_id:$(this).data('user-id')},function(){
                    oUsersTable.draw();
                });
            });

            $("#users_table tbody").on("click", ".btn-delete", function () {
                sweetDelete($(this).data('href'), '¿Está seguro?', 'Va a proceder a eliminar el usuario', oUsersTable);
            });


        });
    </script>

    <!-- SELECT PICKER -->
    <script src="{{URL::to('js/plugin/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{URL::to('js/global/alerts.js')}}"></script>

    <!-- CKEDITOR -->
    <script src="{{URL::to('js/ckeditor/ckeditor.js')}}"></script>

    <script type="text/javascript">

        $(document).ready(function() {

        });
    </script>

@endsection
