<?php

namespace App\Models;
//al heredar tienes que requerir la clases
//requeire de la clase 

/***
 * se extiende de Model ya que es por por algo estandar de la libreria de Illuminate
 * el use para poder usar dicha liberia 
 * variable $table protegida para inicializar el nombre de la tabla o asignacion
 */

use Illuminate\Database\Eloquent\Model;

class user extends Model{

  protected $table = 'user';

}