@if ($breadcrumbs)

    @if(is_array($breadcrumbs))
        <ol class="breadcrumb" style="padding-right: 5px!important;">
        @foreach ($breadcrumbs as $breadcrumb)
                <li>{{Lang::get($breadcrumb)}}</li>
        @endforeach
        </ol>
    @endif


@endif