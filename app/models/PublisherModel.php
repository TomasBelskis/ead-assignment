<?php
/*
 * @author: Tomas Belskis
 */

require_once (realpath(dirname(__FILE__)."/../DB/pdoDbManager.php"));
require_once (realpath(dirname(__FILE__)."/../DB/DAO/PublisherDAO.php"));
require_once "Validation.php";
class PublisherModel {
	private $PublisherDAO; // list of DAOs used by this model
	private $dbmanager; // dbmanager
	public $apiResponse; // api response
	private $validationSuite; // contains functions for validating inputs
	public function __construct() {
		$this->dbmanager = new pdoDbManager ();
		$this->PublisherDAO = new PublisherDAO ( $this->dbmanager );
		$this->dbmanager->openConnection ();
		$this->validationSuite = new Validation ();
	}
	public function getPublishers() {
		return ($this->PublisherDAO->get ());
	}
	
	public function getPublisher($publisher) {
		if (!empty($publisher ))
			return ($this->PublisherDAO->get ( $publisher ));
		
		return false;
	}
	/**
	 *
	 * @param array $UserRepresentation:
	 *        	an associative array containing the detail of the new user
	 */
	
	// create a new publisher
	public function createNewPublisher($newPublisher) {
		// validation of the values of the new publisher
		
		// compulsory values
		if (! empty ( $newPublisher ["publisher"] ) && ! empty ( $newPublisher ["address"] ) && ! empty ( $newPublisher ["phone"] )) {
			/*
			 * the model knows the representation of a publisher in the database 
			 */
			
			if (($this->validationSuite->isLengthStringValid ( $newPublisher ["publisher"], TABLE_PUBLISHER_LENGTH )) && ($this->validationSuite->isLengthStringValid ( $newPublisher ["address"], TABLE_PUBLISHER_ADDRESS_LENGTH )) && ($this->validationSuite->isLengthStringValid ( $newPublisher ["phone"], TABLE_PUBLISHER_PHONE_LENGTH ))) {
				if ($publisher = $this->PublisherDAO->insert ( $newPublisher ))
					return ($publisher);
			}
		}
		
		// if validation fails or insertion fails
		return (false);
	}
	
	// Updates existing publisher
	public function updatePublisher($publisher, $publisherNewRepresentation) {
		//TODO
		// compulsory values
		if (!empty($publisher ) && ! empty ( $publisherNewRepresentation ["address"] ) &&
		 ! empty ( $publisherNewRepresentation ["phone"] )) {
			
	 
			if (($this->validationSuite->isLengthStringValid ( $publisherNewRepresentation ["address"], TABLE_PUBLISHER_ADDRESS_LENGTH )) && ($this->validationSuite->isLengthStringValid ( $publisherNewRepresentation ["phone"], TABLE_PUBLISHER_PHONE_LENGTH ))) {
				
				if ( $this->PublisherDAO->update($publisherNewRepresentation, $publisher))
					
					return ($this->PublisherDAO->get ( $publisher ));
			}
		}
		
		// if validation fails or insertion fails
		return (false);
		
	}
	
	public function searchPublisherOnAddress($address) {
		
		/*
		 * Searches for a publisher based on an address
		 */
		
		// compulsory values
		if (!empty($address)) {
			
			if (($this->validationSuite->isLengthStringValid ( $address, TABLE_PUBLISHER_ADDRESS_LENGTH ))) {
				if ($publisher = $this->PublisherDAO->search($address))
					return ($publisher);
			}
		}
		
		// if validation fails or insertion fails
		return (false);
		
	}
	
	
	public function deletePublisher($publisher) {
	//Deletes a publisher
		// compulsory values
		if (! empty ( $publisher)&&is_string($publisher)) {
			
			
			if (!empty($publisher)) {
				if ($deleted = $this->PublisherDAO->delete($publisher));
					return ($deleted);
			}
		}
		
		// if validation fails or insertion fails
		return (false);
	}

	
	public function __destruct() {
		$this->PublisherDAO = null;
		$this->dbmanager->closeConnection ();
	}
}
?>