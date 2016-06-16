<?php
require_once("../../estrutura/conexao.php");

class AvaliacaoPersistencia {

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

    public function BuscaAgendamentos(){
        $this->getConexao()->conectaBanco();

        $usuario = intval($this->getModel()->getUsuario());

        $sSql = "SELECT age.cdAgendamento cdAgendamento
                       ,age.hrInicial hrInicial
                       ,age.hrFinal hrFinal
                       ,age.dtAgendamento dtAgendamento
                       ,age.cdUsuario cdUsuario
                       ,usu.dsNome nmUsuario
                       ,ani.dsNome nmAnimal
                       ,ani.cdAnimal cdAnimal
                   FROM tbagendamento age
                   JOIN tbusuario usu
                     ON usu.cdUsuario = age.cdUsuario
                   JOIN tbanimal ani
                     ON ani.cdAnimal = age.cdAnimal
                  WHERE age.cdUsuario = " .$usuario."
                    ORDER BY cdAgendamento";

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';
        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"dtAgendamento": "'.$linha["dtAgendamento"].'"
                                   , "hrInicial" : "'.$linha["hrInicial"].'"
                                   , "hrFinal" : "'.$linha["hrFinal"].'"
                                   , "nmAnimal" : "'.$linha["nmAnimal"].'"
                                   , "cdAgendamento" : "'.$linha["cdAgendamento"].'"
                                   , "cdAnimal" : "'.$linha["cdAnimal"].'"}';
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
