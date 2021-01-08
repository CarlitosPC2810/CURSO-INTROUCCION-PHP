<?php
namespace App\Controllers;

use App\Models\user;
use Respect\Validation\Validator as v;

class UserController extends BaseController{

    public function getAddUserAction($request){
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
            $userValidator = v::key('email', v::stringType()->NotEmpty())
                  ->key('passwd', v::stringType()->NotEmpty());
            try{
                $userValidator->assert($postData); // true
                $postData = $request->getParsedBody();
                $user = new user();
                $user->email = $postData['email'];
                $user->passwd = password_hash($postData['passwd'], PASSWORD_DEFAULT);
                $user->save();

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

        return $this->renderHTML('adduser.twig', [
            'responseMessage' => $responseMessage
        ]);
    }

}