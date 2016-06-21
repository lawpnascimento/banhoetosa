<?php
require_once("../../estrutura/conexao.php");

class ClientePersistencia {

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

  public function BuscaClientes(){
        $this->getConexao()->conectaBanco();

        $sSql = "SELECT usu.cdUsuario cdUsuario
                  	   ,concat(usu.dsNome, ' ', usu.dsSobrenome) dsNome
                  	   ,usu.dsEmail dsEmail
                  		 ,usu.nrCpf nrCpf
                  		 ,usu.nrTelefone nrTelefone
                       ,per.dsPerfil dsPerfil
                   FROM tbusuario usu
                   JOIN tbperfil per
                  	 ON per.cdPerfil = usu.cdPerfil";

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';
        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"cdUsuario": "'.$linha["cdUsuario"].'"
                                   , "dsNome" : "'.$linha["dsNome"].'"
                                   , "dsEmail" : "'.$linha["dsEmail"].'"
                                   , "nrCpf" : "'.$linha["nrCpf"].'"
                                   , "dsPerfil" : "'.$linha["dsPerfil"].'"
                                   , "nrTelefone" : "'.$linha["nrTelefone"].'"}';

            //Para não concatenar a virgula no final do json
            if($qtdLinhas != $contador)
                $retorno = $retorno . ',';

        }
        $retorno = $retorno . "]";

        $this->getConexao()->fechaConexao();

        return $retorno;
    }

}


?>
