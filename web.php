<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('login', 'HomeController@login')->name('login');
Route::get('register', 'HomeController@index')->name('register');
Route::get('password/reset/{token}', 'HomeController@index');
Route::get('password/reset', 'HomeController@index')->name('password.request');

Route::group(['prefix' => 'webmaster','middleware' => ['role:superusuario']],  function() {

    // MANAGE PDF
    Route::group(['prefix' => 'reports'], function () {
        Route::get('templates/list-pdf', 'Reports\ReportController@getListPdf')->name('report.templates.pdf');
        Route::post('templates/upload-pdf', 'Reports\ReportController@postUploadPdf')->name('report.templates.upload.pdf');
    });

    //GERENCIA
    Route::group(['prefix' => 'gerencia'],  function() {
        //RESPUESTAS
        Route::group(['prefix' => 'respuesta'],  function() {
            Route::post('crear','Webmaster\Management\ManagementAnswerController@postCreate')->name('management.answer.create');
            Route::post('guardar','Webmaster\Management\ManagementAnswerController@postSave')->name('management.answer.save');
            Route::post('delete','Webmaster\Management\ManagementAnswerController@postDelete')->name('management.answer.delete');
        });
        //GRUPOS DE RESPUESTAS
        Route::group(['prefix' => 'grupo-respuestas'],  function() {
            Route::post('crear','Webmaster\Management\ManagementGroupAnswerController@postCreate')->name('management.groupAnswer.create');
            Route::post('delete','Webmaster\Management\ManagementGroupAnswerController@postDelete')->name('management.group-answer.delete');
            Route::post('set-inclusive','Webmaster\Management\ManagementGroupAnswerController@postSetInclusiveAnswers')->name('management.groupAnswer.set-inclusive');
            Route::post('save-question','Webmaster\Management\ManagementGroupAnswerController@postSaveQuestionText')->name('management.group-answer.question-text');
        });

        Route::get('plantillas','Webmaster\Management\ManagementTemplateController@getTemplates')->name('management.templates');
        Route::get('crear','Webmaster\Management\ManagementTemplateController@getNew')->name('management.new');
        Route::get('{managementTemplate}/editar','Webmaster\Management\ManagementTemplateController@getEdit')->name('management.edit');
        Route::get('{managementTemplate}/data','Webmaster\Management\ManagementTemplateController@getData')->name('management.data');
        Route::get('data','Webmaster\Management\ManagementTemplateController@getDataTable')->name('management.data.table');
        Route::post('{managementTemplate}/delete','Webmaster\Management\ManagementTemplateController@postDelete')->name('management.template.delete');
        Route::post('{managementTemplate}/active','Webmaster\Management\ManagementTemplateController@postActive')->name('management.template.active');
        //BLOQUES
        Route::group(['prefix' => 'bloque'],  function() {
            Route::get('crear','Webmaster\Management\ManagementBlockController@getCreate')->name('management.block.create');
            Route::get('{managementBlock}/edit','Webmaster\Management\ManagementBlockController@getEdit')->name('management.block.edit');
            Route::post('guardar','Webmaster\Management\ManagementBlockController@postSave')->name('management.block.save');
            Route::post('{managementBlock}/delete','Webmaster\Management\ManagementBlockController@postDelete')->name('management.block.delete');
            Route::post('cambiar-orden', 'Webmaster\Management\ManagementBlockController@postChangeOrder')->name('management.block.change.order');
        });
        //PREGUNTAS
        Route::group(['prefix' => 'pregunta'],  function() {
            Route::get('crear','Webmaster\Management\ManagementQuestionController@getCreate')->name('management.question.create');
            Route::get('{managementQuestion}/edit','Webmaster\Management\ManagementQuestionController@getEdit')->name('management.question.edit');
            Route::post('guardar','Webmaster\Management\ManagementQuestionController@postSave')->name('management.question.save');
            Route::post('{managementQuestion}/delete','Webmaster\Management\ManagementQuestionController@postDelete')->name('management.question.delete');
            Route::post('cambiar-orden', 'Webmaster\Management\ManagementQuestionController@postChangeOrder')->name('management.question.change.order');
            //RESPUESTAS
            Route::get('respuestas/{managementQuestion?}','Webmaster\Management\ManagementGroupAnswerController@getManage')->name('management.question.answers');
        });


        // ATRIBUTOS
        Route::group(['prefix' => 'atributos'],  function() {
            Route::get('crear','Webmaster\Management\ManagementAtributeController@getCreate')->name('atribute.create');
            Route::post('guardar','Webmaster\Management\ManagementAtributeController@postSave')->name('atribute.save');
            Route::get('{atribute}/edit','Webmaster\Management\ManagementAtributeController@getEdit')->name('atribute.edit');
            Route::post('{atribute}/delete','Webmaster\Management\ManagementAtributeController@postDelete')->name('atribute.delete');
            Route::get('{atribute}/options','Webmaster\Management\ManagementAtributeController@getManage')->name('atribute.options');
            Route::post('cambiar-orden','Webmaster\Management\ManagementAtributeController@postChangeOrder')->name('atribute.change.order');
            Route::post('/crear-opcion','Webmaster\Management\ManagementAtributeController@postCreateOption')->name('management.atribute.option.create');
            Route::post('/eliminar-opciones','Webmaster\Management\ManagementAtributeController@postDeleteOptions')->name('management.atribute.options.delete');
            Route::post('/guardar-opciones','Webmaster\Management\ManagementAtributeController@postSaveOptions')->name('management.atributo.options.save');
        });
        // IMPACTOS
        Route::group(['prefix' => 'impactos'],  function() {
            Route::post('{managementTemplate}/crear','Webmaster\Management\ImpactController@postCreate')->name('management.impact.create');
            Route::post('guardar','Webmaster\Management\ImpactController@postSave')->name('management.impact.save');
            Route::post('{managementTemplate}/delete','Webmaster\Management\ImpactController@postDelete')->name('management.impact.delete');
        });
        // PROBABILIDADES
        Route::group(['prefix' => 'probabilidades'],  function() {
            Route::post('{managementTemplate}/crear','Webmaster\Management\ProbabilityController@postCreate')->name('management.probability.create');
            Route::post('guardar','Webmaster\Management\ProbabilityController@postSave')->name('management.probability.save');
            Route::post('{managementTemplate}/delete','Webmaster\Management\ProbabilityController@postDelete')->name('management.probability.delete');
        });
        //CÁLCULOS
        Route::group(['prefix' => 'calculos'],  function() {
            Route::post('guardar','Webmaster\Management\CalculationController@postSave')->name('management.calculation.save');
            Route::post('{managementTemplate}/actualizar-todos','Webmaster\Management\CalculationController@postUpdateAll')->name('management.calculation.update-all');
        });
        //CÁLCULOS
        Route::group(['prefix' => 'atributos-automaticos'],  function() {
            Route::post('{managementTemplate}/guardar','Webmaster\Management\ReadOnlyAtributeController@postSave')->name('management.readonly-atribute.save');
        });


    });
    //INSPECCION
    Route::group(['prefix' => 'inspeccion'],  function() {
        Route::get('plantillas','Webmaster\Inspection\InspectionTemplateController@getTemplates')->name('inspection.templates');
        Route::get('crear','Webmaster\Inspection\InspectionTemplateController@getNew')->name('inspection.new');
        Route::get('{inspectionTemplate}/editar','Webmaster\Inspection\InspectionTemplateController@getEdit')->name('inspection.edit');
        Route::get('{inspectionTemplate}/data','Webmaster\Inspection\InspectionTemplateController@getData')->name('inspection.data');
        Route::get('data','Webmaster\Inspection\InspectionTemplateController@getDataTable')->name('inspection.data.table');
        Route::post('{inspectionTemplate}/delete','Webmaster\Inspection\InspectionTemplateController@postDelete')->name('inspection.template.delete');
        Route::post('{inspectionTemplate}/active','Webmaster\Inspection\InspectionTemplateController@postActive')->name('inspection.template.active');

        //BLOQUES
        Route::group(['prefix' => 'bloque'],  function() {
            Route::get('crear','Webmaster\Inspection\InspectionBlockController@getCreate')->name('inspection.block.create');
            Route::get('{inspectionBlock}/edit','Webmaster\Inspection\InspectionBlockController@getEdit')->name('inspection.block.edit');
            Route::post('guardar','Webmaster\Inspection\InspectionBlockController@postSave')->name('inspection.block.save');
            Route::post('{inspectionBlock}/delete','Webmaster\Inspection\InspectionBlockController@postDelete')->name('inspection.block.delete');
            Route::post('cambiar-orden', 'Webmaster\Inspection\InspectionBlockController@postChangeOrder')->name('inspection.block.change.order');
        });
        //PREGUNTAS
        Route::group(['prefix' => 'pregunta'],  function() {
            Route::get('crear','Webmaster\Inspection\InspectionQuestionController@getCreate')->name('inspection.question.create');
            Route::get('{inspectionQuestion}/edit','Webmaster\Inspection\InspectionQuestionController@getEdit')->name('inspection.question.edit');
            Route::post('guardar','Webmaster\Inspection\InspectionQuestionController@postSave')->name('inspection.question.save');
            Route::post('{inspectionQuestion}/delete','Webmaster\Inspection\InspectionQuestionController@postDelete')->name('inspection.question.delete');
            Route::post('cambiar-orden', 'Webmaster\Inspection\InspectionQuestionController@postChangeOrder')->name('inspection.question.change.order');
            //RESPUESTAS
            Route::get('respuestas/{inspectionQuestion?}','Webmaster\Inspection\InspectionQuestionController@getManage')->name('inspection.question.answers');
            Route::post('respuestas/guardar','Webmaster\Inspection\InspectionQuestionController@postSaveAnswers')->name('inspection.question.answers.save');

        });
    });
});

