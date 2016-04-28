<?php
/**
 * @author Daniel
 * definition of the Books DAO
 */
class BooksDAO {
	private $dbManager;
	function BooksDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}
	public function get($id = null) {
		$sql = "SELECT * ";
		$sql .= "FROM books ";
		if ($id != null)
			$sql .= "WHERE books.book_id=? ";
		$sql .= "ORDER BY books.title ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $id, $this->dbManager->INT_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		$rows = $this->dbManager->fetchResults ( $stmt );
		
		return ($rows);
	}
	public function insert($parametersArray) {
		// insertion assumes that all the required parameters are defined and set
		$sql = "INSERT INTO books (author_id, publisher, title) ";
		$sql .= "VALUES (?,?,?) ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $parametersArray ["author_id"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 2, $parametersArray ["publisher"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 3, $parametersArray ["title"], $this->dbManager->STRING_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		
		return ($this->dbManager->getLastInsertedID ());
	}
	public function update($parametersArray, $bookID) {
		//TODO
		if(!empty($bookID)
			&&!empty($parametersArray["author_id"])
			&&!empty($parametersArray["publisher"])
			&&!empty($parametersArray["title"])
			){
			echo "not empty";
			$id = $bookID;
			$authorID=$parametersArray["author_id"];
			$publisher=$parametersArray["publisher"];
			$title=$parametersArray["title"];

			$sql = "UPDATE books ";
			$sql .= "SET author_id = ?, publisher = ?, title = ?";
			$sql .= "WHERE book_id = ?;";
			echo $sql;
			$stmt = $this->dbManager->prepareQuery($sql);
		
			$this->dbManager->bindValue($stmt, 1 ,$authorID, $this->dbManager->STRING_TYPE);
			$this->dbManager->bindValue($stmt, 2 ,$publisher, $this->dbManager->STRING_TYPE);
			$this->dbManager->bindValue($stmt, 3 ,$title, $this->dbManager->STRING_TYPE);
			$this->dbManager->bindValue($stmt, 4 ,$id, $this->dbManager->STRING_TYPE);

			//execute the query
			$this->dbManager->executeQuery($stmt);
			
			return true;	
		}else
		echo "empty";
	}
	public function delete($bookID) {
		//TODO
		if(!empty($bookID)){
			echo "book_id to be deleted	". $bookID;

			$sql="DELETE FROM books ";
			$sql.= "WHERE book_id = ?;";

			$stmt = $this->dbManager->prepareQuery($sql);

			$this->dbManager->bindValue($stmt, 1 ,$bookID, $this->dbManager->STRING_TYPE);

			//execute the query
			$this->dbManager->executeQuery($stmt);
			
			return true;
		}else
			echo "empty". $bookID;
	}
	public function search($string) {
		if(!empty($string))
		{
			$sql="SELECT * FROM books ";
			$sql.="WHERE title LIKE ?;";

			//echo $sql;

			//Prepare Query
			$stmt = $this->dbManager->prepareQuery($sql);

			//Bind Values
			$this->dbManager->bindValue($stmt, 1, $string, $this->dbManager->STRING_TYPE);
			
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

