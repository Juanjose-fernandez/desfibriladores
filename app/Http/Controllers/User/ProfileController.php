<?php

namespace App\Http\Controllers\User;

use App\HelpGuide;
use App\Http\Requests\savePassword;
use App\Http\Requests\saveProfileBasicInfo;
use App\MaterialCategory;
use App\Repositories\UserRepo;
use DB;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getProfile()
    {

        return view('site.users.profile');
    }

    public function postUpdateBasicInfo(saveProfileBasicInfo $saveProfileBasicInfo){

        DB::beginTransaction();
        try{
            $this->userRepo->updateUserProfile($saveProfileBasicInfo);
            DB::commit();
        }
        catch (Exception $e)
        {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('smart_notifications_small',['error'=>[Lang::get('users/messages.create.error')]]);

        }

        return redirect("/profile")->with('smart_notifications_small',['success'=>[Lang::get('users/messages.edit.success')]]);
    }

    public function postUpdatePassword(savePassword $savePassword){

        DB::beginTransaction();
        try{
            $this->userRepo->updateUserPass($savePassword);
            DB::commit();
        }
        catch (Exception $e)
        {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('smart_notifications_small',['error'=>[Lang::get('users/messages.edit.error')]]);

        }

        return redirect("/profile")->with('smart_notifications_small',['success'=>[Lang::get('users/messages.edit.pass.success')]]);
    }


}
