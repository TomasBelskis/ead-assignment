<?php
require_once ("../SimpleTest/autorun.php");
class AuthorTestSuite extends TestSuite {
	function __construct() {
		parent::__construct ();
		include ('../app/index.php');
		include('../app/DB/DAO/PublisherDAO.php');
		$this->addFile ( "PublishersFunctionTest.php" );
		
	}
}
?>