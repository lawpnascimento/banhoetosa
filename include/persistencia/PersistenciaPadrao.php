<?php
require_once("../estrutura/conexao.php");
  
class PersistenciaPadrao {
	
	protected $conexao;
	protected $Model;
	
	function __construct(){
		$this->conexao = new Conexao();
	}
	
	public function setModel($Model){
		echo "TESTEEEEEEEEEEEEEEEE";
		$this->Model = $Model;
	}

	public function getConexao(){
		$this->conexao;
	}
}  
?>