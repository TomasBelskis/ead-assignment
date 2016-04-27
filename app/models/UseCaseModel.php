<?php
require_once (realpath(dirname(__FILE__)."/../DB/pdoDbManager.php"));
require_once (realpath(dirname(__FILE__)."/../DB/DAO/UseCaseDAO.php"));
require_once "Validation.php";
class UseCaseModel {
	private $UseCaseDao; // list of DAOs used by this model
	private $dbmanager; // dbmanager
	public $apiResponse; // api response
	private $validationSuite; // contains functions for validating inputs
	public function __construct() {
		$this->dbmanager = new pdoDbManager ();
		$this->UseCaseDao = new UseCaseDAO( $this->dbmanager );
		$this->dbmanager->openConnection ();
		$this->validationSuite = new Validation ();
	}
	
	public function publisherAcquiresAuthor($author_id,$publisher)
	{
		if (! empty ( $author_id )&&! empty ( $publisher)&&is_numeric($author_id)
			&&($this->validationSuite->isLengthStringValid ( $publisher, TABLE_PUBLISHER_LENGTH )))
		{
			return ($this->UseCaseDao->PublisherAcquiresAuthors($publisher, $author_id));
		}
	}
	
	public function __destruct() {
		$this->BooksDao = null;
		$this->dbmanager->closeConnection ();
	}
}
?>