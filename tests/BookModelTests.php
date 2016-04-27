<?php
class BookModelTests extends UnitTestCase {
	private $bookModel;
	public function setUp() {
		$this->$bookModel = new BookModel();
	}
	
	public function testGetBookInvalidID()
	{
		$this->assertEqual(false,$this->bookModel->getBooks("give me a book please"));
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
	public function testUpdateBookInvalidStructure() {
		$id = 1;
		$arr = array('author_id'=>32,'publisher'=>'pub');
		$json = json_encode($arr);
		$this->assertEqual(false,$this->bookModel->updateBooks($id,$json));
	}
	public function testUpdateBookInvalidAuthorIDValue() {
		$arr = array('author_id'=>'a string','publisher'=>'pub','title'=>'dinosaur');
		$json = json_encode($arr);
		$this->assertEqual(false,$this->bookModel->createNewBook($json));
	}
	
	public function testUpdateBookInvalidPublisherValue() {
		$arr = array('author_id'=>32,'publisher'=>17,'title'=>'dinosaur');
		$json = json_encode($arr);
		$this->assertEqual(false,$this->bookModel->createNewBook($json));
	}
	public function testUpdateBookInvalidTitleValue() {
		$arr = array('author_id'=>32,'publisher'=>'pub','title'=>12);
		$json = json_encode($arr);
		$this->assertEqual(false,$this->bookModel->updateBooks($json));
	}
	public function testUpdateBooks() {
	}
	
	public function testSearchBooksWithNumber() {
		
	
	}
	
	public function testDeleteBook() {}
	

	public function tearDown() {
		$this->ba = NULL;
	}
}
?>