<?php
/*
 * @author Tomas Belskis
 */
require_once (realpath(dirname(__FILE__)."/../SimpleTest/autorun.php"));
require_once (realpath(dirname(__FILE__).'/../app/models/Validation.php'));

class TestValidationClass extends UnitTestCase{
	private $validation;
	
	public function setUp () {
	 
	 $this -> v = new validation() ;
	 }
	 
	 public function testEmail(){
	 	$testArr = array (
				"" 
		);
		$testObject = new Validation();
	 	$this->assertFalse($this -> v -> isEmailValid("eadfadadf"));
	 	$this->assertFalse($this -> v -> isEmailValid("123141231"));
	 	$this->assertFalse($this -> v -> isEmailValid("eadfadadf@"));
	 	$this->assertFalse($this -> v -> isEmailValid("eadfadadf@gmail"));
	 	$this->assertFalse($this -> v -> isEmailValid(NULL));
	 	$this->assertFalse($this -> v -> isEmailValid(12321));
	 	$this->assertFalse($this -> v -> isEmailValid(-1));
	 	$this->assertTrue($this -> v -> isEmailValid("eadfadadf@gmail.com"));
	
	 }
	 public function testNumberRange(){
	 	
	 	$testArr = array (
				"" 
		);
		$testObject = new Validation();
	 	$this->assertFalse($this -> v -> isNumberInRangeValid(3,2,1));
	 	$this->assertFalse($this -> v -> isNumberInRangeValid(1,3,2));
	 	$this->assertFalse($this -> v -> isNumberInRangeValid("adsa","adsaf","fadsa"));
	 	$this->assertFalse($this -> v -> isNumberInRangeValid(-1,-3,-2));
	 	$this->assertFalse($this -> v -> isNumberInRangeValid(Null,Null,Null));
	 	$this->assertFalse($this -> v -> isNumberInRangeValid($testArr,$testArr,$testArr));
	 	$this->assertFalse($this -> v -> isNumberInRangeValid($testObject,$testObject,$testObject));
			 	
	 }
	 public function testLenghString(){
	 	$testArr = array (
				"" 
		);
		$testObject = new Validation();
	 	$this->assertFalse($this -> v -> isLengthStringValid("aadsafad",2));
	 	$this->assertFalse($this -> v -> isLengthStringValid("aadsafad",-2));
	 	$this->assertFalse($this -> v -> isLengthStringValid(Null,Null));
	 	$this->assertFalse($this -> v -> isLengthStringValid(4,"adsasf"));
	 	$this->assertFalse($this -> v -> isLengthStringValid("aadsafad","adsasf"));
	 	$this->assertFalse($this -> v -> isLengthStringValid($testArr,"adsasf"));
	 	$this->assertFalse($this -> v -> isLengthStringValid($testArr,$testArr));
	 	$this->assertFalse($this -> v -> isLengthStringValid($testObject,$testObject));
	 	$this->assertTrue($this -> v -> isLengthStringValid("adsa",4));
	 	
	
	 }
	 public function tearDown(){
	 	$this -> v = NULL;
	 }
}
?>