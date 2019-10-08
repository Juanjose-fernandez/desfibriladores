<!-- NEW WIDGET START -->
<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget jarviswidget-color-darken" id="wid_{{$id}}"data-widget-editbutton="false" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-togglebutton="false"
         data-widget-fullscreenbutton="false"
         data-widget-colorbutton="false">
        <header>
            <span class="widget-icon"> <i class="{{$icon}}"></i> </span>
            <h2>{{Lang::get($title)}}</h2>
        </header>        <!-- widget div-->

        <div>
            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->
            </div>
            <!-- end widget edit box -->

            <!-- widget content -->
            <div class="widget-body no-padding">

                @if(isset($toolbar))
                    <div class="widget-body-toolbar">

                        <div class="row">



                            <div class="col-xs-9 ">

                                @if(isset($toolbar_content))
                                    {!! $toolbar_content !!}
                                @endif

                            </div>

                            <div class="col-xs-3  text-right">

                                @if(isset($buttons))
                                    {!! $buttons !!}
                                @endif


                            </div>

                        </div>

                    </div>
                @endif


                <table id="{{$id}}" class="table table-bordered table-hover table-responsive   @if(isset($class)){{$class}}@endif" width="100%">
                    <thead>
                    <tr>
                        @foreach($columns as $column)
                            <th data-class="{{isset($column[2]) ? $column[2] : null}}" data-hide="{{isset($column[1]) ? $column[1] : null}}">{{ Lang::get($column[0]) }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody></tbody>
                    @if(isset($tfoot) && $tfoot==true)
                        <tfoot>
                        <tr>
                            @foreach($columns as $column)
                                <th>{{ Lang::get($column[0]) }}</th>
                            @endforeach
                        </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
            <!-- end widget content -->
        </div>
        <!-- end widget div -->
    </div>
    <!-- end widget -->



</article>
<!-- NEW WIDGET END -->
