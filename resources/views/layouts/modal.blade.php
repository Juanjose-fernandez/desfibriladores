{{--
    Instrucciones para las vistas que heredan de panel

    @section('header')@stop  : si no queremos cabecera
    @section('header')@overwrite : si ya hay algun header y no queremos heredarlo

    @section('header')@parent Para heredar la cabecera del panel y
                      @php
                      $titulo= 'Filtro usuarios';
                      $icono= 'fa fa-search';
                      @endphp
                      Para setear el titulo y el icono del header

--}}

<div class="modal fade" id="@if(isset($id)){{$id}}@endif" tabindex="-1" role="dialog" style="overflow: visible!important">
    <div class="modal-dialog @if(isset($lg)) modal-lg @endif" role="document">
        <div class="modal-content">
            @section('modal-header')
                <div class="modal-header">

                    @if(isset($btn_close))
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    @endif
                    @if(isset($titulo))
                        <h4 class="modal-title">{{$titulo}} <span class="modal-title-more"></span></h4>
                    @endif
                </div>
            @show

            <div class=" @if(isset($scroll) && $scroll) scroll @else modal-body  @endif">
                @yield('modal-contenido')


                @if(isset($scroll) && $scroll)
                    <div class="modal-footer">
                        <div class="col-md-12">
                            @section('modal-footer')
                                @if(isset($btn_cancel))
                                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                                @endif
                            @show
                        </div>
                    </div>
                @endif


            </div>




                @if(!isset($scroll) || $scroll==false)
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <div class="col-md-12">
                            @section('modal-footer')
                                @if(isset($btn_cancel))
                                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                                @endif
                            @show
                        </div>
                    </div>
                @endif



        </div>
    </div>
</div>