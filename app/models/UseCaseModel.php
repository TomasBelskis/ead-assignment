<?php
/*
 * @author Tomas-Mac
 * @author Daniel Whyte
 */
require_once (realpath(dirname(__FILE__)."/../DB/pdoDbManager.php"));
require_once (realpath(dirname(__FILE__)."/../DB/DAO/UseCaseDAO.php"));
require_once (realpath(dirname(__FILE__). "/Validation.php"));

class UseCaseModel {
	private $UseCaseDao; // list of DAOs used by this model
	private $dbmanager; // dbmanager
	public $apiResponse; // api response
	private $validationSuite; // contains functions for validating inputs
	public function __construct() {
		$this->dbmanager = new pdoDbManager ();
		$this->UseCaseDao = new UseCaseDAO ( $this->dbmanager );
		$this->dbmanager->openConnection ();
		$this->validationSuite = new Validation ();
	}

	//User adds a new book
	public function addBook($authorId, $publisher, $parameters) {
		// validation of the values for new book and existing authorID and publisher
		
		// compulsory values
		if (! empty ( $authorId ) && ! empty ( $publisher) && ! empty ( $parameters["title"])) {

			
			if (($this->validationSuite->isLengthStringValid ( $publisher, TABLE_PUBLISHER_LENGTH )) && ($this->validationSuite->isLengthStringValid ( $parameters ["title"], TABLE_BOOK_TITLE_LENGTH ))) {
				if ($bookID = $this->UseCaseDao->insertBook ( $authorId, $publisher, $parameters ))
					return ($bookID);
			}
		}
		
		// if validation fails or insertion fails
		return (false);
	}
	
	public function publisherAcquiresAuthor($author_id,$publisher)
	{
		if (! empty ( $author_id )&&! empty ($publisher)&&is_numeric($author_id)
			&&($this->validationSuite->isLengthStringValid ( $publisher, TABLE_PUBLISHER_LENGTH )))
		{
			return ($this->UseCaseDao->PublisherAcquiresAuthors($publisher, $author_id));
		}
	}	
	
	public function __destruct() {
		$this->UseCaseDAO = null;
		$this->UseCaseDao = new UseCaseDAO( $this->dbmanager );
	}
	
}
?>