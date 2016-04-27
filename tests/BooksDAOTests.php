<?php
class BooksDAOTests extends UnitTestCase {
	private $bDao;
	public function setUp() {
		$this->bDao = new BooksDAO ();
	}
	public function testGet()
	{
		$this->assertEqual();
	}
	
	public function testUpdate()
	{}
	
	public function testPost()
	{}
	
	public function testDelete()
	{}

	public function tearDown() {
		$this->bDao = NULL;
	}
}
?>