<?php
require_once (realpath(dirname(__FILE__)."/../DB/pdoDbManager.php"));
require_once (realpath(dirname(__FILE__)."/../DB/DAO/BooksDAO.php"));
require_once (realpath(dirname(__FILE__). "/Validation.php"));

class BookModel {
	private $BooksDao; // list of DAOs used by this model
	private $dbmanager; // dbmanager
	public $apiResponse; // api response
	private $validationSuite; // contains functions for validating inputs
	public function __construct() {
		$this->dbmanager = new pdoDbManager ();
		$this->BooksDao = new BooksDAO( $this->dbmanager );
		$this->dbmanager->openConnection ();
		$this->validationSuite = new Validation ();
	}
	public function getBooks() {
		return ($this->BooksDao->get());
	}
	public function getBook($bookID) {
		if (is_numeric ( $bookID ))
			return ($this->BooksDao->get ( $bookID ));
		
		return false;
	}
	/**
	 *
	 * @param array $BookRepresentation:
	 *        	an associative array containing the detail of the new book
	 */
	public function createNewBook($newBook) {
		// validation of the values of the new book
		
		// compulsory values
		if (! empty ( $newBook ["author_id"] )  
			&&! empty ( $newBook ["publisher"] ) 
			&& ! empty ( $newBook ["title"] )) {
			/*
			 * the model knows the representation of a book in the database 
			 * publisher: varchar(60) title: varchar(60)
			 */			
			if (is_numeric($newBook["author_id"])&&
					($this->validationSuite->isLengthStringValid ( $newBook ["publisher"], TABLE_PUBLISHER_LENGTH )) && 
					($this->validationSuite->isLengthStringValid ( $newBook ["title"], TABLE_BOOK_TITLE_LENGTH ))) {
				if ($newId = $this->BooksDao->insert ( $newBook ))
					return ($newId);
			}
		}		
		// if validation fails or insertion fails
		return (false);
	}
	
	public function updateBooks($bookID, $bookNewRepresentation) {
		//TODO
		// compulsory values
		if (!empty($bookID ) && 
		 ! empty ( $bookNewRepresentation ["author_id"] ) &&
		 ! empty ( $bookNewRepresentation ["publisher"] ) && 
		 ! empty ( $bookNewRepresentation ["title"] )) {
/*
			 * the model knows the representation of a book in the database 
			 * publisher: varchar(60) title: varchar(60)
			 */	 
			if (is_numeric($bookNewRepresentation["author_id"])&&
				($this->validationSuite->isLengthStringValid ( $bookNewRepresentation ["publisher"], TABLE_PUBLISHER_LENGTH )) &&
				($this->validationSuite->isLengthStringValid ( $bookNewRepresentation ["title"], TABLE_BOOK_TITLE_LENGTH ))) {
				
				if ( $this->BooksDao->update($bookNewRepresentation, $bookID))
					
					return ($this->BooksDao->get ( $bookID ));
			}
		}
		// if validation fails or insertion fails
		return (false);
	}
	
	public function searchBooks($string) {
		//TODO		
		// compulsory values
		if (!empty($string)) {
/*
			 * the model knows the representation of a book in the database 
			 * publisher: varchar(60) title: varchar(60)
			 */			
			if (($this->validationSuite->isLengthStringValid ( $string, TABLE_BOOK_TITLE_LENGTH ))) {
				if ($book = $this->BooksDao->search($string))
					return ($book);
			}
		}		
		// if validation fails or insertion fails
		return (false);		
	}
	
	public function deleteBook($bookID) {
		//TODO		
		// compulsory values
		if (! empty ($bookID)) {			
			if (is_numeric($bookID)) {
				if ($deleted = $this->BooksDao->delete($bookID));
					return ($deleted);
			}
		}		
		// if validation fails or insertion fails
		return (false);
	}
	
	public function __destruct() {
		$this->BooksDao = null;
		$this->dbmanager->closeConnection ();
	}
}
?>