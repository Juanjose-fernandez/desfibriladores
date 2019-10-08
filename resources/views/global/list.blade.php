<table id="{{$id}}" class="table table-responsive table-striped table-bordered table-hover @if(isset($class)){{$class}}@endif" width="100%">
    <thead>
    <tr>
        @foreach($columns as $column)
            <th>{{ Lang::get($column) }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody></tbody>
    @if(isset($tfoot) && $tfoot==true)
        <tfoot>
        <tr>
            @foreach($columns as $column)
                <th>{{ Lang::get($column) }}</th>
            @endforeach
        </tr>
        </tfoot>
    @endif
</table>
