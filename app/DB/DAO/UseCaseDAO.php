<?php
/**
 * @author Daniel
 * definition of Use Case DAO
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
			$this->dbManager->bindValue($stmt, 2 ,$publisher, $this->dbManager->STRING_TYPE);
			
			//execute the query
			$this->dbManager->executeQuery($stmt);
			return true;
		}else
			echo "empty";
	}
}
?>
