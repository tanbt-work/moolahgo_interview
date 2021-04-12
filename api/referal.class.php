<?php
include('connection/Database.php');

class Referal
{
	private $code;

	private $db;
	private $method;
	function __construct($code = '') {
		$this->db = DB::getInstance();
		$this->code = $code;
	}

	function getMethod($method,$route){
		switch ($method) {
		case 'GET':
			return self::doGet($route);
			break;
		case 'POST':
			if(empty($route[1])){
				return self::doPost();
			}else{
				return $arr_json = array('status' => 404);
			} 
			break;
		default:
			return array('status' => 405);
      		break;
		}
	}

	function doGet($route){
		$sql = 'SELECT * FROM referal_code WHERE code = :code';
	    $stmt = $this->db->prepare($sql);
	    $stmt->bindValue(":code", $route[1]);
	    $stmt->execute();

	    if($stmt->rowCount() > 0){
	    	$row  = $stmt->fetch(PDO::FETCH_ASSOC);
			return $arr_json = array('status' => 200, 'msg' => 'Found owner: ' .$row['owner']);
	    }else{
			return $arr_json = array('status' => 400, 'errors' => 'Owner not exists');
	    }
	}
	function doPost(){
		//POST method
		$sql = 'SELECT owner FROM referal_code WHERE code = :code';
	    $stmt = $this->db->prepare($sql);
	    $stmt->bindValue(':code', $this->code);
	    $stmt->execute();

	    if($stmt->rowCount() > 0){
			$row  = $stmt->fetch(PDO::FETCH_ASSOC);
			return $arr_json = array('status' => 200, 'msg' => 'Found owner: ' .$row['owner']. ", referred success", 'success' => true);
	    }else{
			return $arr_json = array('status' => 400, 'errors' => 'Owner not exists', 'success' => false);
	    }
		
	}
	
}
?>