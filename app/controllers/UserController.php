<?php
/*
 * @author Tomas Belskis
 */
class UserController {
	private $slimApp;
	private $model;
	private $requestBody;
	public function __construct($model, $action = null, $slimApp, $parameteres = null) {
		$this->model = $model;
		$this->slimApp = $slimApp;
		$this->requestBody = json_decode ( $this->slimApp->request->getBody (), true ); // this must contain the representation of the new user
		
		if (! empty ( $parameteres ["id"] ))
			$id = $parameteres ["id"];
		
		switch ($action) {
			case ACTION_GET_USER :
				$this->getUser ( $id );
				break;
			case ACTION_GET_USERS :
				$this->getUsers ();
				break;
			case ACTION_UPDATE_USER :
				$this->updateUser ( $id, $this->requestBody );
				break;
			case ACTION_CREATE_USER :
				$this->createNewUser ( $this->requestBody );
				break;
			case ACTION_DELETE_USER :
				$this->deleteUser ( $id );
				break;
			case ACTION_SEARCH_USERS :
				$string = $parameteres ["SearchingString"];
				$this->searchUsers ( $string );
				break;
			case ACTION_AUTHENTICATE_USER :
				$username = $parameteres["username"];
				$password = $parameteres["password"];
				$this->authenticateUser($username,$password);
				break;
			case null :
				$this->slimApp->response ()->setStatus ( HTTPSTATUS_BADREQUEST );
				$Message = array (
						GENERAL_MESSAGE_LABEL => GENERAL_CLIENT_ERROR 
				);
				$this->model->apiResponse = $Message;
				break;
		}
	}
	private function getUsers() {
		$answer = $this->model->getUsers ();
		if ($answer != null) {
			$this->slimApp->response ()->setStatus ( HTTPSTATUS_OK );
			$this->model->apiResponse = $answer;
		} else {
			$this->slimApp->response ()->setStatus ( HTTPSTATUS_NOCONTENT );
			$Message = array (
					GENERAL_MESSAGE_LABEL => GENERAL_NOCONTENT_MESSAGE 
			);
			$this->model->apiResponse = $Message;
		}
	}
	
	private function getUser($userID) {
		$answer = $this->model->getUser ( $userID );
		if ($answer != null) {
			$this->slimApp->response ()->setStatus ( HTTPSTATUS_OK );
			$this->model->apiResponse = $answer;
		} else {
			
			$this->slimApp->response ()->setStatus ( HTTPSTATUS_NOCONTENT );
			$Message = array (
					GENERAL_MESSAGE_LABEL => GENERAL_NOCONTENT_MESSAGE 
			);
			$this->model->apiResponse = $Message;
		}
	}
	
	private function createNewUser($newUser) {
		if ($newID = $this->model->createNewUser ( $newUser )) {
			$this->slimApp->response ()->setStatus ( HTTPSTATUS_CREATED );
			$Message = array (
					GENERAL_MESSAGE_LABEL => GENERAL_RESOURCE_CREATED,
					"id" => "$newID" 
			);
			$this->model->apiResponse = $Message;
		} else {
			$this->slimApp->response ()->setStatus ( HTTPSTATUS_BADREQUEST );
			$Message = array (
					GENERAL_MESSAGE_LABEL => GENERAL_INVALIDBODY 
			);
			$this->model->apiResponse = $Message;
		}
	}
	private function deleteUser($userId) {
		
		if ($deletedId = $this->model->deleteUser ( $userId )) {
				$this->slimApp->response ()->setStatus ( HTTPSTATUS_OK );
				$Message = array (
						GENERAL_MESSAGE_LABEL => GENERAL_RESOURCE_DELETED,
						"id" => "$userId" 
				);
				$this->model->apiResponse = $Message;
			} else {
				$this->slimApp->response ()->setStatus ( HTTPSTATUS_BADREQUEST );
				$Message = array (
						GENERAL_MESSAGE_LABEL => GENERAL_INVALIDBODY 
				);
				$this->model->apiResponse = $Message;
			}
	}
	
	private function updateUser($userId, $userUpdate) {
		
	
		if ($updatedInfo = $this->model->updateUsers ($userId, $userUpdate)) {
				$this->slimApp->response ()->setStatus ( HTTPSTATUS_OK );
			
				$Message = array (
						GENERAL_MESSAGE_LABEL => GENERAL_RESOURCE_UPDATED,
						"id" => "$userId"
						
				);
				$this->model->apiResponse = $Message;
			} else {
				$this->slimApp->response ()->setStatus ( HTTPSTATUS_BADREQUEST );
				$Message = array (
						GENERAL_MESSAGE_LABEL => GENERAL_INVALIDBODY 
				);
				$this->model->apiResponse = $Message;
			}
	}
	private function searchUsers($string) {

		$answer = $this->model->searchUsers ( $string );
		if ($answer != null) {
			$this->slimApp->response ()->setStatus ( HTTPSTATUS_OK );
			$this->model->apiResponse = $answer;
		} else {
			
			$this->slimApp->response ()->setStatus ( HTTPSTATUS_NOCONTENT );
			$Message = array (
					GENERAL_MESSAGE_LABEL => GENERAL_NOCONTENT_MESSAGE 
			);
			$this->model->apiResponse = $Message;
		}
	}
	
	private function authenticateUser($username,$password){
		$answer = $this->model->authenticateUser($username,$password);
		if($answer){
			$this->slimApp->response()->setStatus(HTTPSTATUS_OK);
			$this->model->apiResponse = $answer;
		}else{
			$this->slimApp->response ()->setStatus (HTTPSTATUS_UNAUTHORIZED);
			$this->slimApp->halt(401);
		}
	}	
}
?>