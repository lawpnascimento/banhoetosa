<?php
  
/*require_once("../PersistenciaPadrao.php");*/
require_once("../../estrutura/conexao.php");

class CadastroPersistencia {
	
	protected $conexao;
	protected $Model;
	
	function __construct(){
		$this->conexao = new Conexao();
	} 
	
	public function getModel(){
		return $this->Model;
	}
	
	public function setModel($Model){
		$this->Model = $Model;
	}
	
	public function getConexao(){
		return $this->conexao;
	}
	
	public function Inserir(){
	
		
		$this->getConexao()->conectaBanco();
		
		$retorno = $this->validaCadastro();
		
		if($retorno != "4"){
			return $retorno;
		}
		else{
			$sSql = "INSERT INTO tbusuario (dsLogin, dsSenha, dsEmail, nrCpf, dsNome, dsSobrenome)
							  VALUES ('".$this->getModel()->getUsuario() ."'
									, '".$this->getModel()->getSenha() ."'
									, '".$this->getModel()->getEmail() ."'
									, '".$this->getModel()->getCpf() ."'
									, '".$this->getModel()->getNome() ."'
									,'".$this->getModel()->getSobrenome() ."')";
			
			
			
			$this->getConexao()->query($sSql); 
			
			return $retorno;
		}
		
		$this->getConexao()->fechaConexao();
	}
	
	public function validaCadastro(){
		$sSql = "select 1 from tbUsuario where dsLogin = '" . $this->getModel()->getUsuario() . "'"; 
		
		
		if( $oDados = $this->getConexao()->fetch_query($sSql) ) {
			return "1";
		} 
		
		$sSql = "select 1 from tbUsuario where nrCpf = '" . $this->getModel()->getCpf() . "'"; 
		if($oDados = $this->getConexao()->fetch_query($sSql)){
			return "2";
		} 
		
		$sSql = "select 1 from tbUsuario where dsEmail = '" . $this->getModel()->getEmail() . "'";
		if($oDados = $this->getConexao()->fetch_query($sSql)){
			return "3";
		}
		else{
			return "4";
		}
	}
}  
?>