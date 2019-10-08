<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{


    /**
     * Define la tabla de la base de datos
     * @var string
     */
    protected $table = 'localities';

    /*
     * Devuelve el id de la localidad
     * @var int
     * */
    public function getId(){
        return $this->id;
    }

    /*
     * Devuelve el nombre de la localidad
     * @var string
     * */
    public function getName(){
        return $this->name;
    }

    public function setName($value){
        $this->name = $value;
    }




}