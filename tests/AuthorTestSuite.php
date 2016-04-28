<?php
require_once (realpath(dirname(__FILE__)."/../SimpleTest/autorun.php"));
class AuthorTestSuite extends TestSuite {
	function __construct() {
		parent::__construct ();
		include('../app/DB/DAO/PublisherDAO.php');
		$this->addFile ( "PublishersFunctionTest.php" );
		$this->addFile ("BookModelTests.php");
		$this->addFile("UseCaseModelsTests.php");
		$this->addFile("TestValidationClass.php");
		$this->addFile("UserModelTests.php");
		
	}
}
?>