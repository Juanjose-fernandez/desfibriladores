<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = 'roles';
    protected $fillable = ['roles'];


    function getUsers(){
        return $this->belongsToMany('App\User','model_has_roles' ,'role_id','user_id');
    }

    function getPermissions(){
        return $this->belongsToMany('App\Permissions','role_has_permissions','role_id','permission_id');
    }


    function getId(){
        return $this->id;
    }

    function getDisplayName(){
        return $this->display_name;
    }

    function getDescription(){
        return $this->description;
    }

    function getName(){
        return $this->name;
    }




}
