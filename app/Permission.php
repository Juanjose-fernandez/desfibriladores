<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Exceptions\PermissionDoesNotExist;

class Permission extends Model
{
    protected $table = 'permissions';

    function getRoles(){
        return $this->belongsToMany('App\Roles','role_has_permissions','permission_id','role_id');
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