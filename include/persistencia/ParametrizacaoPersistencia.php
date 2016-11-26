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

    public function buscaPerfisDropdownUsuarios(){
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

    public function buscaSituacaoDropdownUsuarios(){
      $usuario = $this->getModel()->getUsuario();

      $this->getConexao()->conectaBanco();

      $sSql = "SELECT con.cdConstante
                  	 ,con.dsConstante
                 FROM tbusuario usu
                 JOIN tbconstante con
                   ON con.vlConstante = usu.idSituacao
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
        $empresa = $this->getModel()->getEmpresa();
        $usuario = intval($this->getModel()->getUsuario());
        $perfil = intval($this->getModel()->getPerfil());
        $situacao = intval($this->getModel()->getSituacao());

        $horarioDe = date("H:i", strtotime($this->getModel()->getHorarioDe()));
        $horarioAte = date("H:i", strtotime($this->getModel()->getHorarioAte()));

        if($situacao == 1)
            $inativo = "A";
        else
            $inativo = "I";

        $sSql = "UPDATE tbusuario usu
                	  SET usu.cdPerfil = " . $perfil ."
                	     ,usu.idSituacao = '" . $inativo ."'
                	WHERE usu.cdUsuario = " . $usuario;

        $this->getConexao()->query($sSql);

        $sSql = "UPDATE tbempresa emp
                	  SET emp.nmEmpresa = '" . $empresa ."'
                	     ,emp.hrInicial = '" . $horarioDe ."'
                       ,emp.hrFinal = '" . $horarioAte ."'
                	WHERE emp.cdEmpresa = 1";

        $this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();
    }

    public function buscaUsuario(){
        $this->getConexao()->conectaBanco();

        $usuario = intval($this->getModel()->getUsuario());

        $sSql = "SELECT con.cdConstante idSituacao
                       ,con.dsConstante dsSituacao
                       ,usu.cdUsuario cdUsuario
                       ,concat(dsNome, ' ', dsSobrenome) dsNome
                       ,per.cdPerfil cdPerfil
                       ,per.dsPerfil dsPerfil
                  FROM tbusuario usu
                  JOIN tbconstante con
                    ON con.vlConstante = usu.idSituacao
                   AND con.idConstante = 'SITUACAO_ATIVO_INATIVO'
                  JOIN tbPerfil per
                    ON per.cdPerfil = usu.cdPerfil
                 WHERE usu.cdUsuario = " . $usuario;

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';
        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"cdUsuario": "'.$linha["cdUsuario"].'"
                                    , "dsNome" : "'.$linha["dsNome"].'"
                                   , "cdPerfil" : "'.$linha["cdPerfil"].'"
                                   , "dsPerfil" : "'.$linha["dsPerfil"].'"
                                   , "dsSituacao" : "'.$linha["dsSituacao"].'"
                                   , "idSituacao" : "'.$linha["idSituacao"].'"}';
            //Para não concatenar a virgula no final do json
            if($qtdLinhas != $contador)
                $retorno = $retorno . ',';

        }
        $retorno = $retorno . "]";

        $this->getConexao()->fechaConexao();

        return $retorno;

    }

    function buscaEmpresa(){
      $this->getConexao()->conectaBanco();

      $empresa = intval($this->getModel()->getEmpresa());

      $sSql = "SELECT nmEmpresa nmEmpresa
                  	 ,hrInicial hrInicial
                		 ,hrFinal   hrFinal
                 FROM tbEmpresa emp
                WHERE emp.cdEmpresa = " . $empresa;

      $resultado = mysql_query($sSql);

      $qtdLinhas = mysql_num_rows($resultado);

      $contador = 0;

      $retorno = '[';
      while ($linha = mysql_fetch_assoc($resultado)) {

          $contador = $contador + 1;

          $retorno = $retorno . '{"nmEmpresa": "'.$linha["nmEmpresa"].'"
                                  , "hrInicial" : "'.$linha["hrInicial"].'"
                                 , "hrFinal" : "'.$linha["hrFinal"].'"}';
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
