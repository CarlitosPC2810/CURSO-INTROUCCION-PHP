<?php

namespace App\Controllers;

use App\Models\{Job, Project};

class indexController extends BaseController{
    public function indexAction(){

        $jobs = job::all(); //manda a traer todos los registros
        $projects = project::all(); //mandar a traer todos los registros

        $name = 'Hector Benitez';
        $limitMonths = 2000;

        return $this->renderHTML('index.twig', [
            'name' => $name,
            'limitsMonths' => $limitMonths,
            'jobs' => $jobs,
            'projects' => $projects
        ]);
    }
}