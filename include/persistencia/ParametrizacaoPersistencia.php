<?php
require_once("../../estrutura/conexao.php");

class ParametrizacaoPersistencia {

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

    public function buscaUsuariosDropdown(){
        $this->getConexao()->conectaBanco();

        $sSql = "SELECT usu.cdUsuario cdUsuario
                    	 ,concat(dsNome, ' ', dsSobrenome) dsNome
                   FROM tbusuario usu";

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';
        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"cdUsuario": "'.$linha["cdUsuario"].'"
                                   , "dsNome" : "'.$linha["dsNome"].'"}';
            //Para não concatenar a virgula no final do json
            if($qtdLinhas != $contador)
               $retorno = $retorno . ',';

        }
        $retorno = $retorno . "]";

        $this->getConexao()->fechaConexao();

        return $retorno;
    }

    public function buscaPerfisDropdown(){
        $this->getConexao()->conectaBanco();

        $sSql = "SELECT per.cdPerfil cdPerfil
                  	   ,per.dsPerfil dsPerfil
                  FROM tbperfil per";

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';
        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"cdPerfil": "'.$linha["cdPerfil"].'"
                                   , "dsPerfil" : "'.$linha["dsPerfil"].'"}';
            //Para não concatenar a virgula no final do json
            if($qtdLinhas != $contador)
               $retorno = $retorno . ',';

        }
        $retorno = $retorno . "]";

        $this->getConexao()->fechaConexao();

        return $retorno;
    }

    public function buscaSituacoesDropdown(){
        $this->getConexao()->conectaBanco();

        $sSql = "SELECT con.cdConstante
                  		 ,con.dsConstante
                   FROM tbconstante con
                  WHERE con.idConstante = 'SITUACAO_ATIVO_INATIVO'";

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';
        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"cdSituacao": "'.$linha["cdConstante"].'"
                                   , "dsSituacao" : "'.$linha["dsConstante"].'"}';
            //Para não concatenar a virgula no final do json
            if($qtdLinhas != $contador)
               $retorno = $retorno . ',';

        }
        $retorno = $retorno . "]";

        $this->getConexao()->fechaConexao();

        return $retorno;
    }

    public function buscaPerfisDropdownUsuarios()
    {
      $usuario = $this->getModel()->getUsuario();

      $this->getConexao()->conectaBanco();

      $sSql = "SELECT per.cdPerfil cdPerfil
                     ,per.dsPerfil dsPerfil
                FROM tbperfil per
                JOIN tbUsuario usu
                  ON usu.cdPerfil = per.cdPerfil
               WHERE usu.cdUsuario = " . $usuario  ;



      $resultado = mysql_query($sSql);

      $qtdLinhas = mysql_num_rows($resultado);

      $contador = 0;

      $retorno = '[';
      while ($linha = mysql_fetch_assoc($resultado)) {

          $contador = $contador + 1;

          $retorno = $retorno . '{"cdPerfil": "'.$linha["cdPerfil"].'"
                                 , "dsPerfil" : "'.$linha["dsPerfil"].'"}';
          //Para não concatenar a virgula no final do json
          if($qtdLinhas != $contador)
             $retorno = $retorno . ',';

      }
      $retorno = $retorno . "]";

      $this->getConexao()->fechaConexao();

      return $retorno;

    }

    public function buscaSituacaoDropdownUsuarios()
    {
      $usuario = $this->getModel()->getUsuario();

      $this->getConexao()->conectaBanco();

      $sSql = "SELECT con.cdConstante
                  	 ,con.dsConstante
                 FROM tbusuario usu
                 JOIN tbconstante con
                   ON con.vlConstate = usu.idSituacao
                  AND con.idConstante = 'SITUACAO_ATIVO_INATIVO'
                WHERE usu.cdUsuario = " . $usuario  ;

      $resultado = mysql_query($sSql);

      $qtdLinhas = mysql_num_rows($resultado);

      $contador = 0;

      $retorno = '[';
      while ($linha = mysql_fetch_assoc($resultado)) {

          $contador = $contador + 1;

          $retorno = $retorno . '{"cdConstante": "'.$linha["cdConstante"].'"
                                 , "dsConstante" : "'.$linha["dsConstante"].'"}';
          //Para não concatenar a virgula no final do json
          if($qtdLinhas != $contador)
             $retorno = $retorno . ',';

      }
      $retorno = $retorno . "]";

      $this->getConexao()->fechaConexao();

      return $retorno;

    }



    public function Atualizar(){
        $this->getConexao()->conectaBanco();

        $nome = $this->getModel()->getNome();
        $raca = $this->getModel()->getRaca();
        $idade = intval($this->getModel()->getIdade());
        $porte = intval($this->getModel()->getPorte());
        $usuario = intval($this->getModel()->getUsuario());
        $codigo = intval($this->getModel()->getCodigo());

        $sSql = "UPDATE tbanimal ani
                	  SET ani.dsNome = '" . $nome ."'
                	     ,ani.dsRaca = '" . $raca ."'
                	     ,ani.nrIdade = " . $idade ."
                	     ,ani.cdPorte = " . $porte ."
                	WHERE ani.cdAnimal = " . $codigo;

        $this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();
    }


}




?>
