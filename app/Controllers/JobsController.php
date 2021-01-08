<?php

namespace App\Controllers;

use App\Models\job;
use Respect\Validation\Validator as v;

class JobsController extends BaseController{

    public function getAddJobAction($request){
        /***
         * Return an instance with the specified message body.
         * --->var_dump((String)$request->getBody());
         * Return an instance with the specified body parameters.
         * --->var_dump($request->getParsedBody());
        */
        //Return an instance with the provided HTTP method.

        $responseMessage = null;

        if($request->getMethod() == 'POST'){
            $postData = $request->getParsedBody();
            //validaciones con Validator
            $jobValidator = v::key('title', v::stringType()->NotEmpty())
                  ->key('description', v::stringType()->NotEmpty());
            try{
                $jobValidator->assert($postData); // true
                $postData = $request->getParsedBody();
                $files = $request->getUploadedFiles();//devuelve un arreglo con los datos de la imagen
                $logo = $files['logo'];
                
                if($logo->getError() == UPLOAD_ERR_OK){//validar si no hubo error al subir el archivo
                    $fileName = $logo->getClientFileName();
                    $logo->moveTo("upload/$fileName");
                }
                $job= new job();
                $job->title = $postData['title'];
                $job->description = $postData['description'];
                $job->image = $fileName;;
                $job->save();

                $responseMessage = 'Saved';
            }catch(\Exception $e){
                $responseMessage = $e->getMessage();
            }

           

            /**$postData = $request->getParsedBody();
            $job = new job();
            $job->title = $postData['title'];
            $job->description = $postData['description'];
            $job->save();*/
            
        }
        /***
        * por defecto se deben poner campos de updated_at y created_at
        * se debe mandar a llamar el autoload para la carga automatica de clases
        * 
        */

        return $this->renderHTML('addjob.twig', [
            'responseMessage' => $responseMessage
        ]);
    }

}