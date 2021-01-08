<?php
/***
 * lo que hace esto es detectar todo los errores de php
 * usado comunmente
 */
//patron de diseño front controller

ini_set('display_errors', 1);//inicializar las variables php
ini_set('display_startup_error', 1);//prender la deteccion de errores
error_reporting(E_ALL);//todos los errores

require_once '../vendor/autoload.php';

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/..');
$dotenv->load();

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\job;
use Aura\Router\RouterContainer;
use Laminas\Diactoros\Response\RedirectResponse;
$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',//driver
    'host'      => $_ENV['DB_HOST'],//servidor host
    'database'  => $_ENV['DB_NAME'],//nombre bd
    'username'  => $_ENV['DB_USER'],//user
    'password'  => $_ENV['DB_PASSWD'],//password
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();
// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);
/***
 * route compatible con psr-7
 */
$routerContainer = new RouterContainer();//instancia
//var_dump($routerContainer);
$map = $routerContainer->getMap();//crear mapa... estrucctura


//pagina principal
$map->get('index', '/CURSO-INTROUCCION-PHP/', [
    'controller'=>'App\Controllers\indexController',
    'action' => 'indexAction',
    'auth' => true
    ]);//crea mapeo

//agregar un job
$map->get('addJob', '/CURSO-INTROUCCION-PHP/jobs/add', [
    'controller' => 'App\Controllers\JobsController',
    'action' => 'getAddJobAction',
    'auth' => true
    ]);//crea mapeo metodo get
$map->post('saveJob', '/CURSO-INTROUCCION-PHP/jobs/add', [
    'controller' => 'App\Controllers\JobsController',
    'action' => 'getAddJobAction'
    ]);//crea mapeo metodo POST

//agregar un project
$map->get('addProject', '/CURSO-INTROUCCION-PHP/projects/add', [
    'controller' => 'App\Controllers\ProyectsController',
    'action' => 'getAddProjectAction',
    'auth' => true
    ]);//crea mapeo metodo get
$map->post('saveProject', '/CURSO-INTROUCCION-PHP/projects/add', [
    'controller' => 'App\Controllers\ProyectsController',
    'action' => 'getAddProjectAction'
    ]);//crea mapeo metodo get

//agregar un user
$map->get('addUser', '/CURSO-INTROUCCION-PHP/user/add', [
    'controller' => 'App\Controllers\UserController',
    'action' => 'getAddUserAction',
    'auth' => true
    ]);//crea mapeo metodo get
$map->post('saveUser', '/CURSO-INTROUCCION-PHP/user/add', [
    'controller' => 'App\Controllers\userController',
    'action' => 'getAddUserAction'
    ]);//crea mapeo metodo get

//login
$map->get('Login', '/CURSO-INTROUCCION-PHP/login', [
    'controller' => 'App\Controllers\AuthController',
    'action' => 'getLogin'
    ]);//crea mapeo metodo get
$map->post('Auth', '/CURSO-INTROUCCION-PHP/auth', [
    'controller' => 'App\Controllers\AuthController',
    'action' => 'postLogin'
    ]);//crea mapeo metodo get
$map->get('admin', '/CURSO-INTROUCCION-PHP/admin', [
    'controller' => 'App\Controllers\AdminController',
    'action' => 'getIndex',
    'auth' => true
    ]);

//logout
$map->get('Logout', '/CURSO-INTROUCCION-PHP/logout', [
    'controller' => 'App\Controllers\AuthController',
    'action' => 'getLogout'
    ]);//crea mapeo metodo get

$matcher = $routerContainer->getMatcher();//obtiene el match
//var_dump($matcher);7
$route = $matcher->match($request);//compara el pbjeto request con lo que hay en el mapa

function printElement($job) {
    //vaiida si los job son visibles
    /*if($job->visible == false) {
      //si es falso retorna
      return;
    }*/
    echo '<li class="work-position">';
    echo '<h5>' . $job->title . '</h5>';
    echo '<p>' . $job->description . '</p>';
    echo '<p>' . $job->getDurationAsString() . '</p>';
    echo '<strong>Achievements:</strong>';
    echo '<ul>';
    echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
    echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
    echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
    echo '</ul>';
    echo '</li>';
  }

if(!$route){
    echo 'No route';
}else{
    $handlerData = $route->handler;
    $controllerName = $handlerData['controller']; //instanciar una variable con el contendo 
    $actionName = $handlerData['action'];
    $needsAuth = $handlerData['auth'] ?? false ;

    $sessionUserId = $_SESSION['id'] ?? null;
    if($needsAuth && !$sessionUserId){
        $response = new RedirectResponse('/CURSO-INTROUCCION-PHP/login'); //crea una nueva ruta
    }else{
    $controller = new $controllerName;
    $response = $controller->$actionName($request);
    }
    

    //recorrer encabezados
    foreach($response->getHeaders() as $name => $values){
        foreach($values as $value){
            header(sprintf('%s: %s', $name, $value), false);
        }
    }

    http_response_code($response->getStatusCode());
    echo $response->getBody();

    //var_dump($route->handler);
    //require $route->handler;
}

//echo '<br>';
//echo 'handler' . '<br>';
//var_dump($route->handler);
echo '<br>';    
//var_dump($map);