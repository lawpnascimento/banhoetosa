<?php
require_once("../../estrutura/conexao.php");

class PrincipalPersistencia {

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


    public function buscaHoraParametrizada(){
        $this->getConexao()->conectaBanco();


        $sSql = "SELECT HOUR(emp.hrInicial) hrInicial
                     	 ,HOUR(emp.hrFinal) hrFinal
                   FROM tbempresa emp";

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';
        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"hrInicial": "'.$linha["hrInicial"].'"
                                   , "hrFinal" : "'.$linha["hrFinal"].'"}';
            //Para não concatenar a virgula no final do json
            if($qtdLinhas != $contador)
                $retorno = $retorno . ',';

        }
        $retorno = $retorno . "]";

        $this->getConexao()->fechaConexao();

        return $retorno;

    }

    public function validaHorarioAgendamento(){
      $this->getConexao()->conectaBanco();
      $data = date("m/d/y",strtotime(str_replace('/','-',$this->getModel()->getData())));
      $horarioDe = $this->getModel()->getHorarioDe();
      $horarioAte = $this->getModel()->getHorarioAte();
      
      $sSql = "SELECT 1
                 FROM tbagendamento age
                WHERE age.dtAgendamento = STR_TO_DATE('". $data ."','%m/%d/%Y')
                  AND '". $horarioDe ."' <  hour(age.hrfinal)
                  AND '". $horarioAte ."' > hour(age.hrinicial)
                  AND cdSituacao = 3";

      if($oDados = $this->getConexao()->fetch_query($sSql)){
        $this->getConexao()->fechaConexao();
        return "1"; //Reservado

      }
      else {
        $this->getConexao()->fechaConexao();
        return "2"; //Não reservado
      }

  	}



}




?>
