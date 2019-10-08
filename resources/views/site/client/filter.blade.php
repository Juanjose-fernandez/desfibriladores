
<form id="client-filter-form" class="" novalidate="novalidate">

    {{ method_field('put') }}
    <legend >
        {{__('Filtros')}}
        <button type="button" class="btn btn-default" data-toggle="collapse" data-target=".users-fieldset" aria-expanded="false">
            <i class="fa fa-search"></i>
        </button>
    </legend>

    <fieldset class="users-fieldset collapse">
        <div class="row m-t-20">
            @include('global.input-b',[
                'type' => 'number',
                'aling' => 'horizontal',
                'id' => 'filter_id',
                'name' => 'filter_id',
                'label' => null,
                'placeholder' => __('ID'),
                'readOnly' => false,
                'disabled' => false,
                'icon' => null,
                'col' => 3,
                'value' => '',
                'default' => null,
                'display' => null,
                'selected_value' => null,
                'multiple' => null,
                'objects' => null,
            ])

            @include('global.input-b',[
                'type' => 'text',
                'aling' => 'horizontal',
                'id' => 'filter_business_name',
                'name' => 'filter_business_name',
                'label' => null,
                'placeholder' => __('Razón Social'),
                'readOnly' => false,
                'disabled' => false,
                'icon' => null,
                'col' => 3,
                'value' => '',
                'default' => null,
                'display' => null,
                'selected_value' => null,
                'multiple' => null,
                'objects' => null,
            ])
            @include('global.input-b',[
                'type' => 'text',
                'aling' => 'horizontal',
                'id' => 'filter_address',
                'name' => 'filter_address',
                'label' => null,
                'placeholder' => __('Dirección'),
                'readOnly' => false,
                'disabled' => false,
                'icon' => null,
                'col' => 3,
                'value' => '',
                'default' => null,
                'display' => null,
                'selected_value' => null,
                'multiple' => null,
                'objects' => null,
            ])
            @include('global.input-b',[
                'type' => 'text',
                'aling' => 'horizontal',
                'id' => 'filter_municipality',
                'name' => 'filter_municipality',
                'label' => null,
                'placeholder' => __('Municipio'),
                'readOnly' => false,
                'disabled' => false,
                'icon' => null,
                'col' => 3,
                'value' => '',
                'default' => null,
                'display' => null,
                'selected_value' => null,
                'multiple' => null,
                'objects' => null,
            ])
            @include('global.input-b',[
                'type' => 'text',
                'aling' => 'horizontal',
                'id' => 'filter_province',
                'name' => 'filter_province',
                'label' => null,
                'placeholder' => __('Provincia'),
                'readOnly' => false,
                'disabled' => false,
                'icon' => null,
                'col' => 3,
                'value' => '',
                'default' => null,
                'display' => null,
                'selected_value' => null,
                'multiple' => null,
                'objects' => null,
            ])
            @include('global.input-b',[
                'type' => 'text',
                'aling' => 'horizontal',
                'id' => 'filter_postcode',
                'name' => 'filter_postcode',
                'label' => null,
                'placeholder' => __('Código postal'),
                'readOnly' => false,
                'disabled' => false,
                'icon' => null,
                'col' => 3,
                'value' => '',
                'default' => null,
                'display' => null,
                'selected_value' => null,
                'multiple' => null,
                'objects' => null,
            ])
            @include('global.input-b',[
                'type' => 'text',
                'aling' => 'horizontal',
                'id' => 'filter_email',
                'name' => 'filter_email',
                'label' => null,
                'placeholder' => __('Email'),
                'readOnly' => false,
                'disabled' => false,
                'icon' => null,
                'col' => 3,
                'value' => '',
                'default' => null,
                'display' => null,
                'selected_value' => null,
                'multiple' => null,
                'objects' => null,
            ])


        </div>
    </fieldset>

</form>



