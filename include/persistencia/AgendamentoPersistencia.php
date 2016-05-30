<?php
require_once("../../estrutura/conexao.php");

class AgendamentoPersistencia {

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

        $horarioDe = date("h:i", strtotime($this->getModel()->getHorarioDe()));
        $horarioAte = date("h:i", strtotime($this->getModel()->getHorarioAte()));
        $animal = intval($this->getModel()->getAnimal());
        $data = date("m/d/y",strtotime(str_replace('/','-',$this->getModel()->getData())));
        $usuario = intval($this->getModel()->getUsuario());

        $sSql = "INSERT INTO tbagendamento (hrInicial, hrFinal, cdAnimal, dtAgendamento, cdUsuario)
                          VALUES ('". $horarioDe ."'
                                ,'". $horarioAte ."'
                                , ". $animal ."
                                , STR_TO_DATE('". $data ."','%m/%d/%Y')
                                ,  ". $usuario .")";

        $this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();
    }

    public function BuscaAgendamentos(){
        $this->getConexao()->conectaBanco();

        $usuario = intval($this->getModel()->getUsuario());
        $codigo = intval($this->getModel()->getCodigo());
        $data = $this->getModel()->getData();
        $horarioDe = $this->getModel()->getHorarioDe() ;
        $horarioAte = $this->getModel()->getHorarioAte();
        $animal = $this->getModel()->getAnimal();

        if($codigo == null){
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
                      WHERE age.cdUsuario = " .$usuario;

            if($data != null){
                $sSql = $sSql . " AND age.dtAgendamento = STR_TO_DATE('". date("m/d/y",strtotime(str_replace('/','-',$data))) ."','%m/%d/%Y')";
            }

            if($horarioDe != null){
                $sSql = $sSql . " AND age.hrInicial >= '". date("h:i", strtotime($horarioDe)) ."'";
            }

            if($horarioAte != null){
                $sSql = $sSql . " AND age.hrFinal <= '". date("h:i", strtotime($horarioAte)) ."'";
            }

            if($animal != null){
                $sSql = $sSql . " AND age.cdAnimal = ". intval($animal) ."";
            }

            $sSql = $sSql . " ORDER BY age.cdAgendamento";
        }
        else{
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
                        AND age.cdAgendamento = " . $codigo."
                        ORDER BY cdAgendamento";
        }

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

    public function Atualizar(){
        $this->getConexao()->conectaBanco();

        $horarioDe = date("h:i", strtotime($this->getModel()->getHorarioDe()));
        $horarioAte = date("h:i", strtotime($this->getModel()->getHorarioAte()));
        $animal = intval($this->getModel()->getAnimal());
        $data = date("m/d/y",strtotime(str_replace('/','-',$this->getModel()->getData())));
        $usuario = intval($this->getModel()->getUsuario());
        $codigo = intval($this->getModel()->getCodigo());

        $sSql = "UPDATE tbagendamento age
                    SET age.cdAnimal = " . $animal ."
                       ,age.hrInicial = '" . $horarioDe ."'
                       ,age.hrFinal = '" . $horarioAte ."'
                       ,age.dtAgendamento = STR_TO_DATE('". $data ."','%m/%d/%Y')
                  WHERE age.cdAgendamento = " . $codigo ."
                    AND age.cdUsuario = " . $usuario;

        $this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();
    }

    public function Excluir(){
        $this->getConexao()->conectaBanco();

        $usuario = intval($this->getModel()->getUsuario());
        $codigo = intval($this->getModel()->getCodigo());

        $sSql = "DELETE
                   FROM tbagendamento
                  WHERE cdAgendamento = " . $codigo ."
                    AND cdUsuario = " . $usuario;

        $this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();
    }
}
?>