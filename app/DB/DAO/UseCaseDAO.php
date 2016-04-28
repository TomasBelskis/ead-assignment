<?php
/**
 * @author Daniel
 * @author Tomas
 */
class UseCaseDAO {
	private $dbManager;
	function UseCaseDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}
	
	public function PublisherAcquiresAuthors($publisher,$author_id)
	{
		if(!empty($publisher)&&!empty($author_id))
		{
			//echo "not empty";
			$sql = "UPDATE books ";
			$sql .= "SET publisher = ?";
			$sql .= "WHERE author_id = ?;";
			//echo $sql;
			
			$stmt = $this->dbManager->prepareQuery($sql);
			$this->dbManager->bindValue($stmt, 1 ,$publisher, $this->dbManager->STRING_TYPE);
			$this->dbManager->bindValue($stmt, 2 ,$author_id, $this->dbManager->STRING_TYPE);
			
			//execute the query
			$this->dbManager->executeQuery($stmt);
			return true;
		}else
			echo "empty";
	}
	
	//Adds book to an existing publisher and existing author
	public function insertBook($author,$publisher,$parameters){
		if(!empty($author)&&!empty($publisher)&&!empty($parameters)){
			$sql = "INSERT INTO books (author_id, publisher, title)";
			$sql .= "VALUES (?, ?, ?);";
	
			$stmt = $this->dbManager->prepareQuery ( $sql );
			$this->dbManager->bindValue ( $stmt, 1, $author, $this->dbManager->STRING_TYPE );
			$this->dbManager->bindValue ( $stmt, 2, $publisher, $this->dbManager->STRING_TYPE );
			$this->dbManager->bindValue ( $stmt, 3, $parameters ["title"], $this->dbManager->STRING_TYPE );
			$this->dbManager->executeQuery ( $stmt );
		
			return ($this->dbManager->getLastInsertedID ());
		
		}else 
			echo "empty";
	}
}
?>
