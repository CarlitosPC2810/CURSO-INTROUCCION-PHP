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

class job extends Model{

  protected $table = 'jobs';

  //poliformismo
    public function getDurationAsString() {
        $years = floor($this->months / 12);
        $extraMonths = $this->months % 12;
      
        //if($years > 0 && $extraMonths >0){
          return "Job duration: $years $extraMonths months";  
        //}
        
    }



}