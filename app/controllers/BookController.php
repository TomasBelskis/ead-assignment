<?php
class bookController {
	private $slimApp;
	private $model;
	private $requestBody;
	public function __construct($model, $action = null, $slimApp, $parameteres = null) {
		$this->model = $model;
		$this->slimApp = $slimApp;
		$this->requestBody = json_decode ( $this->slimApp->request->getBody (), true ); // this must contain the representation of the new book
		
		if (! empty ( $parameteres ["book_id"] ))
			$bookID = $parameteres ["book_id"];
		
		switch ($action) {
			case ACTION_GET_BOOK :
				$this->getBook ( $bookID );
				break;
			case ACTION_GET_BOOK :
				$this->getBooks ();
				break;
			case ACTION_UPDATE_BOOK :
				$this->updateBook ( $bookID, $this->requestBody );
				break;
			case ACTION_CREATE_BOOK :
				$this->createNewBook ( $this->requestBody );
				break;
			case ACTION_DELETE_BOOK :
				$this->deleteBook ( $bookID );
				break;
			case ACTION_SEARCH_BOOKS :
				$string = $parameteres ["SearchingString"];
				$this->searchBooks ( $string );
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
	private function getBooks() {
		$answer = $this->model->getBooks ();
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
	
	private function getBook($bookID) {
		$answer = $this->model->getBook ( $bookID );
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
	
	private function createNewBook($newBook) {
		if ($newID = $this->model->createNewbook ( $newbook )) {
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
	private function deleteBook($bookID) {
		//TODO
		if ($deletedId = $this->model->deleteBook ( $bookID )) {
				$this->slimApp->response ()->setStatus ( HTTPSTATUS_OK );
				$Message = array (
						GENERAL_MESSAGE_LABEL => GENERAL_RESOURCE_DELETED,
						"id" => "$deletedId" 
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
	
	private function updateBook($bookID, $bookUpdate) {
		//TODO
	
		if ($updatedInfo = $this->model->updateBooks ($bookID, $bookUpdate)) {
				$this->slimApp->response ()->setStatus ( HTTPSTATUS_OK );
			
				$Message = array (
						GENERAL_MESSAGE_LABEL => GENERAL_RESOURCE_UPDATED,
						"id" => "$bookID"
						
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
	private function searchBooks($string) {
		//TODO
		$answer = $this->model->searchBooks ( $string );
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