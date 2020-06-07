<?php

class Usuario{

	private $ID;
	private $Nome;
	private $Senha;
	private $DataCadastro;

// Atribui vazio ("") nos atributos pra não afetar quando eu instanciar uma classe sem parametros no construtor 
	public function __construct($pNome = "", $pSenha = ""){  
		$this->setNome($pNome);
		$this->setSenha($pSenha);
	}


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

			$this->setData($result[0]);
			}
		}

	public static function listarUsuarios(){

		$sql = new Sql();
			return $sql->select("Select * From tbl_usuario order by nome");

	}

	public static function search($nome){
		$sql = new Sql();

		return $sql->select ("Select * From tbl_usuario where nome like :SEARCH order by nome",array(
			":SEARCH"=>"%".$nome."%"));
	}

	public function login($nome,$senha){

		$sql = new Sql();

		$result = $sql->select("Select * From tbl_usuario Where Nome = :Nome and Senha = :Senha", array(
			":Nome"=>$nome,
			":Senha"=>$senha));

			if (isset($result[0])){

			$row = $result[0];

			$this->setData($result[0]);

			}
			else{
				throw new Exception ("logind e senha invalidos");
			} 
	}
	public function setData($data){ 

		$this-> setID($data['ID']);
		$this-> setNome($data['Nome']);
		$this-> setSenha($data['Senha']);
		$this-> setDataCadastro(new DateTime($data['Data_Cadastro']));		
	}

	public function alterar($Nome, $Senha){
		$this->setNome($Nome);
		$this->setSenha($Senha);

		$sql = new Sql();
		$sql->query("UPDATE tbl_usuario SET Nome = :NOME, Senha = :SENHA Where ID = :ID",array(
			':NOME'=>$this->getNome(),
			':SENHA'=>$this->getSenha(),
			':ID'=>$this->getID()
		));
	}

	public function excluir(){
		$sql = new Sql();
		$sql->query("DELETE from tbl_usuario where ID = :ID", array(
			':ID'=>$this->getID()
		));

		$this->setID(0);
		$this->setNome("");
		$this->setSenha("");
		$this->setDataCadastro(new DateTime(""));
	}

	public function incluir (){

		$sql =  new Sql();
		$result = $sql->select("Call sp_usuarios_insert(:NOME, :SENHA)", array(
			':NOME'=>$this->getNome(),
			':SENHA'=>$this->getSenha()
		));

		if (isset($result[0])){
			$this->setData($result[0]);
		}
	}
/* Criando uma Procedure 
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usuarios_insert`(
pnome varchar(64),
psenha varchar(256)
)
BEGIN
	insert into tbl_usuario (Nome,Senha) values (pnome, psenha); 
    select * From tbl_usuarios where ID = Last_Insert_ID();
END	*/

	
	public function __toString(){
		return json_encode(array(
			"ID"=>$this->getID(),
			"Nome"=>$this->getNome(),
			"Senha"=>$this->getSenha(),
			"DataCadastro"=>$this->getDataCasdatro()->format("d/m/Y H:i:s")
		));
	}
}

?>