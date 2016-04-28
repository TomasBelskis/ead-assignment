<?php
/*
 * @author	Tomas Belskis
 */
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
				$this->getPublishers ();
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
				$addressString = $parameteres ["SearchingAddress"];
				$this->searchPublisherOnAddress ( $addressString );
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
	private function getPublishers() {
		$answer = $this->model->getPublishers ();
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
	private function getPublisher($publisherName) {
		$answer = $this->model->getPublisher ( $publisherName );
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
						"publisherName" => "$publisher" 
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
	
		if ($updatedInfo = $this->model->updatePublisher ($publisher, $publisherUpdate)) {
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
		$answer = $this->model->searchPublisherOnAddress ( $address );
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