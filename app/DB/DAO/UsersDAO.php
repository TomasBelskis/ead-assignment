<?php
/**
 * @author Tomas Belskis
 */
class UsersDAO {
	private $dbManager;
	function UsersDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}
	public function get($id = null) {
		$sql = "SELECT * ";
		$sql .= "FROM users ";
		if ($id != null)
			$sql .= "WHERE users.id=? ";
		$sql .= "ORDER BY users.name ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $id, $this->dbManager->INT_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		$rows = $this->dbManager->fetchResults ( $stmt );
		
		return ($rows);
	}
	public function insert($parametersArray) {
		// insertion assumes that all the required parameters are defined and set
		$sql = "INSERT INTO users (name, surname, email, password) ";
		$sql .= "VALUES (?,?,?,?) ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $parametersArray ["name"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 2, $parametersArray ["surname"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 3, $parametersArray ["email"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 4, $parametersArray ["password"], $this->dbManager->STRING_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		
		return ($this->dbManager->getLastInsertedID ());
	}
	public function update($parametersArray, $userID) {
		//TODO
		if(!empty($userID)
			&&!empty($parametersArray["name"])
			&&!empty($parametersArray["surname"])
			&&!empty($parametersArray["email"])
			&&!empty($parametersArray["password"])
			){
			//echo "not empyty";
			$id = $userID;
			$name=$parametersArray["name"];
			$surname=$parametersArray["surname"];
			$email=$parametersArray["email"];
			$password=$parametersArray["password"];


			$sql = "UPDATE users ";
			$sql .= "SET name = ?, surname = ?, email = ?, password = ? ";
			$sql .= "WHERE id = ?;";
			//echo $sql;
			$stmt = $this->dbManager->prepareQuery($sql);
		
			$this->dbManager->bindValue($stmt, 1 ,$name, $this->dbManager->STRING_TYPE);
			$this->dbManager->bindValue($stmt, 2 ,$surname, $this->dbManager->STRING_TYPE);
			$this->dbManager->bindValue($stmt, 3 ,$email, $this->dbManager->STRING_TYPE);
			$this->dbManager->bindValue($stmt, 4 ,$password, $this->dbManager->STRING_TYPE);
			$this->dbManager->bindValue($stmt, 5 ,$id, $this->dbManager->STRING_TYPE);

			//execute the query
			$this->dbManager->executeQuery($stmt);
			
			return true;	
		}else
		echo "empty";
	}
	public function delete($userID) {
		//TODO
		if(!empty($userID)){
			echo "userID to be deleted	". $userID;

			$sql="DELETE FROM users ";
			$sql.= "WHERE id = ?;";

			$stmt = $this->dbManager->prepareQuery($sql);

			$this->dbManager->bindValue($stmt, 1 ,$userID, $this->dbManager->STRING_TYPE);

			//execute the query
			$this->dbManager->executeQuery($stmt);
			
			return true;
		}else
			echo "empty". $userID;
	}
	public function search($string) {
		//TODO
	
		if(!empty($string))
		{
			$sql="SELECT * FROM users ";
			$sql.="WHERE name LIKE ? OR surname LIKE ?;";

			//echo $sql;

			//Prepare Query
			$stmt = $this->dbManager->prepareQuery($sql);

			//Bind Values
			$this->dbManager->bindValue($stmt, 1, $string, $this->dbManager->STRING_TYPE);
			$this->dbManager->bindValue($stmt, 2, $string, $this->dbManager->STRING_TYPE);
			
			//Execute statement
			$this->dbManager->executeQuery($stmt);

			//Fetch results
			$result = $this->dbManager->fetchResults($stmt);

			return $result;

		}else
		echo "Error empty search string" . $string;
		
	}
	
	public  function authenticate($username, $password){
		if(!empty($username)&&!empty($password)){
			$sql="SELECT * FROM users ";
			$sql.="WHERE name = ? AND password = ?;";
			
	
			
			$stmt = $this->dbManager->prepareQuery($sql);
			
			$this->dbManager->bindValue($stmt, 1, $username, $this->dbManager->STRING_TYPE);
			$this->dbManager->bindValue($stmt, 2, $password, $this->dbManager->STRING_TYPE);
			
			$this->dbManager->executeQuery($stmt);
			
			$result = $this->dbManager->fetchResults($stmt);

			
			if(!empty($result)){
				return true;
			}
			
			if(empty($result)){
				return false;
			}
			
		}else 
		echo "Error empty username and/or password! ". $username . " " . $password;
	}
}
?>
