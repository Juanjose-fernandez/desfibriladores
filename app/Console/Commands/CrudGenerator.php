<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generator
    {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD operations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $columns = $this->getTableColumns($this->camelToUnderscore($name, '_', true));
        $this->controller($name, $columns);
        $this->model($name, $columns);
        $this->request($name);
        $this->repo($name);
        $this->policy($name);
        $this->views($name, $columns);


//        File::append(base_path('routes/api.php'), 'Route::resource(\'' . Str::plural(strtolower($name)) . "', '{$name}Controller');");

        File::append(base_path('routes/web.php'),
            'Route::group([\'prefix\' => \''. Str::camel($name).'\'  ,\'as\'=>\''.Str::camel($name).'.\'],  function() {
    Route::get(\'/data\', \''.$name.'Controller@data\')->name(\'data\');
});
Route::resource(\''.Str::camel($name).'\',\''.$name.'Controller\');
');
    }

    protected function views($name, $columns)
    {
        $this->filter($name, $columns);
        $this->listing($name, $columns);
        $this->list($name, $columns);
        $this->view($name, $columns);
        $this->createAndEdit($name, $columns);
    }
    protected function policy($name){
        $modelTemplate = str_replace(
            [
                '{{$model_name}}',
                '{{$model_name_camel}}',
            ],
            [
                $name,
                Str::camel($name),
            ],
            $this->getStub('Policy')
        );

        if (!file_exists(app_path("/Policies"))) {
            mkdir(app_path("/Policies"));
        }
        file_put_contents(app_path("/Policies/{$name}Policy.php"), $modelTemplate);
    }
    protected function filter($name, $columns)
    {
//
        $imputs = '';
        $filter_columns = $this->getTableColumnAndTypeList($this->camelToUnderscore($name, '_', true));
        foreach ($filter_columns as $key => $item) {
            if (strpos($item, 'unsigned') != false) {
                $imputs .= " 
            @include('global.input-b',[
               'type'=>'selectpicker',
                'label_aling'=>'',
                'class'=>null,
                'col'=>'3',
                'label'=>null,
                'name'=>'filter_$key',
                'id'=>'filter_$key',
                'placeholder'=>__('headers.$key'),
                'readOnly'=>false,
                'disabled'=>false,
                'icon'=>null,
                'value'=>'id',
                'display'=>'$key',
                'default'=>'seleccione...$key',
                'selected_value'=>null,
                'multiple'=>false,
                'objects'=>[],
            ])";
            }
            if (strpos($item, 'char') != false) {
                $imputs .= " 
            @include('global.input-b',[
                'type' => 'text',
                'aling' => 'horizontal',
                'id' => 'filter_$key',
                'name' => 'filter_$key',
                'label' => null,
                'placeholder' => __('headers.$key'),
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
            ])";
            }
            if (strpos($item, 'imes') != false) {
                $imputs .= " 
            @include('global.input-b',[
                'type'=>'datepicker',
                'label_aling'=>'horizontal',
                'class'=>null,
                'col'=>'3',
                'label'=>null,
                'name'=>'filter_$key',
                'id'=>'filter_$key',
                'placeholder'=>'Fecha de $key',
                'readOnly'=>false,
                'disabled'=>false,
                'icon'=>null,
                'value'=>null,
                'display'=>null,
                'default'=>null,
                'selected_value'=>[],
                'multiple'=>false,
                'objects'=>(object)array()
            ])";
            }
        }


        $modelTemplate = str_replace(
            [
                '{{$model_name}}',
                '{{$imputs}}',
                '{{$model_name_camel}}',
            ],
            [
                $name,
                $imputs,
                Str::camel($name),
            ],
            $this->getStub('Filter')
        );

        $name = Str::camel($name);
        if (!file_exists(resource_path("views/site/{$name}"))) {
            mkdir(resource_path("views/site/{$name}"));
        }
        file_put_contents(resource_path("views/site/{$name}/filter.blade.php"), $modelTemplate);
    }

    protected function listing($name, $columns)    {
        $imputs = '';
        $filter_columns = $this->getTableColumnAndTypeList($this->camelToUnderscore($name, '_', true));
        $return_filter = '';

        foreach ($filter_columns as $key => $item) {
            $return_filter.="d.filter_".$key."=$('#filter_".$key."').val();";
            if (strpos($item, 'unsigned') != false) {
                $imputs .= " 
             $('#filter_$key').on( 'change', function () {
                o".$name."Table.draw();
             });";
            }
            if (strpos($item, 'char') != false) {
                $imputs .= " 
              $('#filter_$key').on( 'keyup', function () {
                o".$name."Table.draw();
            });";
            }
            if (strpos($item, 'imes') != false) {
                $imputs .= " 
            $('#filter_$key').on( 'dp.change', function () {
                o".$name."Table.draw();
            });";
            }
        }
        //btn-search
        $imputs =" $('#btn_".Str::camel($name)."_search').on( 'click', function (event) {
            event.preventDefault();
                o".$name."Table.draw();
            });";

        //comentar par añadir eventos sobre los filtros.
