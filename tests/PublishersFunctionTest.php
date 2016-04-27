<?php
class PublishersFunctionTest extends UnitTestCase{
	private $pDAO;
	private $DBMngr;
	
	public function setUp() {
		$this->DBMngr = new pdoDbManager();
		$this->pDAO = new PublisherDAO($DBMngr);
	}
	public function testGetPublishers() {
		
	}
	public function testGetPublisher(){
		
	}
	public function testInsertPublisher(){
		
	}
	public function testUpdatePublisher(){
		
	}
	public function testDeletePublisher(){
		
	}
	public function testSearchPublisherOnAddress(){
		
	}
	public function tearDown() {
		$this->pDAO = NULL;
	}
}
?>