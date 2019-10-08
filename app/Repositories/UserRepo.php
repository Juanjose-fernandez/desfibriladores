<?php


namespace App\Repositories;


use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

/**
 * Class UserRepository
 *
 * This service abstracts some interactions that occurs between Confide and
 * the Database.
 */
class UserRepo extends BaseRepo
{
    /**
     * Signup a new account with the given parameters
     *
     * @param  array $input Array containing 'email' and 'password'.
     *
     * @return    object that may or may not be saved successfully. Check the id to make sure.
     */

    public function __construct( ){

    }


    public function getModel(){
        return new User;
    }


    public function selectDataTable(Request $request){
        $query = $this->getModel()->select('users.*','roles.display_name as role')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id');

        if($request->input('f_username')){
            $query->where('users.username','like','%'.$request->input('f_username').'%');
        }
        if($request->input('f_name')){
            $query->where('users.name','like','%'.$request->input('f_name').'%');
        }
        if($request->input('f_surname')){
            $query->where('users.surname','like','%'.$request->input('f_surname').'%');
        }
        if($request->input('f_email')){
            $query->where('users.email','like','%'.$request->input('f_email').'%');
        }

        if($request->input('f_role_id')){
            $query->where('model_has_roles.role_id','=',$request->input('f_role_id'));
        }

        if(!is_null($request->input('f_active'))){
            $query->where('active','=',$request->input('f_active'));
        }


        return $query->withTrashed();

    }


    public function updateUser($name,$surname,$username,$email,$password,$id=null,$roles = null,$active = null,$plan_id = null,$nex_payment_date = null,$file = null){

        $user = new User();
        $user->setPassword(bcrypt($password));

        if ($id) { //If exists EDIT
            $user =  $this->findOrFail($id);
        }

        $user->setUsername($username);
        $user->setName($name);
        $user->setSurname($surname);
        $user->setEmail($email);
        $user->setActive($active);
        $user=$this->updateWithoutData($user);

        //Update or create subscription
        $nex_payment_date = Carbon::createFromFormat('d/m/Y',$nex_payment_date)->format('Y-m-d');
        if($user->getSubscription()->exists()){
            $this->subscriptionRepo->updateSubscription($plan_id,$nex_payment_date,$user->getId(),null,$user->getSubscription->getId());
        }else{
            $this->subscriptionRepo->updateSubscription($plan_id,$nex_payment_date,$user->getId(),null);
        }

        if($file){ //Check and storage avatar
            $avatar_path=$file->store('public/avatars');
            $url = Storage::url($avatar_path);
            $user->setAvatar($url);
            $user=$this->updateWithoutData($user);
        }

        $user->syncRoles(array_unique($roles?$roles:[]));
        return $user;
    }


    /**
     * Checks if the credentials has been throttled by too
     * much failed login attempts
     *
     * @param  array $credentials Array containing the credentials (email and password)
     *
     * @return  boolean Is throttled
     */
    public function isThrottled($input)
    {
        return Confide::isThrottled($input);
    }

    /**
     * Checks if the given credentials correponds to a user that exists but
     * is not confirmed
     *
     * @param  array $credentials Array containing the credentials (email and password)
     *
     * @return  boolean Exists and is not confirmed?
     */
    public function existsButNotConfirmed($input)
    {
        $user = Confide::getUserByEmailOrUsername($input);

        if ($user) {
            $correctPassword = Hash::check(
                isset($input['password']) ? $input['password'] : false,
                $user->password
            );

            return (! $user->confirmed && $correctPassword);
        }
    }

    /**
     * Resets a password of a user. The $input['token'] will tell which user.
     *
     * @param  array $input Array containing 'token', 'password' and 'password_confirmation' keys.
     *
     * @return  boolean Success
     */
    public function resetPassword($input)
    {
        $result = false;
        $user   = Confide::userByResetPasswordToken($input['token']);

        if ($user) {
            $user->password              = $input['password'];
            $user->password_confirmation = $input['password_confirmation'];
            $result = $this->save($user);
        }

        // If result is positive, destroy token
        if ($result) {
            Confide::destroyForgotPasswordToken($input['token']);
        }

        return $result;
    }



