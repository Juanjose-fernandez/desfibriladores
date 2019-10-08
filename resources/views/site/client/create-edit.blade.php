
<div class="well">
    <form id="create_user_form" class="" novalidate="novalidate" method="post"  action="{{isset($client) ?route('admin.client.update',['id'=>$client->getId()]) : route('admin.client.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}

        @if(isset($client))
            <input type="hidden" name="_method" value="put"/>
        @endif


        <fieldset>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @include('global.input-b',
                            ['type'=>'text',
                            'id'=>'business_name',
                            'label'=>__('Razón Social'),
                            'name'=>'business_name',
                            'required'=>true,
                            'col'=>'6','value'=>isset($client)  ? $client->getBusinessName() : null
                            ]
                        )

                        @include('global.input-b',
                          ['type'=>'text',
                          'id'=>'municipality',
                          'label'=>__('Municipio'),
                          'name'=>'municipality',
                          'required'=>false,
                          'col'=>'6','value'=>isset($client)  ? $client->getMunicipality() : null
                          ]
                      )

                      @include('global.input-b',
                          ['type'=>'text',
                          'id'=>'province',
                          'label'=>__('Provincia'),
                          'name'=>'province',
                          'required'=>false,
                          'col'=>'6','value'=>isset($client)  ? $client->getProvince() : null
                          ]
                      )

                      @include('global.input-b',
                          ['type'=>'text',
                          'id'=>'address',
                          'label'=>__('Dirección'),
                          'name'=>'address',
                          'required'=>false,
                          'col'=>'6','value'=>isset($client)  ? $client->getAddress() : null
                          ]
                      )
                      @include('global.input-b',
                          ['type'=>'number',
                          'id'=>'postcode',
                          'label'=>__('Código postal'),
                          'name'=>'postcode',
                          'required'=>false,
                          'col'=>'6','value'=>isset($client)  ? $client->getPostcode() : null
                          ]
                      )

                        @include('global.input-b',
                            ['type'=>'text',
                            'id'=>'fiscal_code',
                            'label'=>__('Código fistal'),
                            'name'=>'fiscal_code',
                            'required'=>false,
                            'col'=>'6','value'=>isset($client)  ? $client->getFiscalCode() : null
                            ]
                        )

                        @include('global.input-b',
                            ['type'=>'text',
                            'id'=>'phone',
                            'label'=>__('Teléfono'),
                            'name'=>'phone',
                            'required'=>false,
                            'col'=>'6','value'=>isset($client)  ? $client->getPhone() : null
                            ]
                        )

                        @include('global.input-b',
                            ['type'=>'email',
                            'id'=>'email',
                            'label'=>__('Email'),
                            'name'=>'email',
                            'required'=>false,
                            'col'=>'6','value'=>isset($client)  ? $client->getEmail() : null
                            ]
                        )



                    </div>

            </div>



        </fieldset>

        <footer>
            <button type="submit" id="btn-save-client" class="btn btn-success btn-block ">{{Lang::get('Guardar')}}</button>
        </footer>

    </form>
</div>



<!-- SELECT PICKER -->
<script src="{{URL::to('js/plugin/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{URL::to('js/global/alerts.js')}}"></script>

<script type="text/javascript">


    // Form validation
    $('#create_user_form').validate({
        lang: 'ES',
        submitHandler: function(){

            var url = $('#create_user_form').prop('action');

            $.post( url, $( "#create_user_form" ).serialize() ).done(function(response){
                $('#modal').iziModal('close');
                oClientTable.draw();
            });
        }

    });




</script>