//        $imputs = "";


        $modelTemplate = str_replace(
            [
                '{{$model_name}}',
                '{{$model_name_camel}}',
                '{{$filter_actions}}',
                '{{$return_filter}}'

            ],
            [
                $name,
                Str::camel($name),
                $imputs,
                $return_filter,

            ],
            $this->getStub('Listing')
        );

        if (!file_exists(resource_path("views/site/{$name}"))) {
            mkdir(resource_path("views/site/{$name}"));
        }
        file_put_contents(resource_path("views/site/{$name}/listing.blade.php"), $modelTemplate);
    }

    protected function list($name, $columns)
    {
        $modelTemplate = str_replace(
            [
                '{{$model_name}}',
                '{{$model_name_camel}}',

            ],
            [
                $name,
                Str::camel($name),

            ],
            $this->getStub('List')
        );

        if (!file_exists(resource_path("views/site/{$name}"))) {
            mkdir(resource_path("views/site/{$name}"));
        }
        file_put_contents(resource_path("views/site/{$name}/list.blade.php"), $modelTemplate);
    }

    protected function view($name, $columns)
    {
        $modelTemplate = str_replace(
            [
                '{{$model_name}}',

            ],
            [
                $name,

            ],
            $this->getStub('View')
        );

        if (!file_exists(resource_path("views/site/{$name}"))) {
            mkdir(resource_path("views/site/{$name}"));
        }
        file_put_contents(resource_path("views/site/{$name}/view.blade.php"), $modelTemplate);
    }

    protected function createAndEdit($name, $columns)
    {

        $name = Str::camel($name);
        $imputs = '';
        $filter_columns = $this->getTableColumnAndTypeList($this->camelToUnderscore($name, '_', true));
        foreach ($filter_columns as $key => $item) {
            if(in_array($key,['id','created_at','updated_at','deleted_at','email_verified_at'])){
                continue;
            }
            if (strpos($item, 'unsigned') != false) {
                $imputs .= " 
            @include('global.input-b',[
               'type'=>'selectpicker',
                'label_aling'=>'',
                'class'=>null,
                'col'=>'3',
                'label'=>null,
                'name'=>'filter_$key',
                'id'=>'filter_$key',
                'placeholder'=>__('headers.$key'),
                'readOnly'=>false,
                'disabled'=>false,
                'icon'=>null,
                'value'=>'id',
                'display'=>'$key',
                'default'=>'seleccione...$key',
                'selected_value'=>null,
                'multiple'=>false,
                'objects'=>[],
            ])";
            }
            if (strpos($item, 'char') != false) {
                $imputs .= " 
            @include('global.input-b',[
                'type' => 'text',
                'aling' => 'horizontal',
                'id' => 'filter_$key',
                'name' => 'filter_$key',
                'label' => null,
                'placeholder' => __('headers.$key'),
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
            ])";
            }
            if (strpos($item, 'imes') != false) {
                $imputs .= " 
            @include('global.input-b',[
                'type'=>'datepicker',
                'label_aling'=>'horizontal',
                'class'=>null,
                'col'=>'3',
                'label'=>null,
                'name'=>'filter_$key',
                'id'=>'filter_$key',
                'placeholder'=>'Fecha de $key',
                'readOnly'=>false,
                'disabled'=>false,
                'icon'=>null,
                'value'=>null,
                'display'=>null,
                'default'=>null,
                'selected_value'=>[],
                'multiple'=>false,
                'objects'=>(object)array()
            ])";
            }
        }
        $modelTemplate = str_replace(
            [
                '{{$model_name}}',
                '{{$imputs}}'
            ],
            [
                $name,
                $imputs
            ],
            $this->getStub('Createandedit')
        );

        if (!file_exists(resource_path("views/site/{$name}"))) {
            mkdir(resource_path("views/site/{$name}"));
        }
        file_put_contents(resource_path("views/site/{$name}/create-edit.blade.php"), $modelTemplate);

    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function model($name, $columns = array())
    {
        $fillable = $this->doFillable($columns);
        $gettersAndSetters = $this->doGettersAndSetters($columns);

        $modelTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{gettersAndSetters}}',
                '{{fillable}}'
            ],
            [
                $name,
                $this->camelToUnderscore($name, '_', true),
                $gettersAndSetters,
                $fillable
            ],
            $this->getStub('Model')
        );

        file_put_contents(app_path("/{$name}.php"), $modelTemplate);
    }

    protected function controller($name, $columns = array())
    {
        $requests = $this->doRequests($columns);
        $stringRequests = $this->doStringRequests($columns);

        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{requests}}',
                '{{stringRequests}}'
            ],
            [
                $name,
                $this->camelToUnderscore($name, '_', true),
                Str::camel($name),
                $requests,
                $stringRequests
            ],
            $this->getStub('Controller')
        );

        file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
    }

    protected function request($name)
    {
        $requestTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Request')
        );

        if (!file_exists($path = app_path('/Http/Requests')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Requests/{$name}Request.php"), $requestTemplate);
    }

    protected function repo($name)
    {
        $columns = $this->getTableColumns($this->camelToUnderscore($name, '_', true));
        $setters = $this->doSetterToObject($columns, $name);
        $stringRequests = $this->doStringRequests($columns);

        $repoTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNameSingularLowerCase}}',
                '{{setters}}',
                '{{stringRequests}}'
            ],
            [
                $name,
                Str::camel($name),
                $setters,
                $stringRequests
            ],
            $this->getStub('Repo')
        );

        if (!file_exists($path = app_path('/Repositories')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Repositories/{$name}Repo.php"), $repoTemplate);
    }

    protected function getTableColumns($table)
    {
        return DB::getSchemaBuilder()->getColumnListing(Str::plural(strtolower($table)));
    }

    static function getTableColumnAndTypeList($tableName)
    {
        $fieldAndTypeList = [];
        foreach (DB::select("describe $tableName") as $field) {
            $fieldAndTypeList[$field->Field] = $field->Type;
        }
        return $fieldAndTypeList;
    }


    protected function doRequests($columns)
    {
        $requests = '';
        $columns = array_diff($columns, $this->excludeColumns());
        foreach ($columns as $column) {
            $camelColumn = Str::camel($column);
            $requests .= '$' . $camelColumn . ' = $request->input("' . $column . '");';
            $requests .= "\n";
            $requests .= "\t\t";
        }

        return $requests;
    }

    protected function doStringRequests($columns)
    {
        $stringRequests = '';
        $columns = array_diff($columns, $this->excludeColumns());
        foreach ($columns as $column) {
            $camelColumn = Str::camel($column);
            if (end($columns) == $column) {
                $stringRequests .= '$' . $camelColumn;
            } else {
                $stringRequests .= '$' . $camelColumn . ', ';
            }
        }

        return $stringRequests;
    }

    protected function doGettersAndSetters(array $columns)
    {
        $gettersAndSetters = "\n";
        foreach ($columns as $column) {
            $camelColumn = $this->camelString($column);
            $gettersAndSetters .= "\t" . 'public function get' . ucfirst($camelColumn) . '() {' . "\n" .
                "\t\t" . 'return $this->' . $column . ';' . "\n" .
                "\t" . '}';
            $gettersAndSetters .= "\n\n";
            $gettersAndSetters .= "\t" . 'public function set' . ucfirst($camelColumn) . '($' . $camelColumn . ') {' . "\n" .
                "\t\t" . '$this->' . $column . ' = $' . $camelColumn . ';' . "\n" .
                "\t" . '}';
            $gettersAndSetters .= "\n\n";
        }

        return $gettersAndSetters;
    }

    protected function doFillable($columns)
    {
        return "'" . implode("', '", $columns) . "'";
    }

    protected function doSetterToObject($columns, $name)
    {

        $columns = array_diff($columns, $this->excludeColumns());
        $setters = "\n\t\t";

        foreach ($columns as $column) {
            $camelColumn = Str::camel($column);
            $setters .= '$' . Str::camel($name) . '->set' . ucfirst($camelColumn) . '($' . $camelColumn . ');';
            $setters .= "\n\t\t";
        }

        return $setters;
    }

    protected function excludeColumns()
    {

        $excludedColumns = ['id', 'created_at', 'updated_at'];

        return $excludedColumns;
    }

    protected function camelString($column)
    {
        return Str::camel($column);
    }

    protected function camelToUnderscore($string, $us = "_", $plural)
    {
        if ($plural) {
            $result = Str::plural(strtolower(preg_replace(
                '/(?<=\d)(?=[A-Za-z])|(?<=[A-Za-z])(?=\d)|(?<=[a-z])(?=[A-Z])/', $us, $string)));
        } else {
            $result = strtolower(preg_replace(
                '/(?<=\d)(?=[A-Za-z])|(?<=[A-Za-z])(?=\d)|(?<=[a-z])(?=[A-Z])/', $us, $string));
        }

        return $result;
    }
}
