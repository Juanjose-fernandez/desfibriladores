@if (count($errors->all()) > 0)

    <div class="alert alert-danger fade in">
        <button class="close" data-dismiss="alert">
            ×
        </button>
        <i class="fa-fw fa fa-times"></i>
        <strong>{{Lang::get('global.error')}}</strong> {{Lang::get('global.errors.form')}}
    </div>
@endif


@if ($message = Session::get('success'))

    <div class="alert alert-success fade in">
        <button class="close" data-dismiss="alert">
            ×
        </button>
        <i class="fa-fw fa fa-check"></i>
        <strong>{{Lang::get('global.success')}}</strong>
        @if(is_array($message))
            <ul>
            @foreach ($message as $m)
                <li>{{ Lang::get($m) }}</li>
            @endforeach
            </ul>
        @else
            {{ Lang::get($message) }}
        @endif
    </div>
@endif



@if ($message = Session::get('error'))
    <div class="alert alert-danger fade in">
        <button class="close" data-dismiss="alert">
            ×
        </button>
        <i class="fa-fw fa fa-times"></i>
        <strong>{{Lang::get('global.error')}}</strong>
        @if(is_array($message))
            <ul>
                @foreach ($message as $m)
                    <li>{{ Lang::get($m) }}</li>
                @endforeach
            </ul>
        @else
            {{ Lang::get($message) }}
        @endif
    </div>


@endif



@if ($message = Session::get('warning'))
    <div class="alert alert-warning fade in">
        <button class="close" data-dismiss="alert">
            ×
        </button>
        <i class="fa-fw fa fa-warning"></i>
        <strong>{{Lang::get('global.warning')}}</strong>
        @if(is_array($message))
            <ul>
                @foreach ($message as $m)
                    <li>{{ Lang::get($m) }}</li>
                @endforeach
            </ul>
        @else
            {{ Lang::get($message) }}
        @endif
    </div>

@endif



@if ($message = Session::get('info'))
    <div class="alert alert-info fade in">
        <button class="close" data-dismiss="alert">
            ×
        </button>
        <i class="fa-fw fa fa-info"></i>
        <strong>{{Lang::get('global.info')}}</strong>
        @if(is_array($message))
            <ul>
                @foreach ($message as $m)
                    <li>{{ Lang::get($m) }}</li>
                @endforeach
            </ul>
        @else
            {{ Lang::get($message) }}
        @endif
    </div>

@endif