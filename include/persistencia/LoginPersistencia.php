<?php
/*require_once("../PersistenciaPadrao.php");*/
require_once("../../estrutura/conexao.php");
session_start();
class LoginPersistencia {
	
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
	
	public function validaLogin(){
	    $login = $this->getModel()->getLogin();
        $senha = $this->getModel()->getSenha();

		$sSql = "select *
                   from tbUsuario
                  where dsLogin = '" . $login . "'" .
                  " and dsSenha = '" . $senha . "'";
					
			
		$this->getConexao()->conectaBanco();
		
		if( $oDados = $this->getConexao()->fetch_query($sSql) ) {
            $_SESSION["cdusuario"] = $oDados->cdUsuario;
            $_SESSION["nome"] = $oDados->dsNome;
			$logado = true;
		} else {
            Session_destroy();("../../estrutura/iniciar_sessao.php");

			$logado = false;
		}
		$this->getConexao()->fechaConexao();
		
		return $logado;
	}
}  
?>