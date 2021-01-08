<?php

namespace App\Controllers;

use App\Models\project;
use Respect\Validation\Validator as v;

class ProyectsController extends BaseController{

    public function getAddProjectAction($request){

        $responseMessage = null;

        if($request->getMethod() == 'POST'){
            $postData = $request->getParsedBody();
            $projectValidator = v::key('title', v::stringType()->NotEmpty())
                  ->key('description', v::stringType()->NotEmpty());
        try{
            $projectValidator->assert($postData); // true
            $postData = $request->getParsedBody();
            $files = $request->getUploadedFiles();//devuelve un arreglo con los datos de la imagen
            $logo = $files['logo'];

            if($logo->getError() == UPLOAD_ERR_OK){//validar si no hubo error al subir el archivo
                $fileName = $logo->getClientFileName();
                $logo->moveTo("upload/$fileName");
            }
            $project = new project();
            $project->title = $postData['title'];
            $project->description = $postData['description'];
            $project->image = $fileName;
            $project->save();

            $responseMessage = 'Saved';


        }catch(\Exception $e){
            $responseMessage = $e->getMessage();
        }
        }

        return $this->renderHTML('addproject.twig', [
            'responseMessage' => $responseMessage
        ]);

    }

}