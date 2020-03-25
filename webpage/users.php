<?php
class UsersRepo {
	private $db;
	public $getUserStmt;
	private $addUserStmt;

	public function __construct($db){
		$this->db = $db;
		$this->getUserStmt = $db->prepare('SELECT * FROM users WHERE username = ?');
		$this->addUserStmt = $db->prepare('INSERT users(username, password, fullname, email) VALUES(?,?,?,?)');
	}

	public function getUser($username) {
		$this->getUserStmt->execute(array($username));
		if($this->getUserStmt->rowCount()>0){
			return $this->getUserStmt->fetch();
		}
		return null;
	}
	
	public function addUser($username, $password, $fullname, $email) {
		if(!$this->getUser($username)) {
			$this->addUserStmt->execute(array($username, $password, $fullname, $email));
		}
	}

}

?>