<?php  

class Sql extends PDO { 

private $conn;

public function __construct(){

	$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");
}

private function setParams($statment, $parameters = array()){

	foreach ($parameters as $key => $value){ //Associar os comandos aos parâmentros 

		$this->setParam($statment,$key, $value);
	}
}	

private function setParam($statment,$key,$value){

	$statment->bindParam($key, $value);
}
 
public function query($rawQuery,$params = array()){ // Query e os Parametros

	$stmt = $this-> conn -> prepare($rawQuery);

	$this->setParams($stmt, $params);

	$stmt->execute();

	return $stmt;

}

public function select($rawQuery, $params = array()):array{

	$stmt = $this->query($rawQuery, $params);

	return $stmt->fetchall(PDO::FETCH_ASSOC);
}

}



?>