<?php
require_once (realpath(dirname(__FILE__)."/../SimpleTest/autorun.php"));
require_once (realpath(dirname(__FILE__)."/../app/models/UserModel.php"));
require_once (realpath(dirname(__FILE__)."/../app/conf/config.inc.php"));
class UserModelTests extends UnitTestCase {
	private $userModel;
	
	public function setUp() {
		$this->userModel = new UserModel();
	}
	
	public function testGetUserInvalidID()
	{
		$this->assertEqual(false,$this->userModel->getUser("user"));
	}	
	
	public function testCreateNewUser() {
		//test invalid values
		$arr = array('name'=>'test','surname'=>'test','email'=>'test@test','password'=>'test');
		$json = json_encode($arr);
		$this->assertFalse($this->userModel->createNewUser($json));
		$arr = array('name'=>1,'surname'=>'test','email'=>'test@test','password'=>1);
		$json = json_encode($arr);
		$this->assertFalse($this->userModel->createNewUser($json));
		$arr = array('name'=>'test','surname'=>1,'email'=>'test@test','password'=>1);
		$json = json_encode($arr);
		$this->assertFalse($this->userModel->createNewUser($json));
		$arr = array('name'=>'test','surname'=>'test','email'=>1,'password'=>1);
		$json = json_encode($arr);
		$this->assertFalse($this->userModel->createNewUser($json));
		
		//test missing values
		$arr = array('surname'=>'test','email'=>'test@test','password'=>'test');
		$json = json_encode($arr);
		$this->assertFalse($this->userModel->createNewUser($json));
		$arr = array('name'=>'test','email'=>'test@test','password'=>'test');
		$json = json_encode($arr);
		$this->assertFalse($this->userModel->createNewUser($json));
		$arr = array('name'=>'test','surname'=>'test','password'=>'test');
		$json = json_encode($arr);
		$this->assertFalse($this->userModel->createNewUser($json));
		$arr = array('name'=>'test','surname'=>'test','email'=>'test@test');
		$json = json_encode($arr);
		$this->assertFalse($this->userModel->createNewUser($json));		
	}
	
	public function testUpdateUser() {
		$id = "mr bojangles";
		$arr = array('name'=>'test','surname'=>'test','email'=>'test@test','password'=>1);
		$json = json_encode($arr);
		$this->assertEqual(false,$this->userModel->updateUsers($id,$json));
		$id = 1;
		$arr = array('name'=>1,'surname'=>'test','email'=>'test@test','password'=>1);
		$json = json_encode($arr);
		$this->assertEqual(false,$this->userModel->updateUsers($id,$json));
		$id = 1;
		$arr = array('name'=>'test','surname'=>1,'email'=>'test@test','password'=>1);
		$json = json_encode($arr);
		$this->assertEqual(false,$this->userModel->updateUsers($id,$json));
		$id = 1;
		$arr = array('name'=>'test','surname'=>'test','email'=>1,'password'=>1);
		$json = json_encode($arr);
		$this->assertEqual(false,$this->userModel->updateUsers($id,$json));
		$id = 1;
		$arr = array('name'=>'test','surname'=>'test','email'=>'test@test','password'=>'test');
		$json = json_encode($arr);
		$this->assertEqual(false,$this->userModel->updateUsers($id,$json));
	}		

	public function testDeleteUser() {
		$id = "a string";
		$this->assertEqual(false,$this->userModel->deleteUser($id));
	}
	
	public function testSearchUsers() {
		$invalidInput = 1;
		$this->assertEqual(false,$this->userModel->searchUsers($invalidInput));	
	}
	

	public function tearDown() {
		$this->userModel = NULL;
	}
}
?>