Route::group(['middleware' => ['role:sucursal|director_franquicia|colaborador|oficina_franquiciada|webmaster|superusuario']],  function() {
    //GERENCIA
    Route::group(['prefix' => 'gerencia'],  function() {
        Route::get('{managementForm}/edit', 'Forms\Management\ManagementFormController@getEdit')->name('management.form.edit');
        Route::post('{managementForm}/upload-pdf', 'Forms\Management\ManagementFormController@postUploadPdf')->name('management.form.upload.pdf'); //Subida de Foto de Empresa
        Route::get('{managementForm}/view', 'Forms\Management\ManagementFormController@getView')->name('management.form.view'); //Visualización Del PDF Generado
        Route::post('{managementForm}/impact/{impact}/save', 'Forms\Management\ManagementFormImpactController@postSave')->name('management.form.impact.save');
        Route::post('{managementForm}/atribute/{managementAtribute}/save', 'Forms\Management\ManagementFormAtributeController@postSave')->name('management.form.atribute.save');
        Route::post('{managementForm}/answer/{managementGroupAnswer}/save', 'Forms\Management\ManagementFormAnswerController@postSave')->name('management.form.answer.save');
        Route::post('{managementForm}/answer/{managementGroupAnswer}/impact', 'Forms\Management\ManagementFormAnswerController@postSaveImpact')->name('management.form.answer.impact');
        Route::post('{managementForm}/answer/{managementGroupAnswer}/probability', 'Forms\Management\ManagementFormAnswerController@postSaveProbability')->name('management.form.answer.probability');
        Route::post('{managementForm}/delete-excluded', 'Forms\Management\ManagementFormAnswerController@postDeleteExcluded')->name('management.form.delete-excluded');


        // Link inspection_form
        Route::get('{managementForm}/association-form', 'Forms\Management\ManagementFormController@getAssociationForm')->name('management.form.associate');
        Route::post('{managementForm}/associate/{inspectionForm?}', 'Forms\Management\ManagementFormController@postAssociateInspection')->name('management.asociate-inspection');
        //--
        //Finalize form
        Route::post('{managementForm}/finish', 'Forms\Management\ManagementFormController@postFinish')->name('management.form.finish');
        //Sof delete management
        Route::post('{managemnetForm}/soft-delete-management', 'Forms\Management\ManagementFormController@postSofDelete')->name('management.form.delete'); //Sof delete management
        //Restore Soft deleted management
        Route::post('/restore-management', 'Forms\Management\ManagementFormController@postRestore')->name('management.form.restore');
        //True
        Route::post('/true-delete-management', 'Forms\Management\ManagementFormController@postTrueDelete')->name('management.form.true-delete');

    });

    // INSPECCIÓN
    Route::group(['prefix' => 'inspeccion'],  function() {
        Route::get('{inspectionForm}/edit', 'Forms\Inspection\InspectionFormController@getEdit')->name('inspection.form.edit');
        Route::get('{inspectionForm}/view', 'Forms\Inspection\InspectionFormController@getView')->name('inspection.form.view'); //Visualización Del PDF Generado
        Route::post('{inspectionForm}/question/{inspectionQuestion}/save', 'Forms\Inspection\InspectionFormController@postSave')->name('inspection.form.question.save');
        Route::post('{inspectionForm}/finish', 'Forms\Inspection\InspectionFormController@postFinish')->name('inspection.form.finish');

        //Sof delete management
        Route::post('{inspectionForm}/soft-delete-inspection', 'Forms\Inspection\InspectionFormController@postSofDelete')->name('inspection.form.delete');
        //Restore Soft deleted management
        Route::post('/restore-management', 'Forms\Inspection\InspectionFormController@postRestore')->name('inspection.form.restore');
        //
        Route::post('/true-delete-management', 'Forms\Inspection\InspectionFormController@postTrueDelete')->name('inspection.form.true-delete');

        //HTML pregutnas partials
        Route::get('{inspectionTemplate}/{inspectionForm}/question-partials','Forms\Inspection\InspectionFormController@getQuestionPartial')->name('inspection.question.partials');

        //Get images of inspection
        Route::get('/images/form', 'Forms\Inspection\InspectionFormController@getFileForm')->name('inspection.form.image.form');
        Route::get('/images/{inspectionFormFile}', 'Forms\Inspection\InspectionFormController@getFile')->name('inspection.form.image'); //Get edit form
        Route::post('/images/{inspectionForm}/save', 'Forms\Inspection\InspectionFormController@postSaveFile')->name('inspection.form.image.save'); //Get edit form
    });

    Route::group(['prefix' => 'customerform'], function(){
        Route::get('{customer}/create','Forms\CustomerForm\CustomerFormController@getCreate')->name('customerform.create.get');
        Route::post('{customer}/create','Forms\CustomerForm\CustomerFormController@postCreate')->name('customerform.create.post');
        Route::get('{customer}/preview','Forms\CustomerForm\CustomerFormController@getPreview')->name('customerform.preview');
        Route::get('{customer}/checkManagementForms','Forms\CustomerForm\CustomerFormController@getCheckManagementForms')->name('customerform.check');
        Route::get('{customer}/preview-managements','Forms\CustomerForm\CustomerFormController@getPreviewManagements')->name('customerform.preview.managements');
        Route::get('{customer}/preview-inspections','Forms\CustomerForm\CustomerFormController@getPreviewInspections')->name('customerform.preview.inspections');
    });

    //CLIENTES
    Route::group(['prefix' => 'customers'],  function() {
        Route::get('','Forms\Customers\CustomerController@getList')->name('customer.list');
        Route::get('data','Forms\Customers\CustomerController@getData')->name('customer.data');
        Route::get('{customer}/edit','Forms\Customers\CustomerController@getEdit')->name('customer.edit');
        Route::get('new','Forms\Customers\CustomerController@getNew')->name('customer.new');
        Route::post('{customer}/delete','Forms\Customers\CustomerController@postDelete')->name('customer.delete');
        Route::post('save','Forms\Customers\CustomerController@postSave')->name('customer.save');
        Route::get('customers-of-sucursal','Forms\Customers\CustomerController@getCustomersOfSucursal')->name('customers.of-sucursal');
        Route::get('colaborators-all','Forms\Customers\CustomerController@getAllColaborators')->name('customers.all');

        Route::get('export','Forms\Customers\CustomerController@getExportInformes')->name('customer.export');
    });
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});


