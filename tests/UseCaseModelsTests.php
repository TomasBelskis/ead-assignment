<?php
require_once (realpath(dirname(__FILE__)."/../SimpleTest/autorun.php"));
require_once (realpath(dirname(__FILE__)."/../app/conf/config.inc.php"));
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
	
	public function testAddBooks(){
		//test valid params
		$arr = array("title"=>"book");
		$parameters = json_encode($arr);
		$this->assertFalse($this->useCaseModel->addBook("string", "birdie", $parameters));
		$this->assertFalse($this->useCaseModel->addBook(12, 01, $parameters));
		
		//test invalid params
		$arr = array("title"=>01);
		$parameters = json_encode($arr);
		$this->assertFalse($this->useCaseModel->addBook("string", "birdie", $parameters));
		$this->assertFalse($this->useCaseModel->addBook(12, 01, $parameters));
		$this->assertFalse($this->useCaseModel->addBook(12, "birdie", $parameters));
	}

	public function tearDown() {
		$this->ba = NULL;
	}
}
?>