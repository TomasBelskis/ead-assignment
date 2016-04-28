<?php
/*
 * @author Tomas Belskis
 */
class PublisherDAO{
	private $dbManager;
	
	function PublisherDAO($DBMngr){
		$this->dbManager = $DBMngr;
	}
		
	//gets publisher on it's id	
	public function get($publisher = null) {
		$sql = "SELECT * ";
		$sql .= "FROM publishers ";
		if ($publisher != null)
			$sql .= "WHERE publishers.publisher=? ";
		$sql .= "ORDER BY publishers.publisher ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $publisher, $this->dbManager->STRING_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		$rows = $this->dbManager->fetchResults ( $stmt );
		
		return ($rows);
	}
	
	//inserts a new publisher
	public function insert($parametersArray) {
		// insertion assumes that all the required parameters are defined and set
		$sql = "INSERT INTO publishers (publisher, address, phone) ";
		$sql .= "VALUES (?,?,?) ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $parametersArray ["publisher"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 2, $parametersArray ["address"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 3, $parametersArray ["phone"], $this->dbManager->STRING_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		
		return $parametersArray["publisher"];
		//return ($this->dbManager->getLastInsertedID ());
	}
	
	//updates publisher record
	public function update($parametersArray, $publisher) {
		//TODO
		if(!empty($publisher)
			&&!empty($parametersArray["address"])
			&&!empty($parametersArray["phone"])
			){
			//echo "not empyty";
			$publisherId = $publisher;
			$address=$parametersArray["address"];
			$phone=$parametersArray["phone"];


			$sql = "UPDATE publishers ";
			$sql .= "SET address = ?, phone = ? ";
			$sql .= "WHERE publisher = ?;";
			//echo $sql;
			$stmt = $this->dbManager->prepareQuery($sql);
		
			$this->dbManager->bindValue($stmt, 1 ,$address, $this->dbManager->STRING_TYPE);
			$this->dbManager->bindValue($stmt, 2 ,$phone, $this->dbManager->STRING_TYPE);
			$this->dbManager->bindValue($stmt, 3 ,$publisherId, $this->dbManager->STRING_TYPE);

			//execute the query
			$this->dbManager->executeQuery($stmt);
			
			return true;	
		}else
		echo "empty";
	}
	
	//Removing publisher
	public function delete($publisher) {
		//TODO 
		if(!empty($publisher)){
			echo "Publisher about to be removed ". $publisher;

			$sql="DELETE FROM publishers ";
			$sql.= "WHERE publisher = ?;";

			$stmt = $this->dbManager->prepareQuery($sql);

			$this->dbManager->bindValue($stmt, 1 ,$publisher, $this->dbManager->STRING_TYPE);
			
			//execute the query
			$this->dbManager->executeQuery($stmt);
			
			return true;
		}else
			echo "empty". $publisher;
	}
	
	//Searching for publisher on string address
	public function search($address) {
		//TODO
	
		if(!empty($address))
		{
			$address = "%" . $address . "%";
			$sql="SELECT * FROM publishers ";
			$sql.="WHERE address LIKE ?;";

			//echo $sql;
	
			//Prepare Query
			$stmt = $this->dbManager->prepareQuery($sql);

			//Bind Values
			$this->dbManager->bindValue($stmt, 1, $address, $this->dbManager->STRING_TYPE);
			
			//Execute statement
			$this->dbManager->executeQuery($stmt);

			//Fetch results
			$result = $this->dbManager->fetchResults($stmt);

			return $result;

		}else
		echo "Error empty search string" . $string;
		
	}

}
?>