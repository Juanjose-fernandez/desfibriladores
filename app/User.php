<?php

namespace App;


use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';

    protected $fillable = ['username','name','surname','email','password','active'];
    //protected $guarded = ['_token','_method','password_confirm'];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    function getRoles()
    {
        return $this->belongsToMany('App\Role', 'model_has_roles', 'model_id', 'role_id');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @param mixed $confirmed
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surnames)
    {
        $this->surname = $surnames;
    }
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    public function getFormatedBirthDate()
    {
        return Carbon::createFromFormat('Y-m-d',$this->birth_date)->format('d/m/Y');
    }

    public function setBirthDate($date)
    {
        $this->birth_date = $date;
    }

    public function getPhone()
    {
        return $this->phone;
    }
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setMobilePhone($phone)
    {
        $this->mobile_phone= $phone;
    }

    public function getMobilePhone()
    {
        return $this->mobile_phone;
    }


    public function getRestTime(){
        return $this->rest_time;
    }

    public function setRestTime($time){
        $this->rest_time = $time;
    }

    public function getTotalStudyingTime()
    {
        return $this->total_studying_time;
    }


    public function setTotalStudyingTime($time)
    {
        $this->total_studying_time = $time;
    }

    public function getTechniquePercentage()
    {
        return $this->technique_percentage;
    }


    public function setTechniquePercentage($percentage)
    {
        $this->technique_percentage = $percentage;
    }


    public function getRepertoryPercentage()
    {
        return $this->repertory_percentage;
    }


    public function setRepertoryPercentage($percentage)
    {
        $this->repertory_percentage = $percentage;
    }

    public function getNewMaterialPercentage()
    {
        return $this->new_material_percentage;
    }


    public function setNewMaterialPercentage($percentage)
    {
        $this->new_material_percentage = $percentage;
    }

    public function getStudyTime(){
        return $this->study_time;
    }

    public function setStudyTime ($studyTime){
        $this->study_time = $studyTime;
    }



    public function units()
    {
        return $this->hasMany(Unit::class, 'user_id', 'id');
    }

    public function packs()
    {
        return $this->hasMany(Pack::class, 'user_id', 'id');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'user_id', 'id');
    }

    public function assignmentsUnits()
    {
        return $this->morphedByMany(Unit::class, 'assignment');
    }

    public function assignmentsPacks()
    {
        return $this->morphedByMany(Pack::class, 'assignment');
    }

    public function assignmentsSessions()
    {
        return $this->morphedByMany(Session::class, 'assignment');
    }

    public function stats()
    {
        return $this->hasMany(Stat::class, 'user_id', 'id');
    }

    public function getSubscription()
    {
        return $this->hasOne(Subscription::class, 'user_id', 'id');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }


    public function unitProperties() {
        return $this->belongsToMany(Unit::class, 'user_unit_properties', 'unit_id')->withPivot(['duration','new_material','active']);
    }

    public function createdAssignments() {
        return $this->hasMany(Assignment::class, 'creator_user_id', 'id');
    }

}
