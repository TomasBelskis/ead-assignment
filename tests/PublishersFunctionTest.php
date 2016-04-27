<?php
require_once "../SimpleTest/autorun.php";
require_once (realpath(dirname(__FILE__)."/../app/models/PublisherModel.php"));
require_once (realpath(dirname(__FILE__)."/../app/conf/config.inc.php"));

class PublishersFunctionTest extends UnitTestCase{
	private $pDAO;
	
	public function setUp() {
		$this->DBMngr = new pdoDbManager();
		$this->pModel = new PublisherModel();
	}
	
	//Tests invalid publisher ID
	public function testGetPublisher(){
		$parameters=array();
		$testArray = array("haha"=>"12312","test"=>"test");
		
		//Tests written for Publisher model
		$this->assertFalse($this->pModel->getPublisher("adsafsad"));
		$this->assertFalse($this->pModel->getPublisher(" "));
		$this->assertFalse($this->pModel->getPublisher(null));
		$this->assertFalse($this->pModel->getPublisher(4.32));
		$this->assertFalse($this->pModel->getPublisher(-4141.31));
		$this->assertFalse($this->pModel->getPublisher($testArray));
	
	}
	
	//Tests for inserting publishers
	public function testInsertPublisher(){
		//$parameters=array();
		$testArray = array("haha"=>"12312","test"=>"test");
		$parameters=array("publisher"=>12,"address"=>1231,"phone"=>41231321);
		$json = json_encode($parameters);
		//Tests written for Publisher model
		$this->assertFalse($this->pModel->createNewPublisher($json));
		$this->assertFalse($this->pModel->createNewPublisher($json));
		$this->assertFalse($this->pModel->createNewPublisher($parameters=array("publisher"=>"","address"=>"","phone"=>"")));
		$this->assertFalse($this->pModel->createNewPublisher($parameters=array("publisher"=>12,"address"=>"testAddress","phone"=>"13121")));
		//$this->assertTrue($this->pModel->createNewPublisher($parameters=array("publisher"=>"test","address"=>"testAddress","phone"=>"1231241")));	
		
	}
	
	//Test for updating publishers
	public function testUpdatePublisher(){
		
	}
	
	//Test for deleting publisher
	public function testDeletePublisher(){
		
	}
	
	//Test for searching publisher
	public function testSearchPublisherOnAddress(){
		
	}
	public function tearDown() {
		$this->pDAO = NULL;
	}
}
?>