<?php
require_once "../Slim/Slim.php";
require_once "conf/config.inc.php";

Slim\Slim::registerAutoloader ();

$app = new \Slim\Slim (); //slim run-time object
$headers = $app->request->headers;

function authenticate(\Slim\Route $route){
  global $headers, $app;
  $action= null;
  $parameters = null;
  $result = null;
  
 
	$username = $headers["username"];
	$password = $headers["password"];
	echo "authenticate got callled";
	if(!empty($username)&&!empty($password)){
		$action=ACTION_AUTHENTICATE_USER;
		$parameters = array("username"=>$username,"password"=>$password);
	}else{
		echo "header for username and password is not set";
		$app->response ()->setStatus (HTTPSTATUS_UNAUTHORIZED);
		$app->halt(401);
	}
 	return  new loadRunMVCComponents ( "UserModel", "UserController", "jsonView", $action,$app, $parameters);

}

//user id path
$app->map ( "/users(/:id)", "authenticate", function ($userID = null) use($app) {
	
	$httpMethod = $app->request->getMethod ();
	$action = null;
	$parameters ["id"] = $userID; // prepare parameters to be passed to the controller (example: ID)
	
	if (($userID == null) or is_numeric ( $userID )) {
		switch ($httpMethod) {
			case "GET" :
				if ($userID != null)
					$action = ACTION_GET_USER;
				else
					$action = ACTION_GET_USERS;
				break;
			case "POST" :
				$action = ACTION_CREATE_USER;
				break;
			case "PUT" :
				$action = ACTION_UPDATE_USER;
				break;
			case "DELETE" :
				$action = ACTION_DELETE_USER;
				break;
			default :
		}
	}
	return new loadRunMVCComponents ( "UserModel", "UserController", "jsonView", $action, $app, $parameters );
} )->via ( "GET", "POST", "PUT", "DELETE" );

//searching users on string
$app->map ( "/users/search(/:searchingString)", "authenticate", function ($string = null) use($app) {

	$httpMethod = $app->request->getMethod ();
	$action=null;
	$parameters ["SearchingString"] = $string;

if(!empty($string)){
	switch ($httpMethod) {
		case "GET" :
				if ($string != null) {
					$action = ACTION_SEARCH_USERS;
				}
			break;
		default:
		}
}
	return new loadRunMVCComponents ( "UserModel", "UserController", "jsonView", $action, $app, $parameters );
} )->via ( "GET" );

//Publisher searching
$app->map ( "/publisher(/:publisherID)", "authenticate", function ($publisherID = null) use($app) {
	
	$httpMethod = $app->request->getMethod ();
	$action = null;
	$parameters ["publisher"] = $publisherID; // prepare parameters to be passed to the controller (example: ID)
	
	if (($publisherID == null) or !empty ( $publisherID )) {
		switch ($httpMethod) {
			case "GET" :
				if ($publisherID != null)
					$action = ACTION_GET_PUBLISHER;
				else
					$action = ACTION_GET_PUBLISHERS;
				break;
			case "POST" :
				$action = ACTION_CREATE_PUBLISHER;
				break;
			case "PUT" :
				$action = ACTION_UPDATE_PUBLISHER;
				break;
			case "DELETE" :
				$action = ACTION_DELETE_PUBLISHER;
				break;
			default :
		}
	}
	return new loadRunMVCComponents ( "UserModel", "PublisherController", "jsonView", $action, $app, $parameters );
} )->via ( "GET", "POST", "PUT", "DELETE" );

//seraching publisher based on address
$app->map ( "/publisher/search(/:searchingAddress)", "authenticate", function ($string = null) use($app) {

	$httpMethod = $app->request->getMethod ();
	$action=null;
	$parameters ["SearchingAddress"] = $searchingAddress;

if(!empty($string)){
	switch ($httpMethod) {
		case "GET" :
				if ($string != null) {
					$action = ACTION_SEARCH_PUBLISHER;
				}
			break;
		default:
		}
}
	return new loadRunMVCComponents ( "UserModel", "PublisherController", "jsonView", $action, $app, $parameters );
} )->via ( "GET" );

//testing multiple paramenter route
$app->map ( "/user/:id/name/:name", "authenticate", function ($id, $name) use($app) {

	$httpMethod = $app->request->getMethod ();
	$action=null;
	$parameters ["id"] = $id;
	$parameters["name"]=$name;

	echo "Checking multiple paramenter route";
	print_r($parameters);
	$responseArray = json_encode($parameters);
	$app->response->write($responseArray);
	
	return new loadRunMVCComponents ( "UserModel", "UserController", "jsonView", $action, $app, $parameters );
} )->via ( "GET" );


$app->run ();
class loadRunMVCComponents {
	public $model, $controller, $view;
	public function __construct($modelName, $controllerName, $viewName, $action, $app, $parameters = null) {
		include_once "models/" . $modelName . ".php";
		include_once "controllers/" . $controllerName . ".php";
		include_once "views/" . $viewName . ".php";
		
		$model = new $modelName (); // common model
		$controller = new $controllerName ( $model, $action, $app, $parameters );
		$view = new $viewName ( $controller, $model, $app, $app->headers ); // common view
		$view->output (); // this returns the response to the requesting client
	}
}

?>