<?php

namespace App\Http\Controllers;

use App\Client;
use App\Repositories\ClientRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    protected $clientRepo;

    public function __construct(ClientRepo $clientRepo)
    {
        $this->clientRepo = $clientRepo;
    }

    public function index()
    {
        //renderizado de vista listado
        $list = view('site.client.listing')->render();
        return $list;
    }

    public function data(Request $request)
    {
        $models = $this->clientRepo->getClients($request);

        return DataTables::of($models)
            ->addColumn('actions', function ($model) {
                $response = "";
/*                $response .= '<a title="Ver " style="margin:3px;"  href="' . route("admin.client.show", ['client' => $model->getId()]) . '" class="url_imodal btn btn-success btn-circle btn-xs" data-title="Mostrar datos " data-subtitle="" data-ico="" data-width="900"><i class="glyphicon glyphicon-eye-open"></i></a>';*/
                $response .= '<a title="Editar " style="margin:3px;" href="' . route("admin.client.edit", ['client' => $model->getId()]) . '" class="url_imodal btn btn-info btn-circle btn-xs" data-title="Editar datos" data-subtitle="" data-ico="" data-width="900"><i class="glyphicon glyphicon-pencil"></i></a>';
                if ($model->delete_at == null) {
                    $response .= '<a title="Desactivar " style="margin:3px;" data-href="' . route("admin.client.destroy", ['client' => $model->getId()]) . '" class="btn btn-danger btn-circle btn-xs btn-delete text-white" data-title="Desactivar " data-subtitle="" data-ico="" data-width="900" ><i class="glyphicon glyphicon-trash"></i></a>';
                } else {
                    $response .= '<a title="Activar " style="margin:3px;" href="' . route("admin.client.restore", ['client' => $model->getId()]) . '" class="url_imodal btn btn-warning btn-circle btn-xs" data-title="Restaurar " data-subtitle="" data-ico="" data-width="900" ><i class="glyphicon glyphicon-retweet"></i></a>';
                }
                return $response;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create()
    {
        try {
            return view('site.client.create-edit')->render();
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json([
                'title' => __('global.default-error-title'),
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $businessName = $request->input("business_name");
            $address = $request->input("address");
            $postcode = $request->input("postcode");
            $municipality = $request->input("municipality");
            $province = $request->input("province");
            $fiscalCode = $request->input("fiscal_code");
            $phone = $request->input("phone");
            $email = $request->input("email");

            $client = $this->clientRepo->save($businessName, $address, $postcode, $municipality, $province, $fiscalCode, $phone, $email);
            DB::commit();

            return response()->json(['title' => __('global.default-success-title'),
                'message' => __('global.default-success-msg'),
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'title' => __('global.default-error-title'),
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    public function show(Client $client)
    {
        try {
            $model = $client;
            if ($model == null) {
                throw new Exception(__('error_manual_exeption'));
            }
            $model = $model->toArray();
            return view('crud.see', compact('model'))->render();
        } catch (\Throwable $exception) {
            $error_msg = $exception->getMessage();
            return view('errors.error-modal', compact('error_msg'))->render();
        }

    }

    public function edit(Client $client)
    {
        try {

            return view('site.client.create-edit', compact('client'))->render();

        } catch (\Throwable $exception) {
            $error_msg = $exception->getMessage();
            return view('errors.error-modal', compact('error_msg'))->render();
        }
    }

    public function update(Request $request, Client $client)
    {
        $businessName = $request->input("business_name");
        $address = $request->input("address");
        $postcode = $request->input("postcode");
        $municipality = $request->input("municipality");
        $province = $request->input("province");
        $fiscalCode = $request->input("fiscal_code");
        $phone = $request->input("phone");
        $email = $request->input("email");


        $client = $this->clientRepo->save($businessName, $address, $postcode, $municipality, $province, $fiscalCode, $phone, $email, $client);

        return response()->json($client, 200);
    }


    public function destroy(Client $client)
    {
        try {
            $this->clientRepo->delete($client);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                'title' => __('global.default-error-title'),
                'message' => $e->getMessage(),
                'status' => 'failed'
            ], 404);

        }

        return response(['title' => Lang::get('global.success'), 'message' => Lang::get('Usuario eliminado correctamente')], 200);
    }

}
