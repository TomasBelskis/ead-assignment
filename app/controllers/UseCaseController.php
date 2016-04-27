<?php
class UseCaseController {
	private $slimApp;
	private $model;
	private $requestBody;
	public function __construct($model, $action = null, $slimApp, $parameters = null) {
		$this->model = $model;
		$this->slimApp = $slimApp;
		$this->requestBody = json_decode ( $this->slimApp->request->getBody (), true ); // this must contain the representation of the new book
		
		if (! empty ( $parameters ))
			$author_id = $parameters ["author_id"];
			$publisher = $parameters ["publisher"];			
		
		switch ($action) {
			case ACTION_PUBLISHER_ACQUIRES_AUTHOR :
				$this->PublisherAcquiresAuthor($author_id, $publisher);
				break;
			case ACTION_AUTHOR_ADDS_NEW_BOOK :
				$this->AuthorAddsBook($author_id, $publisher,$this->requestBody);
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
	private function PublisherAcquiresAuthor($author_id,$publisher)
	{
		
	}
	
	private function AuthorAddsBook($authorId, $publisher, $param) 
	{
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

