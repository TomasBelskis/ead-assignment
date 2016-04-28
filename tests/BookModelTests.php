<?php
require_once (realpath(dirname(__FILE__)."/../SimpleTest/autorun.php"));
require_once (realpath(dirname(__FILE__)."/../app/conf/config.inc.php"));
require_once (realpath(dirname(__FILE__)."/../app/models/BookModel.php"));
class BookModelTests extends UnitTestCase {
	private $bookModel;
	
	public function setUp() {
		$this->bookModel = new BookModel();
	}
	
	public function testGetBookInvalidID()
	{
		$this->assertEqual(false,$this->bookModel->getBook("give me a book please"));
	}	
	
	public function testCreateNewBookInvalidStructure() {
		$arr = array('author_id'=>32,'publisher'=>'pub');
		$json = json_encode($arr);
		$this->assertEqual(false,$this->bookModel->createNewBook($json));
	}	
	
	public function testCreateNewBookInvalidAuthorIDValue() {
		$arr = array('author_id'=>'a string','publisher'=>'pub','title'=>'dinosaur');
		$json = json_encode($arr);
		$this->assertEqual(false,$this->bookModel->createNewBook($json));
	}	
	
	public function testCreateNewBookInvalidPublisherValue() {
		$arr = array('author_id'=>32,'publisher'=>17,'title'=>'dinosaur');
		$json = json_encode($arr);
		$this->assertEqual(false,$this->bookModel->createNewBook($json));
	}
	
	public function testCreateNewBookInvalidTitleValue() {
		$arr = array('author_id'=>32,'publisher'=>'pub','title'=>12);
		$json = json_encode($arr);
		$this->assertEqual(false,$this->bookModel->createNewBook($json));
	}
	
	public function testUpdateBookInvalidIDValue() {
		$id = "mr bojangles";
		$arr = array('author_id'=>32,'publisher'=>'pub','title'=>12);
		$json = json_encode($arr);
		$this->assertEqual(false,$this->bookModel->updateBooks($id,$json));
	}
	
	public function testUpdateBookInvalidStructure() {
		$id = 1;
		$arr = array('author_id'=>32,'publisher'=>'pub');
		$json = json_encode($arr);
		$this->assertEqual(false,$this->bookModel->updateBooks($id,$json));
	}
	public function testUpdateBookInvalidAuthorIDValue() {
		$id = 1;
		$arr = array('author_id'=>'a string','publisher'=>'pub','title'=>'dinosaur');
		$json = json_encode($arr);
		$this->assertEqual(false,$this->bookModel->updateBooks($id,$json));
	}	
	
	public function testUpdateBookInvalidPublisherValue() {
		$id = 1;
		$arr = array('author_id'=>32,'publisher'=>17,'title'=>'dinosaur');
		$json = json_encode($arr);
		$this->assertEqual(false,$this->bookModel->updateBooks($id,$json));
	}
	
	public function testUpdateBookInvalidTitleValue() {
		$id = 1;
		$arr = array('author_id'=>32,'publisher'=>'pub','title'=>12);
		$json = json_encode($arr);
		$this->assertEqual(false,$this->bookModel->updateBooks($id,$json));
	}
		

	public function testDeleteBookInvalidID() {
		$id = "a string";
		$this->assertEqual(false,$this->bookModel->deleteBook($id));
	}
	
	public function testSearchBooksWithNumber() {
		$invalidInput = 1;
		$this->assertEqual(false,$this->bookModel->searchBooks($invalidInput));	
	}
	

	public function tearDown() {
		$this->ba = NULL;
	}
}
?>