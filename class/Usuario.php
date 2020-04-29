<?php

class Usuario{

	private $ID;
	private $Nome;
	private $Senha;
	private $DataCadastro;


	public function getID(){
		return $this->ID;
	}

	public function setID($pID){

		$this->ID = $pID;
	}

	public function getNome(){
		return $this->Nome;
	}

	public function setNome($pNome){

		$this->Nome = $pNome;
	}

	public function getSenha(){
		return $this->Senha;
	}

	public function setSenha($pSenha){

		$this->Senha = $pSenha;
	}

	public function getDataCasdatro(){
		return $this->DataCadastro;
	}

	public function setDataCadastro($pDataCadastro){

		$this->DataCadastro = $pDataCadastro;
	}

	public function obterPorPK($ID){

		$sql = new Sql();

		$result = $sql->select("Select * From tbl_usuario Where ID = :ID", array(":ID"=>$ID));

			if (isset($result[0])){

			$row = $result[0];

			$this-> setID($row['ID']);
			$this-> setNome($row['Nome']);
			$this-> setSenha($row['Senha']);
			$this-> setDataCadastro(new dateTime($row['Data_Cadastro']));
			}
		}

		public function __toString(){

			return json_encode(array(
				"ID"=>$this->getID(),
				"Nome"=>$this->getNome(),
				"Senha"=>$this->getSenha(),
				"DataCastro"=>$this->getDataCasdatro()->format("d/m/Y H:i:s")
			));

		}

}

?>