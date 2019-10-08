<?php

namespace App\Http\Controllers\User;


use App\Http\Requests\saveUser;
use App\User;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

use Illuminate\Validation\Rule;
use Validator;
use Spatie\Permission\Models\Role;
use DataTables;


class UserController extends Controller{

    protected $userRepo;

   public function __construct( UserRepo $userRepo){
        $this->userRepo       = $userRepo;
    }

   public function getList(){
       $roles = \App\Role::all();
       return \view('site.users.listing',compact('roles'));
   }


    public function index(Request $request){
        $users= $this->userRepo->selectDataTable($request);
        return Datatables::of($users)
            ->setRowClass(function ($user) {
                return $user->trashed() ?  'bg-danger' : '';
            })
            ->editColumn('actions', function ($user) {

                $cadena = ' <a
                                href="'.route('admin.user.edit',['user'=>$user->id ]).'" 
                                data-title="Editar Usuario"
                                title="Editar Usuario"
                                data-ico="fa fa-edit" class="url_imodal btn btn-info btn-circle btn-xs m-r-5" ><i class="glyphicon glyphicon-edit"></i>
                            </a>';


                if($user->trashed()){
                    $cadena.= '<a  title="Restaurar Usuario"                  
                                   data-href="'.route('admin.user.restore',['user'=>$user->id]).'" 
                                    data-user-id="'.$user->id.'" 
                                   class="btn-restore btn-success btn btn-success btn-circle btn-xs m-r-5" ><i class="fa  fa-magic"></i>
                               </a>';
                }else{
                    $cadena.= '<a  title="Eliminar Usuario"
                                   data-href="'.route('admin.user.destroy',['user'=>$user->id]).'" 
                                   data-user-id="'.$user->id.'" 
                                   class=" btn-delete btn btn-danger btn-circle btn-xs m-r-5" ><i class="glyphicon glyphicon-trash"></i>
                               </a>';
                }

                return $cadena;

            })

            ->editColumn('active', function ($user) {
                return $user->active ? '<span class="label label-success">Activo</span>': '<span class="label label-danger">Inactivo</span>';
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('d/m/Y H:i:s');
            })
            ->rawColumns(['confirmed','actions','role','active',])
            ->make(true);

    }


    public function edit(User $user){
        $roles=Role::all();
        return \View::make('site.users.create-edit',compact('user','roles'));
    }



    public function update(SaveUser $request,User $user)
    {
        try{
            DB::beginTransaction();
            $role_id = $request->input('role_id');
            $user->syncRoles([$role_id]);
            $user->update($request->all());
            $user->save();
            DB::commit();

        }catch(\Throwable $e){
            DB::rollback();
            return response()->json([
                'title' => __('global.default-error-title'),
                'message' => $e->getMessage(),
                'status' => 'failed'
            ],404);
        }

        return response()->json(['title' => __('global.default-success-title'),
            'message' => __('global.default-success-msg'),
        ]);
        
    }





    public function create(){

        $roles=Role::all();
        return \View::make('site.users.create-edit',compact('roles'));
    }

    public function store(SaveUser $request)
    {
        try{
            DB::beginTransaction();

            $user = $this->userRepo->create($request->all());
            $user->save();
            $role_id = $request->input('role_id');
            $user->syncRoles([$role_id]);
            $user->sendEmailVerificationNotification();
            DB::commit();

        }catch(\Throwable $e){
            DB::rollback();
            return response()->json([
                'title' => __('global.default-error-title'),
                'message' => $e->getMessage(),
                'status' => 'failed'
            ],404);
        }

        return response()->json(['title' => __('global.default-success-title'),
            'message' => __('global.default-success-msg'),
        ]);
    }


   public function destroy(User $user)
   {
        try {
            $this->userRepo->delete($user);
        }
        catch (\Throwable $e)
        {
            DB::rollback();
            return response()->json([
                'title' => __('global.default-error-title'),
                'message' => $e->getMessage(),
                'status' => 'failed'
            ],404);

        }

       return response(['title' => Lang::get('global.success'), 'message' => Lang::get('Usuario eliminado correctamente')],200);
   }



    public function restore(Request $request){
        try{

            $user =  User::where('id','=',$request->input('user_id'))->withTrashed()->first();
            $user->restore();
        }catch (\Throwable $e){
            Log::error($e);

            return[
                'status' => 'error',
                'title' => __('Error'),
                'message' => $e->getMessage()
            ];
        }
        return response(['title' => Lang::get('global.success'), 'message' =>'Usuario restaurado correctamente'],200);
    }




}