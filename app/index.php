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
	
	if(!empty($username)&&!empty($password)){
		$action=ACTION_AUTHENTICATE_USER;
		$parameters = array("username"=>$username,"password"=>$password);
	}
 	return  new loadRunMVCComponents ( "UserModel", "UserController", "jsonView", $action,$app, $parameters);

}

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

$app->map ( "/books(/:id)", "authenticate", function ($bookID = null) use($app) {

	$httpMethod = $app->request->getMethod ();
	$action = null;
	$parameters ["book_id"] = $bookID; // prepare parameters to be passed to the controller (example: ID)

	if (($bookID == null) or is_numeric ( $bookID )) {
		switch ($httpMethod) {
			case "GET" :
				if ($bookID != null)
					$action = ACTION_GET_BOOK;
					else
						$action = ACTION_GET_BOOKS;
						break;
			case "POST" :
				$action = ACTION_CREATE_BOOK;
				break;
			case "PUT" :
				$action = ACTION_UPDATE_BOOK;
				break;
			case "DELETE" :
				$action = ACTION_DELETE_BOOK;
				break;
			default :
		}
	}
	return new loadRunMVCComponents ( "BookModel", "BookController", "jsonView", $action, $app, $parameters );
} )->via ( "GET", "POST", "PUT", "DELETE" );

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

$app->map ( "/books/search(/:searchingString)", "authenticate", function ($string = null) use($app) {

	$httpMethod = $app->request->getMethod ();
	$action=null;
	$parameters ["SearchingString"] = $string;

	if(!empty($string)){
		switch ($httpMethod) {
			case "GET" :
				if ($string != null) {
					$action = ACTION_SEARCH_BOOKS;
				}
				break;
			default:
		}
	}
	return new loadRunMVCComponents ( "BookModel", "BookController", "jsonView", $action, $app, $parameters );
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