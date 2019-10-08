{{--INPUT TYPE TEXT-------------------------*
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
@if($type=='text')
    @if(isset($aling) && $aling=='horizontal')
        <section class="@if(isset($col))col col-{{$col}} @endif">
            @if(isset($label))<label class="label col col-2 text-right">{{ Lang::get($label) }}</label>@endif
            <section class="col col-10 ">
                <label class="input {{ $errors->has($name) ? 'state-error' : '' }} @if(isset($disabled) && $disabled==true)state-disabled @endif">  @if(isset($icon))<i class="icon-append {{$icon}}"></i>@endif
                    <input @if(isset($readonly) && $readonly==true)readonly="readonly" @endif @if(isset($disabled) && $disabled==true)disabled="disabled" @endif id="{{$id}}"  class="@if(isset($class)){{$class}}@endif"  @if(isset($required) && $required==true) required="required" @endif type="text" name="{{$name}}" placeholder="@if(isset($placeholder)){{{ Lang::get($placeholder)  }}}@else{{isset($label)?Lang::get($label):null}}@endif" value="{{ old($name, isset($value)?$value:null) }}" @if(isset($mask)))data-mask="{{$mask}}" @endif>
                    @if(isset($tooltip))<b class="tooltip tooltip-bottom-right">{{Lang::get($tooltip)}}</b> @endif
                </label>
                <em id="{{$id}}-error" class="invalid">{{ $errors->first($name) }}</em>

            </section>
        </section>
    @else
        <section class="@if(isset($col))col col-{{$col}} @endif">
            @if(isset($label))<label class="label">{{ Lang::get($label) }}</label>@endif
            <label class="input {{ $errors->has($name) ? 'state-error' : '' }} @if(isset($disabled) && $disabled==true)state-disabled @endif">  @if(isset($icon))<i class="icon-append {{$icon}}"></i>@endif
                <input @if(isset($readonly) && $readonly==true)readonly="readonly" @endif @if(isset($disabled) && $disabled==true)disabled="disabled" @endif id="{{$id}}"  class="@if(isset($class)){{$class}}@endif"  @if(isset($required) && $required==true) required="required" @endif type="text" name="{{$name}}" placeholder="@if(isset($placeholder)){{{ Lang::get($placeholder)  }}}@else{{isset($label)?Lang::get($label):null}}@endif" value="{{ old($name, isset($value)?$value:null) }}" @if(isset($mask)))data-mask="{{$mask}}" @endif>
                @if(isset($tooltip))<b class="tooltip tooltip-bottom-right">{{Lang::get($tooltip)}}</b> @endif
            </label>
                <em id="{{$id}}-error" class="invalid">{{ $errors->first($name) }}</em>
        </section>
    @endif
@endif

{{--INPUT TYPE PASSWORD-------------------------*
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
@if($type=='password')
    @if(isset($aling) && $aling=='horizontal')
        <section class="@if(isset($col))col col-{{$col}} @endif">
            @if(isset($label))<label class="label col col-2 text-right">{{ Lang::get($label) }}</label>@endif
            <section class="col col-10 ">
                <label class="input {{ $errors->has($name) ? 'state-error' : '' }} @if(isset($disabled) && $disabled==true)state-disabled @endif">  @if(isset($icon))<i class="icon-append {{$icon}}"></i>@endif
                    <input @if(isset($readonly) && $readonly==true)readonly="readonly" @endif @if(isset($disabled) && $disabled==true)disabled="disabled" @endif id="{{$id}}"  class="@if(isset($class)){{$class}}@endif"  @if(isset($required) && $required==true) required="required" @endif type="password" name="{{$name}}" placeholder="@if(isset($placeholder)){{{ Lang::get($placeholder)  }}}@else{{isset($label)?Lang::get($label):null}}@endif" value="{{ old($name, isset($value)?$value:null) }}" @if(isset($mask)))data-mask="{{$mask}}" @endif>
                    @if(isset($tooltip))<b class="tooltip tooltip-bottom-right">{{Lang::get($tooltip)}}</b> @endif
                </label>
                <em id="{{$id}}-error" class="invalid">{{ $errors->first($name) }}</em>

            </section>
        </section>
    @else
        <section class="@if(isset($col))col col-{{$col}} @endif">
            @if(isset($label))<label class="label">{{ Lang::get($label) }}</label>@endif
            <label class="input {{ $errors->has($name) ? 'state-error' : '' }} @if(isset($disabled) && $disabled==true)state-disabled @endif">  @if(isset($icon))<i class="icon-append {{$icon}}"></i>@endif
                <input @if(isset($readonly) && $readonly==true)readonly="readonly" @endif @if(isset($disabled) && $disabled==true)disabled="disabled" @endif id="{{$id}}"  class="@if(isset($class)){{$class}}@endif"  @if(isset($required) && $required==true) required="required" @endif type="password" name="{{$name}}" placeholder="@if(isset($placeholder)){{{ Lang::get($placeholder)  }}}@else{{isset($label)?Lang::get($label):null}}@endif" value="{{ old($name, isset($value)?$value:null) }}" @if(isset($mask)))data-mask="{{$mask}}" @endif>
                @if(isset($tooltip))<b class="tooltip tooltip-bottom-right">{{Lang::get($tooltip)}}</b> @endif
            </label>
            <em id="{{$id}}-error" class="invalid">{{ $errors->first($name) }}</em>
        </section>
    @endif
@endif

{{--INPUT TYPE CHECKBOX-------------------------*
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
@if($type=='checkbox')
    @if(isset($aling) && $aling=='horizontal')

    @else

    @endif
@endif
