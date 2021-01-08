<?php

namespace App\Controllers;

use Laminas\Diactoros\Response\HtmlResponse;

class BaseController{
    //declarar variable protegida
    protected $templateEngine;
    //incializamos datos
    public function __construct(){
        $loader = new \Twig\Loader\FilesystemLoader('../views');
        $this->templateEngine = new \Twig\Environment($loader, [
            'debug' => true,
            'cache' => false,
        ]);
    }

    /***
     *mandamos datos html 
     *direccion
     *datos
     */

    public function renderHTML($fileName, $data = []){
        return new HtmlResponse($this->templateEngine->render($fileName, $data));
    }

}