Route::get('lang/{locale}',function($locale){
    Session::put('locale',$locale);
    return redirect()->back();
});

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');


Route::get('edit', 'Forms\Management\ManagementFormController@getEdit')->name('empty-inspection');

Route::get('/migrate', function () {
    //$exitCode = \Artisan::call('command:cronCheckPaySubscriptions');
    //$exitCode = \Artisan::call('storage:link');

    $exitCode = \Artisan::call('config:clear');
    $exitCode = \Artisan::call('config:cache');
    $exitCode = \Artisan::call('migrate');
    //$exitCode = \Artisan::call('command:reorganizeInspectionTemplate');

});


Route::resource('inspectionFormFile', 'Forms\Inspection\InspectionFormFileController');
Route::group(['prefix' => 'inspectionFormFile', 'as' => 'inspectionFormFile.'],  function() {
    Route::post('list', 'Forms\Inspection\InspectionFormFileController@list')->name('list');
    Route::post('{inspectionForm}/reorder-files', 'Forms\Inspection\InspectionFormFileController@postReorderFiles')->name('reorder-files');
});



Route::get('/prepare', function () {

    $exitCode = \Artisan::call('storage:link');
    $exitCode = \Artisan::call('config:clear');
    $exitCode = \Artisan::call('cache:clear');

});

