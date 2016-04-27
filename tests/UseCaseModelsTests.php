<?php
require_once (realpath(dirname(__FILE__)."/../SimpleTest/autorun.php"));
require_once (realpath(dirname(__FILE__)."/../conf/config.inc.php"));
require_once (realpath(dirname(__FILE__)."/../app/models/UseCaseModel.php"));
class UseCaseModelTests extends UnitTestCase {
	private $useCaseModel;
	
	public function setUp() {
		$this->useCaseModel = new UseCaseModel();
	}
	
	public function testPublisherAcquiresAuthor() {
		$this->assertFalse($this->useCaseModel->publisherAcquiresAuthor("frank", "birdie"));
		$this->assertFalse($this->useCaseModel->publisherAcquiresAuthor(32,1));
	}

	public function tearDown() {
		$this->ba = NULL;
	}
}
?>