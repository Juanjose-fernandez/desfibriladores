{{--SELECT2---------------------------------*
*----PARAMS---------------------------------*
*   Type (Required)                         *
*   Id (Required)                           *
*   Name (Required)                         *
*   Label (Optional)                        *
*   Require[true-false] (Optional)          *
*   Readonly[true-false] (Optional)         *
*   Disabled[true-false] (Optional)         *
*   Col [1-10] (Optional)                   *
*   Icon (Optional)                         *
*   Class (Optional)                        *
*   Value (Optional)                        *
*   Mask (Optional)                         *
*   Placeholder (Optional)                  *
*   Tooltip (Optional)                      *
*   Align [horizontal-vertical](Optional)   *--}}



@if(isset($aling) && $aling=='horizontal')
    <div @if(isset($id_block))id="{{$id_block}}" @endif class="form-group @if(isset($col)) col-md-{{$col}} @endif {{ $errors->has($name) ? 'has-error' : '' }}" style="margin-bottom: 16px!important;">
        @if(isset($label))<label class="label control-label col-md-2">{{Lang::get($label)}}</label>@endif
        <div class="col-md-10">
            <select data-width="100%" class="selectpicker col-md-12" data-live-search="true" @if(isset($readonly) && $readonly==true)readonly="readonly" @endif @if(isset($disabled) && $disabled==true)disabled="disabled" @endif id="{{$id}}"  class="@if(isset($class)){{$class}}@endif"  @if(isset($required) && $required==true) required="required" @endif  name="{{$name}}" >
                @if(isset($default))<option value="" >{{ $default}}</option>@endif
                @foreach($objects as $object)
                    <option  value="{{ $object->getId() }}" @if(isset($selected_value)  && $selected_value==$object['value']) selected="selected" @endif >{{$object[$display]}}</option>
                @endforeach
            </select>
        </div>
        <span id="{{$id}}-error" class="help-block">{{ $errors->first($name) }}</span>

    </div>
@else
    <div @if(isset($id_block))id="{{$id_block}}" @endif class="form-group margin-bottom-10 @if(isset($col)) col-md-{{$col}} @endif {{ $errors->has($name) ? 'has-error' : '' }}  @if(isset($block_class)) {{$block_class}} @endif" style="margin-bottom: 16px!important;">
        <div class="col-md-12" style="padding:0">
            @if(isset($label))<label  class="control-label  {{ $errors->has($name) ? 'state-error' : '' }}">{{ Lang::get($label) }}</label>@endif
        </div>
        <div class="col-md-12" style="padding:0">
            <select data-width="100%" readonly="readonly" @if(isset($datas)) @foreach($datas as $data => $value) data-{{$data}}="{{$value}}" @endforeach @endif @if(isset($livesearch))data-live-search="true" @endif @if(isset($disabled) && $disabled==true)disabled="disabled" @endif id="{{$id}}"  class="selectpicker @if(isset($class)){{$class}}@endif"  @if(isset($required) && $required==true) required="required" @endif  name="{{$name}}" @if(isset($multiple)) multiple="multiple" @endif >
                @if(isset($default))<option value="">{{ $default}}</option>@endif
                @foreach($objects as $object)
                    @if(isset($selected_value) && is_array($selected_value))
                        <option @if(isset($json_object) && $json_object) data-object="{{json_encode($object)}}"  @endif value="{{ $object[$value] }}" @if(isset($selected_value)  && in_array($object[$value],$selected_value)) selected="selected" @endif >{{$object[$display]}}</option>
                    @else
                        <option @if(isset($json_object) && $json_object) data-object="{{json_encode($object)}}"  @endif value="{{ $object[$value] }}" @if(isset($selected_value)  && $selected_value==$object[$value]) selected="selected" @endif >{{$object[$display]}}</option>
                    @endif

                @endforeach
            </select>
            <span id="{{$id}}-error" class="help-block">{{ $errors->first($name) }}</span>
        </div>

    </div>
@endif

