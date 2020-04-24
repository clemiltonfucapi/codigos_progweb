<?php

class Sql extends PDO{

	private $conn;

	public function __construct(){
		$this->conn = new PDO('mysql:dbname=aula_php;host=127.0.0.1;charset=utf8','root','',[
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
		]);
	}

	public function query($comando,$parametros=array() ){ // INSERCAO, REMOCAO e ATUALIZACAO
		$stmt = $this->conn->prepare($comando);
		/*
		foreach($parametros as $chave => $valor){
			$stmt->bindParam($chave,$valor);
			echo $chave.':'.$valor.'<br>';		
		}
			var_dump($stmt);		
		*/
		$stmt->execute($parametros);	

		return $stmt;

	}



	public function select($comando,$parametros=array() ){
		$stmt = $this->query($comando,$parametros);

		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $results;
	}


}

?>