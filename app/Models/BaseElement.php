<?php 

namespace App\Models;

class BaseElement implements PrintTable{

    //declaracion de variables en este caso publicas
    private $title;
    public $description;
    public $visible = true;
    public $months;

    //metodo  onstructor
    public function __construct($title, $description){
        //inicializacion de variables
        $this->setTitle($title);//inicializar ela variable a traves del metodo para validar el valor
        $this->description=$description;//solo se inicializa
    }
    //metodo set de title
    public function setTitle($title){   
        if($title == ''){
            $this->title='N/A';
        } else{
            $this->title = $title;
        }
    }
    //metodo get
    public function getTitle(){
        return $this->title;
    }
    //metood para calcular tiempo en años 
    public function getDurationAsString() {
        $years = floor($this->months / 12);
        $extraMonths = $this->months % 12;
      
        if($years > 0 && $extraMonths >0){
          return "$years years $extraMonths months";  
        }
        
      }

    public function getDescription(){
        return $this->description;
    }
}