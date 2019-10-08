{{--INPUT TYPE TEXT-------------------------*
*----PARAMS---------------------------------*
*   Type (Required)                         *

*   Readonly[true-false] (Optional)         *
*   Disabled[true-false] (Optional)         *

*   Mask (Optional)                         *
*   Placeholder (Optional)                  *
*   Tooltip (Optional)                      *










*   Id (Required)                           *
*   Name (Optional)                         *
*   Class (Optional)                        *
*   Col [1-12] (Optional)                   *
*   Block Id (Optional)                     *
*   Hidden (Optional)                       *
*   Label (Optional)                        *
*   Required[true-false] (Optional)         *
*   Value (Optional)                        *
*   Data Attributes(Optional)               *
*   Icon (Optional)                         *


*//////////////////////////////////Pluggin exclusive parameters///////////////////////////////////////*
*   Default [now-time] (Optional) (Default 0)                                                         *
*   Placement [top-left-bottom-right](Optional) (Default bottom)                                      *
*   Align [top-left-bottom-right](Optional) (Default left)                                            *
*   Autoclose [true-false] (Optional) (Default false)                                                 *
*   Donetext [true-false] (Optional) (Default true) (If Autoclose is activate, this will not appear)  *
*   Twelvehour [true-false] (Optional) (Default false)                                                *
*   Vibrate [true-false] (Optional) (Default true)                                                    *
*   Fromnow [number] (Optional) (Default 0) (Using with default = 'now')                              *


--}}


@if(!isset($name))@php $name = $id;@endphp @endif



<div id="@if(isset($block_id)){{$block_id}}@endif"
     class="form-group {{ $errors->has($name) ? 'has-error has-feedback' : '' }}   margin-bottom-10   @if(isset($col)) col-md-{{$col}} @endif "
     style="margin-bottom:16px !important;  @if(isset($hidden))display: none @endif">

    @if(isset($label))<label class="control-label {{ $errors->has($name) ? 'state-error' : '' }}">{{ Lang::get($label) }}</label>@endif


    <div class="input-group col-xs-12 col-sm-12 col-md-12 clockpicker"
         @if(isset($default)) data-default="{{$default}}" @endif
         @if(isset($placement)) data-placement="{{$placement}}" @endif
         @if(isset($align)) data-align="{{$align}}" @endif
         @if(isset($autoclose) && $autoclose == true ) data-autoclose="true" @endif
         @if(isset($donetext)) data-donetext="{{$donetext}}" @endif
         @if(isset($twelvehour) && $twelvehour == true ) data-twelvehour="true" @endif
         @if(isset($vibrate) && $vibrate == false ) data-vibrate="false" @endif
         @if(isset($fromnow)) data-fromnow="{{$fromnow}}" @endif
        >



            <input id="{{$id}}" name="{{$name}}" type="text"
                   placeholder="@if(isset($placeholder)){{ Lang::get($placeholder)  }}@else{{isset($label)?Lang::get($label):null}}@endif"
                   class="form-control @if(isset($class)){{$class}}@endif"
                   @if(isset($required) && $required==true) required="required" @endif
                    value="{{ old($name, isset($value)?$value:null) }}"
                   @if(isset($data_attributes))
                   @foreach($data_attributes as $attr_name=>$attr_value)
                   data-{{$attr_name}}="{{$attr_value}}"

                    @endforeach
                    @endif

            >

            @if(isset($icon))<span class="input-group-addon"><i class="{{$icon}}"></i></span>@endif


{{-- <span class="input-group-addon">
            <span class="glyphicon glyphicon-time"></span>
        </span> --}}


    </div>
        <span id="{{$id}}-error" class="help-block has-error">{{ $errors->first($name) }} </span>
</div>
