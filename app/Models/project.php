<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class project extends Model{

    protected $table = 'projects';
    
    public function getDurationAsString() {
        $years = floor($this->months / 12);
        $extraMonths = $this->months % 12;
      
        if($years > 0 && $extraMonths >0){
          return "project duration: $years $extraMonths months";  
        }
        
    }
}