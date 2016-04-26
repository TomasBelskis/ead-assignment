<?php
class PublisherController {
	private $slimApp;
	private $model;
	private $requestBody;
	public function __construct($model, $action = null, $slimApp, $parameteres = null) {
		$this->model = $model;
		$this->slimApp = $slimApp;
		$this->requestBody = json_decode ( $this->slimApp->request->getBody (), true ); // this must contain the representation of the new user
		
		if (! empty ( $parameteres ["publisher"] ))
			$publisher = $parameteres ["publisher"];
		
		switch ($action) {
			case ACTION_GET_PUBLISHER :
				$this->getPublisher ( $publisher );
				break;
			case ACTION_GET_PUBLISHERS :
				$this->getPublisher ();
				break;
			case ACTION_UPDATE_PUBLISHER :
				$this->updatePublisher ( $publisher, $this->requestBody );
				break;
			case ACTION_CREATE_PUBLISHER :
				$this->createNewPublisher ( $this->requestBody );
				break;
			case ACTION_DELETE_PUBLISHER :
				$this->deletePublisher ( $publisher );
				break;
			case ACTION_SEARCH_PUBLISHER :
				$string = $parameteres ["SearchingAddress"];
				$this->searchPublisher ( $publisher );
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
	
	//Gets all publishers
	private function getPublisher() {
		$answer = $this->model->getPublisher ();
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
	//gets publisher based on publisher name
	private function getPublisher($publisher) {
		$answer = $this->model->getPublisher ( $publisher );
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
	
	//Creates new publisher
	private function createNewPublisher($publisher) {
		if ($publisherName = $this->model->createNewPublisher ( $publisher )) {
			$this->slimApp->response ()->setStatus ( HTTPSTATUS_CREATED );
			$Message = array (
					GENERAL_MESSAGE_LABEL => GENERAL_RESOURCE_CREATED,
					"publisherName" => "$publisherName" 
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
	
	//Deletes a publisher
	private function deletePublisher($publisher) {
		//TODO
		if ($deletedPublisher = $this->model->deletePublisher ( $publisher )) {
				$this->slimApp->response ()->setStatus ( HTTPSTATUS_OK );
				$Message = array (
						GENERAL_MESSAGE_LABEL => GENERAL_RESOURCE_DELETED,
						"publisherName" => "$deletedPublisher" 
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
	
	//Updates a publisher
	private function updatePublisher($publisher, $publisherUpdate) {
		//TODO
	
		if ($updatedInfo = $this->model->updateUsers ($publisher, $publisherUpdate)) {
				$this->slimApp->response ()->setStatus ( HTTPSTATUS_OK );
			
				$Message = array (
						GENERAL_MESSAGE_LABEL => GENERAL_RESOURCE_UPDATED,
						"publisher" => "$publisher"
						
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
	
	//Searches for publisher based on an address
	private function searchPublisherOnAddress($address) {
		//TODO
		$answer = $this->model->searchPublisher ( $address );
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
		
}
?>