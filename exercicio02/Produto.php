<?php

require_once('Sql.php');

class Produto{
	//ORM
	private $idProduto;
	private $produto;
	private $preco;
	private $idCategoria;

	public function getIdproduto(){
		return $this->idProduto;
	}

	public function getProduto(){
		return $this->produto;
	}

	public function getPreco(){
		return $this->preco;
	}

	public function getIdCategoria(){
		return $this->idCategoria;
	}

	public function setIdproduto($idProduto){
		$this->idProduto = $idProduto;
	}
	public function setProduto($produto){
		$this->produto = $produto;
	}
	public function setPreco($preco){
		$this->preco = $preco;
	}
	public function setIdcategoria($idCategoria){
		$this->idCategoria = $idCategoria;
	}


	public function loadById($idProduto){
		$sql = new Sql();

		$results = $sql->select("
					SELECT * FROM produtos 
					WHERE idProduto=:IDPRODUTO"
					,[":IDPRODUTO"=>$idProduto]);

		//return $results;
		if(isset($results[0])){//caso retorne uma linha
			$row = $results[0];

			$this->setIdproduto($row['idProduto']);
			$this->setProduto($row['produto']);
			$this->setPreco($row['preco']);
			$this->setIdcategoria($row['idCategoria']);

			return true;
		}

		return false;
	}

	public function __toString(){

		$arr = [
			"idProduto" => $this->getIdproduto(),
			"produto" => $this->getProduto(),
			"preco" => $this->getPreco(),
			"idCategoria"=> $this->getIdCategoria()
		];

		return json_encode($arr);// converte array => json
	}

	public static function getList(){
		$sql = new Sql();

		$arr = $sql->select("SELECT * from pedidos");
		return json_encode($arr);
	}
	public function setData($produto,$preco,$idCategoria){

		$this->setProduto($produto);
		$this->setPreco($preco);
		$this->setIdcategoria($idCategoria);
	}

	public function insert(){
		$sql = new Sql();

		$sql->query("INSERT INTO produtos(produto,preco,idCategoria)
				VALUES(:produto,:preco,:idCategoria)

			",[
				"produto"=>$this->getProduto(),
				"preco"=>$this->getPreco(),
				"idCategoria"=>$this->getIdCategoria()
			]);

	}

	public function update(){

		$sql = new Sql();

		$sql->query("UPDATE produtos 
			SET produto =:produto , preco = :preco, idCategoria=:idCategoria WHERE idProduto = :idProduto",
		[
			":produto" => $this->getProduto(),
			":preco" => $this->getPreco(),
			":idCategoria"=> $this->getIdCategoria(),
			":idProduto"=>$this->getIdproduto()
		]);
	}

	public static function search($produto){
		$sql = new Sql();
		$arr = $sql->select("	SELECT * FROM produtos 
						WHERE produto LIKE :string ORDER BY produto ",

			[
				":string" => "%".$produto."%"
			]
		);

		if(isset($arr[0])){//se a pesquisa retornou um valor
			$aux = $arr[0];

			$pr = new Produto();
			$pr->setIdproduto($aux['idProduto']);
			$pr->setProduto($aux['produto']);
			$pr->setPreco($aux['preco']);
			$pr->setIdcategoria($aux['idCategoria']);
			return $pr;

		}else{
			return null;
		}
	}

	public function delete(){

		$sql = new Sql();

		$sql->query("DELETE FROM detpedidos WHERE idProduto=:idProduto",[
			":idProduto"=>$this->getIdproduto()
		]);

		$sql->query("DELETE FROM produtos WHERE idProduto=:idProduto",[
			":idProduto"=>$this->getIdproduto()
		]);
	}



}



?>
