<?php
/*
 * @author Tomas Belskis
 * @author Daniel Whyte
 */
class UseCaseController {
	private $slimApp;
	private $model;
	private $requestBody;
	public function __construct($model, $action = null, $slimApp, $parameters = null) {
		$this->model = $model;
		$this->slimApp = $slimApp;
		$this->requestBody = json_decode ( $this->slimApp->request->getBody (), true ); // this must contain the representation of the new book
		
		if (! empty ( $parameters["author_id"] )&&! empty ( $parameters["publisher"] ))
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
	/**
	 * 
	 * Publisher Changes author
	 * @param $author_id : numeric value of authors id
	 * @param  $publisher : string representation of publishers name
	 */
	private function PublisherAcquiresAuthor($author_id,$publisher)
	{
		if(is_numeric($author_id))
		{
			$answer = $this->model->publisherAcquiresAuthor($author_id,$publisher);
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
	
	/**
	 * 
	 * An Existing author adds another book to an existing publishers
	 * @param $authorId : author id is a numeric value for author 
	 * @param $publisher : publisher is a string representation for publisher name
	 * @param $param : param is an array representation for new book
	 */
	
	private function AuthorAddsBook($authorId, $publisher, $param) 
	{
		$answer = $this->model->addBook ( $authorId, $publisher, $param );
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

