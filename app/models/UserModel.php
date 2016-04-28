<?php
/*
 * @author Tomas Belskis
 */
require_once (realpath(dirname(__FILE__)."/../DB/pdoDbManager.php"));
require_once (realpath(dirname(__FILE__)."/../DB/DAO/UsersDAO.php"));
require_once (realpath(dirname(__FILE__)."/Validation.php"));

class UserModel {
	private $UsersDAO; // list of DAOs used by this model
	private $dbmanager; // dbmanager
	public $apiResponse; // api response
	private $validationSuite; // contains functions for validating inputs
	public function __construct() {
		$this->dbmanager = new pdoDbManager ();
		$this->UsersDAO = new UsersDAO ( $this->dbmanager );
		$this->dbmanager->openConnection ();
		$this->validationSuite = new Validation ();
	}
	public function getUsers() {
		return ($this->UsersDAO->get ());
	}
	public function getUser($userID) {
		if (is_numeric ( $userID ))
			return ($this->UsersDAO->get ( $userID ));
		
		return false;
	}
	/**
	 *
	 * @param array $newUser:
	 *        	an associative array containing the detail of the new user
	 */
	public function createNewUser($newUser) {
		// validation of the values of the new user
		
		// compulsory values
		if (! empty ( $newUser ["name"] ) && ! empty ( $newUser ["surname"] ) && ! empty ( $newUser ["email"] ) && ! empty ( $newUser ["password"] )) {
			/*
			 * the model knows the representation of a user in the database and this is: name: varchar(25) surname: varchar(25) email: varchar(50) password: varchar(40)
			 */
			
			if (($this->validationSuite->isLengthStringValid ( $newUser ["name"], TABLE_USER_NAME_LENGTH )) && ($this->validationSuite->isLengthStringValid ( $newUser ["surname"], TABLE_USER_SURNAME_LENGTH )) && ($this->validationSuite->isLengthStringValid ( $newUser ["email"], TABLE_USER_EMAIL_LENGTH )) && ($this->validationSuite->isLengthStringValid ( $newUser ["password"], TABLE_USER_PASSWORD_LENGTH ))) {
				if ($newId = $this->UsersDAO->insert ( $newUser ))
					return ($newId);
			}
		}
		
		// if validation fails or insertion fails
		return (false);
	}
	/**
	 * @param	$userId:
	 * 				id of a user in the form of an numeric value
	 * @param	$userNewRepresentation:
	 * 				array containing new details for an existing user
	 */
	public function updateUsers($userID, $userNewRepresentation) {
		//TODO
		// compulsory values
		if (!empty($userID ) && ! empty ( $userNewRepresentation ["name"] ) &&
		 ! empty ( $userNewRepresentation ["surname"] ) && 
		 ! empty ( $userNewRepresentation ["email"] ) && 
		 ! empty ( $userNewRepresentation ["password"] )) {
			/*
			 * the model knows the representation of a user in the database and this is: name: varchar(25) surname: varchar(25) email: varchar(50) password: varchar(40)
			 */
	 
			if (($this->validationSuite->isLengthStringValid ( $userNewRepresentation ["name"], TABLE_USER_NAME_LENGTH )) && ($this->validationSuite->isLengthStringValid ( $userNewRepresentation ["surname"], TABLE_USER_SURNAME_LENGTH )) && ($this->validationSuite->isLengthStringValid ( $userNewRepresentation ["email"], TABLE_USER_EMAIL_LENGTH )) & ($this->validationSuite->isLengthStringValid ( $userNewRepresentation ["password"], TABLE_USER_PASSWORD_LENGTH ))) {
				
				if ( $this->UsersDAO->update($userNewRepresentation, $userID))
					
					return ($this->UsersDAO->get ( $userID ));
			}
		}
		
		// if validation fails or insertion fails
		return (false);
		
	}
	/**
	 * 
	 * Searches for a user based on inputed string for name or surname
	 * @param $string:
	 * 			representation of name or surname in a string format
	 */
	public function searchUsers($string) {
		//TODO
		
		// compulsory values
		if (!empty($string)) {
			/*
			 * the model knows the representation of a user in the database and this is: name: varchar(25) surname: varchar(25) email: varchar(50) password: varchar(40)
			 */
			
			if (($this->validationSuite->isLengthStringValid ( $string, TABLE_USER_NAME_LENGTH )) && ($this->validationSuite->isLengthStringValid ( $string, TABLE_USER_SURNAME_LENGTH ))) {
				if ($user = $this->UsersDAO->search($string))
					return ($user);
			}
		}
		
		// if validation fails or insertion fails
		return (false);
		
	}
	/**
	 * 
	 * Deletes a user based on userID.
	 * @param $userID:
	 * 			a user id in the form of a numerical value
	 */
	public function deleteUser($userID) {
		//TODO
		
		// compulsory values
		if (! empty ( $userID)) {
			/*
			 * the model knows the representation of a user in the database and this is: name: varchar(25) surname: varchar(25) email: varchar(50) password: varchar(40)
			 */
			
			if (is_numeric($userID)) {
				if ($deleted = $this->UsersDAO->delete($userID));
					return ($deleted);
			}
		}
		
		// if validation fails or insertion fails
		return (false);
	}
	
	/**
	 * 
	 *	Authentication function that checks if a username and password exist within the databse and allows acces,
	 *	if it does or kills the application if it doesn't.
	 * @param $username : string value for users name
	 * @param $password : string value for password
	 */
	public function authenticateUser($username,$password){
		if(!empty($username)&&!empty($password)){
			if(($this->validationSuite->isLengthStringValid($username,TABLE_USER_NAME_LENGTH)) && ($this->validationSuite->isLengthStringValid($password, TABLE_USER_PASSWORD_LENGTH)))	{
				if($authenticated=$this->UsersDAO->authenticate($username,$password)){
					return $authenticated;
				}else{
					return false;
				}
			}
		}
	}
	
	public function __destruct() {
		$this->UsersDAO = null;
		$this->dbmanager->closeConnection ();
	}
}
?>