    /**
     * Update the profile user information.
     * @param $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateUserProfile($request)
    {

        $user = $this->findOrFail(Auth::user()->getId());
        $user->setUsername($request->input('user_username'));
        $user->setEmail($request->input('user_email'));
        $user->setName($request->input('user_name'));
        $user->setSurname($request->input('user_surname'));
        $user->setPhone($request->input('phone'));
        $user->setMobilePhone($request->input('mobile_phone'));
        $user->setBirthDate($request->input('birth_date'));

        if($request->hasFile('avatar')){ //Check and storage avatar
            $file=$request->file('avatar');
            $avatar_path=$file->store('avatars');
            $url = Storage::url($avatar_path);
            $user->setAvatar($url);
        }else{
            //$user->setAvatar(null);
        }
        $user = $this->updateWithoutData($user);

        return $user;
    }

    public function updateUserPass($request)
    {
        $user = $this->findOrFail(Auth::user()->getId());
        $user->setPassword(bcrypt($request->input('user_password')));
        $user = $this->updateWithoutData($user);
        return $user;
    }

    /**
     * @param User $user
     * @param $subruta es la subcarpeta dentro de storage public donde se encuentra la imagen Ej:storage/app/public/avatars, en este caso seria solo avatars
     * @return bool Si la operacion tuvo exito
     */
    public function removeFile(User $user,$subruta){
        if($user->getAvatar()!= null){
            try{
                $ruta = $user->getAvatar();
                $file_name = explode('/',$ruta);
                $file_name = array_pop($file_name);
                Storage::delete($subruta.'/'.$file_name);
            }catch (Exception $e){
                return false;
            }
            return true;
        }else{
            return true;
        }
    }




    public function getParticipantsAssociatedToProjectDatatable(Request $request,$project)
    {

        $query = $this->getModel()
            ->join('participants_projects','users.id','participants_projects.user_id')
            ->leftJoin('questionnaires','participants_projects.project_id','=',DB::raw('questionnaires.project_id and questionnaires.user_id = users.id'))
            ->where('participants_projects.project_id','=',$project->getId())


            ->select('users.id',
                'users.name',
                'users.surname',
                'users.email',
                'users.language_id',
                'users.questionnaire_token',
                'questionnaires.id as questionnaire_id',
                'questionnaires.user_id as questionnaire_user_id',
                'questionnaires.updated_at as questionnaire_updated_at',
                'questionnaires.project_id as questionnaire_fk_project',
                'questionnaires.token as questionnaire_fk_token',
                'participants_projects.auto_send_result',
                'users.questionnaire_token',
                'participants_projects.project_id',
                'questionnaires.typology_id'
            );
        $query->where(function ($query)use($project){
            $query->where('questionnaires.project_id','=',$project->getId())
                ->orWhere('questionnaires.project_id','=',null);
        });

        if($request->input('f_name')){
            $query->where('users.name','like','%'.$request->input('f_name').'%');
        }
        if($request->input('f_surname')){
            $query->where('users.surname','like','%'.$request->input('f_surname').'%');
        }
        if($request->input('f_mail')){
            $query->where('users.email','like','%'.$request->input('f_mail').'%');
        }


        return $query;

    }

    public function getComercials()
    {
        $comercials = $this->getModel()->role('comercial')->select('*',DB::raw('CONCAT(users.name, " ", users.surname) as full_name'));
        return $comercials;
    }

    public function getLogistic(){
        $logistic = $this->getModel()->role('logistica')->select('*',DB::raw('CONCAT(users.name, " ", users.surname) as full_name'));
        return $logistic;
    }


    public function getResponsables()
    {
        $responsables = $this->getModel()
                             ->join('blackboards','blackboards.responsable_id','users.id')->distinct('users.id')
                             ->select('users.*',DB::raw('CONCAT(users.name, " ", users.surname) as full_name'))->distinct('id');
        return $responsables;
    }

    public function checkSubscriptions()
    {
        $fecha_actual = Carbon::now()->format('Y-m-d');

        //Recogemos los usuarios cuya fecha de próximo pago sea < a fecha actual
        $expired_users =  $this->getModel()->where('next_payment_date','<',$fecha_actual)->get();

        foreach($expired_users as $expired_user){
            $expired_user->setActive('false');
            $expired_user->setNextPaymentDate(null);
            $expired_user->save();
        }

    }

    public function getWebmasters()
    {
        return  User::role('webmaster');
    }

    public function getTotalStudyTime($user,$material_category_id, $fechaIni = null, $fechaFin = null){

        $query = $user->stats()
            ->join('units','stats.unit_id','=','units.id')
            ->where('units.material_category_id','=',$material_category_id);

        if($fechaIni && $fechaFin){

            $fechaIni = Carbon::createFromFormat('d/m/Y', $fechaIni);
            $fechaFin = Carbon::createFromFormat('d/m/Y', $fechaFin);

            $fechaIni= $fechaIni->format('Y-m-d');
            $fechaFin= $fechaFin->format('Y-m-d');

            $query->where('stats.updated_at','>=',$fechaIni)
                ->where('stats.updated_at','<=',$fechaFin);
        }
        return $query;
    }

}
