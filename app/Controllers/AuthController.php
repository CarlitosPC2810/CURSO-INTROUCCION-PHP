<?php
namespace App\Controllers;

use App\Models\user;
use Respect\Validation\Validator as v;
use Laminas\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController{

    public function getLogin(){
        return $this->renderHTML('login.twig');
    }
    public function postLogin($request){
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
            $user = user::where('email', $postData['email'])->first();
                if($user){
                    if(\password_verify($postData['passwd'], $user->passwd)){
                        $_SESSION['id'] = $user->id;
                        $_SESSION['email'] = $user->email;
                        return new RedirectResponse('/CURSO-INTROUCCION-PHP/admin');
                    }else{
                        $responseMessage = 'incorrect';
                    }
                }else{
                    $responseMessage = 'Bad Credentials';
                }
        }

        return $this->renderHTML('login.twig', [
          'responseMessage' => $responseMessage
        ]);
    }

    public function getLogout(){
        unset($_SESSION['id']);
        unset($_SESSION['email']);
        return new RedirectResponse('/CURSO-INTROUCCION-PHP/login');
    }

}