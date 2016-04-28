<?php
require_once (realpath(dirname(__FILE__)."/../SimpleTest/autorun.php"));
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
		
		//Tests written for Publisher model get publisher on id
		$this->assertFalse($this->pModel->getPublisher("adsafsad"));
		$this->assertFalse($this->pModel->getPublisher(" "));
		$this->assertFalse($this->pModel->getPublisher(null));
		$this->assertFalse($this->pModel->getPublisher(4.32));
		$this->assertFalse($this->pModel->getPublisher(-4141.31));		
		$this->assertFalse($this->pModel->getPublisher(false));
		$this->assertFalse($this->pModel->getPublisher(true));
	}
	
	//Tests for inserting publishers
	public function testInsertPublisher(){
		$parameters=array();
		$testObject=new PublisherModel();
		
		//Tests written for Publisher model insert publisher function
		$this->assertFalse($this->pModel->createNewPublisher($parameters));
		$this->assertFalse($this->pModel->createNewPublisher($parameters=array("publisher"=>11123,"address"=>12312,"phone"=>3121132)));
		$this->assertFalse($this->pModel->createNewPublisher($parameters=array("publisher"=>null,"address"=>null,"phone"=>null)));
		$this->assertFalse($this->pModel->createNewPublisher($parameters=array("publisher"=>"","address"=>"","phone"=>"")));
		$this->assertFalse($this->pModel->createNewPublisher($parameters=array("publisher"=>12,"address"=>"testAddress","phone"=>"13121")));   
		$this->assertFalse($this->pModel->createNewPublisher($parameters=array($testObject)));
		$this->assertFalse($this->pModel->createNewPublisher(""));
		$this->assertFalse($this->pModel->createNewPublisher(12313241));
		$this->assertFalse($this->pModel->createNewPublisher(-12312.2));
		$this->assertFalse($this->pModel->createNewPublisher("dasfaadsas"));
		$this->assertFalse($this->pModel->createNewPublisher(null));
		  
	}
	
	//Test for updating publishers
	public function testUpdatePublisher(){
		$parameters=array();
		$testObject=new PublisherModel();
		
		//tests publisher model for updating publisher function
		$this->assertFalse($this->pModel->updatePublisher("",$parameters));
		$this->assertFalse($this->pModel->updatePublisher(1,$parameters));
		$this->assertFalse($this->pModel->updatePublisher(null,$parameters));
		$this->assertFalse($this->pModel->updatePublisher(-1,$parameters));
		$this->assertFalse($this->pModel->updatePublisher("eqwqeqw",$parameters));
		$this->assertFalse($this->pModel->updatePublisher($testObject,$parameters));
		$this->assertFalse($this->pModel->updatePublisher("adsasda",$parameters=array("address"=>"","phone"=>"")));
		$this->assertFalse($this->pModel->updatePublisher("adsasda",$parameters=array("address"=>null,"phone"=>null)));
		$this->assertFalse($this->pModel->updatePublisher("adsasda",$parameters=array("address"=>123123,"phone"=>123123)));
		$this->assertFalse($this->pModel->updatePublisher("adsasda",$parameters=array("address"=>-21312.31231,"phone"=>-3123.131)));
		$this->assertFalse($this->pModel->updatePublisher("adsasda",$parameters=array($testObject)));
		//$this->assertFalse($this->pModel->updatePublisher("adsasda",$parameters=array("address"=>"adsafasda","phone"=>"dasda")));
		
	}
	
	//Test for deleting publisher
	public function testDeletePublisher(){
		
		$this->assertFalse($this->pModel->deletePublisher(""));
		$this->assertFalse($this->pModel->deletePublisher(null));
		$this->assertFalse($this->pModel->deletePublisher(4.32));
		$this->assertFalse($this->pModel->deletePublisher(-4141.31));		
		$this->assertFalse($this->pModel->deletePublisher(false));
		$this->assertFalse($this->pModel->deletePublisher(true));
	}
	
	//Test for searching publisher
	public function testSearchPublisherOnAddress(){
		$parameters=array();
		$testObject=new PublisherModel();
		
		$this->assertFalse($this->pModel->searchPublisherOnAddress("adsafsad"));
		$this->assertFalse($this->pModel->searchPublisherOnAddress(""));
		$this->assertFalse($this->pModel->searchPublisherOnAddress(null));
		$this->assertFalse($this->pModel->searchPublisherOnAddress(4.32));
		$this->assertFalse($this->pModel->searchPublisherOnAddress(-4141.31));		
		$this->assertFalse($this->pModel->searchPublisherOnAddress(false));
		$this->assertFalse($this->pModel->searchPublisherOnAddress(true));
	}
	public function tearDown() {
		$this->pDAO = NULL;
	}
}
?>