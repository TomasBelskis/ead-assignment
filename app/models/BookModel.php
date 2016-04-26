<?php
require_once "DB/pdoDbManager.php";
require_once "DB/DAO/BooksDAO.php";
require_once "Validation.php";
class UserModel {
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
		return ($this->BooksDAO->get ());
	}
	public function getBook($bookID) {
		if (is_numeric ( $bookID ))
			return ($this->BooksDAO->get ( $bookID ));
		
		return false;
	}
	/**
	 *
	 * @param array $UserRepresentation:
	 *        	an associative array containing the detail of the new user
	 */
	public function createNewBook($newBook) {
		// validation of the values of the new user
		
		// compulsory values
		if (! empty ( $newBook ["author_id"] ) && ! empty ( $newBook ["publisher"] ) && ! empty ( $newBook ["title"] )) {
			/*
			 * the model knows the representation of a user in the database and this is: name: varchar(25) surname: varchar(25) email: varchar(50) password: varchar(40)
			 */
			
			if (($this->validationSuite->isLengthStringValid ( $newBook ["author_id"], TABLE_AUTHORID_LENGTH )) 
					&& ($this->validationSuite->isLengthStringValid ( $newBook ["publisher"], TABLE_PUBLISHER_LENGTH )) 
					&& ($this->validationSuite->isLengthStringValid ( $newBook ["title"], TABLE_BOOK_TITLE_LENGTH ))) {
				if ($newId = $this->BooksDAO->insert ( $newBook ))
					return ($newId);
			}
		}		
		// if validation fails or insertion fails
		return (false);
	}
	
	public function updateBooks($bookID, $bookNewRepresentation) {
		//TODO
		// compulsory values
		if (!empty($userID ) && ! empty ( $bookNewRepresentation ["author_id"] ) &&
		 ! empty ( $bookNewRepresentation ["publisher"] ) && 
		 ! empty ( $bookNewRepresentation ["title"] )) {
			/*
			 * the model knows the representation of a user in the database and this is: name: varchar(25) surname: varchar(25) email: varchar(50) password: varchar(40)
			 */
	 
			if (($this->validationSuite->isLengthStringValid ( $bookNewRepresentation ["author_id"], TABLE_AUTHORID_LENGTH )) 
					&& ($this->validationSuite->isLengthStringValid ( $bookNewRepresentation ["publisher"], TABLE_PUBLISHER_LENGTH )) 
					&& ($this->validationSuite->isLengthStringValid ( $bookNewRepresentation ["title"], TABLE_BOOK_TITLE_LENGTH ))) {
				
				if ( $this->BooksDAO->update($bookNewRepresentation, $bookID))
					
					return ($this->BooksDAO->get ( $bookID ));
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
			 * the model knows the representation of a user in the database and this is: name: varchar(25) surname: varchar(25) email: varchar(50) password: varchar(40)
			 */
			
			if (($this->validationSuite->isLengthStringValid ( $string, TABLE_BOOK_TITLE_LENGTH ))) {
				if ($book = $this->BooksDAO->search($string))
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
				if ($deleted = $this->BooksDAO->delete($bookID));
					return ($deleted);
			}
		}		
		// if validation fails or insertion fails
		return (false);
	}
	
	public function __destruct() {
		$this->BooksDAO = null;
		$this->dbmanager->closeConnection ();
	}
}
?>