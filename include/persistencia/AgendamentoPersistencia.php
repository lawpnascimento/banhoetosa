<?php
require_once("../../estrutura/conexao.php");
require_once("../../estrutura/email.php");

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

        //Valida o agendamento
        $agendamentoValido = $this->validaAgendamento();

        //Agendamento é valido
        if($agendamentoValido == "1"){

          $horarioDe = date("H:i", strtotime($this->getModel()->getHorarioDe()));
          $horarioAte = date("H:i", strtotime($this->getModel()->getHorarioAte()));
          $tipoPagamento = intval($this->getModel()->getTipoPagamento());
          $animal = intval($this->getModel()->getAnimal());
          $data = date("d/m/y",strtotime(str_replace('/','-',$this->getModel()->getData())));
          $usuario = intval($this->getModel()->getUsuario());

          $sSql = "INSERT INTO tbagendamento (hrInicial, hrFinal, cdPagamento, cdAnimal, dtAgendamento, cdSituacao, cdUsuario,cdEmpresa)
                            VALUES (concat(hour('". $horarioDe ."'),':00:00')
                                  ,concat(hour('". $horarioAte ."'),':00:00')
                                  , ". $tipoPagamento ."
                                  , ". $animal ."
                                  , STR_TO_DATE('". $data ."','%d/%m/%Y')
                                  , 1
                                  ,  ". $usuario ."
                                  ,(SELECT vlConstante FROM tbconstante con	WHERE idConstante = 'CODIGO_EMPRESA'))";

          $this->getConexao()->query($sSql);

          $this->enviaEmailAtendente(ucfirst($_SESSION["nome"]) . " " . ucfirst($_SESSION["dssobrenome"]), $data, $horarioDe, $horarioAte);
          $this->getConexao()->fechaConexao();

          return $agendamentoValido;
        }
        else{
          $this->getConexao()->fechaConexao();
          return $agendamentoValido;
        }
    }

    public function BuscaAgendamentos(){
        $this->getConexao()->conectaBanco();

        $usuario = intval($this->getModel()->getUsuario());
        $codigo = intval($this->getModel()->getCodigo());
        $data = $this->getModel()->getData();
        $horarioDe = $this->getModel()->getHorarioDe() ;
        $horarioAte = $this->getModel()->getHorarioAte();
        $tipoPagamento = intval($this->getModel()->getTipoPagamento());
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
                           ,sit.cdSituacao cdSituacao
                           ,sit.dsSituacao dsSituacao
                           ,pag.cdPagamento cdPagamento
                           ,pag.dsPagamento dsPagamento
                       FROM tbagendamento age
                       JOIN tbusuario usu
                         ON usu.cdUsuario = age.cdUsuario
                       JOIN tbanimal ani
                         ON ani.cdAnimal = age.cdAnimal
                       JOIN tbsituacaoagendamento sit
                         ON sit.cdSituacao = age.cdSituacao
                       JOIN tbtipopagamento pag
                         ON pag.cdPagamento = age.cdPagamento
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
                $sSql = $sSql . " AND age.cdAnimal = ". intval($animal);
            }

            if($tipoPagamento != null){
                $sSql = $sSql . " AND age.cdPagamento = ". intval($tipoPagamento);
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
                           ,sit.cdSituacao cdSituacao
                           ,sit.dsSituacao dsSituacao
                           ,pag.cdPagamento cdPagamento
                           ,pag.dsPagamento dsPagamento
                       FROM tbagendamento age
                       JOIN tbusuario usu
                         ON usu.cdUsuario = age.cdUsuario
                       JOIN tbanimal ani
                         ON ani.cdAnimal = age.cdAnimal
                       JOIN tbsituacaoagendamento sit
                         ON sit.cdSituacao = age.cdSituacao
                       JOIN tbtipopagamento pag
                         ON pag.cdPagamento = age.cdPagamento
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
            $date = new DateTime($linha["dtAgendamento"]);

            $retorno = $retorno . '{"dtAgendamento": "'.date_format($date, 'd/m/Y').'"
                                   , "hrInicial" : "'.$linha["hrInicial"].'"
                                   , "hrFinal" : "'.$linha["hrFinal"].'"
                                   , "cdPagamento" : "'.$linha["cdPagamento"].'"
                                   , "nmAnimal" : "'.$linha["nmAnimal"].'"
                                  , "cdAgendamento" : "'.$linha["cdAgendamento"].'"
                                   , "dsPagamento" : "'.$linha["dsPagamento"].'"
                                   , "dsSituacao" : "'.$linha["dsSituacao"].'"
                                   , "cdSituacao" : "'.$linha["cdSituacao"].'"
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
        $tipoPagamento = intval($this->getModel()->getTipoPagamento());
        $animal = intval($this->getModel()->getAnimal());
        $data = date("m/d/y",strtotime(str_replace('/','-',$this->getModel()->getData())));
        $usuario = intval($this->getModel()->getUsuario());
        $codigo = intval($this->getModel()->getCodigo());

        $sSql = "UPDATE tbagendamento age
                    SET age.cdAnimal = " . $animal ."
                       ,age.cdPagamento = " . $tipoPagamento ."
                       ,age.hrInicial = concat(hour('" . $horarioDe ."'),':00:00')
                       ,age.hrFinal = concat(hour('" . $horarioAte ."'),':00:00')
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

    public function buscaAnimaisDropDown(){
        $this->getConexao()->conectaBanco();

        $usuario = intval($this->getModel()->getUsuario());

        $sSql = "SELECT ani.cdAnimal cdAnimal
                       ,ani.dsNome dsNome
                   FROM tbanimal ani
                  WHERE ani.cdUsuario = " . $usuario . "
                  ORDER BY ani.dsNome";

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';
        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"cdAnimal": "'.$linha["cdAnimal"].'"
                                   , "dsNome" : "'.$linha["dsNome"].'"}';
            //Para não concatenar a virgula no final do json
            if($qtdLinhas != $contador)
               $retorno = $retorno . ',';

        }
        $retorno = $retorno . "]";

        $this->getConexao()->fechaConexao();

        return $retorno;
    }

    public function buscaTipoPagamentoDropDown(){
        $this->getConexao()->conectaBanco();

        $sSql = "SELECT pag.cdPagamento cdPagamento
                       ,pag.dsPagamento dsPagamento
                   FROM tbtipopagamento pag";

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';
        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"cdPagamento": "'.$linha["cdPagamento"].'"
                                   , "dsPagamento" : "'.$linha["dsPagamento"].'"}';
            //Para não concatenar a virgula no final do json
            if($qtdLinhas != $contador)
               $retorno = $retorno . ',';

        }
        $retorno = $retorno . "]";

        $this->getConexao()->fechaConexao();

        return $retorno;
    }

    public function validaAgendamento(){
      $horarioDe = date("H:i", strtotime($this->getModel()->getHorarioDe()));
      $horarioAte = date("H:i", strtotime($this->getModel()->getHorarioAte()));
      $data = date("m/d/y",strtotime(str_replace('/','-',$this->getModel()->getData())));
      $usuario = intval($this->getModel()->getUsuario());
      $animal = intval($this->getModel()->getAnimal());
      /*Valida se o cliente está gerando o agendamento dentro do horario permitido*/
      $sSql = "SELECT emp.cdempresa
                 FROM tbempresa emp
                WHERE emp.hrInicial <= '" . $horarioDe . "'
                  AND emp.hrFinal	>= '" . $horarioAte . "'";

      //Dentro do horario permitido
  		if( $oDados = $this->getConexao()->fetch_query($sSql) ){

        $sSql = "SELECT 1
                   FROM tbagendamento age
                  WHERE age.dtAgendamento = STR_TO_DATE('". $data ."','%m/%d/%Y')
                    AND hour('". $horarioDe ."') <  hour(age.hrfinal)
                    AND hour('". $horarioAte ."') > hour(age.hrinicial)
                    AND cdSituacao = 3";

        if($oDados = $this->getConexao()->fetch_query($sSql))
          return "3"; //Já existe agendamento naquele periodo
        else{

          $sSql = "SELECT *
                     FROM tbagendamento age
                    WHERE age.cdUsuario = " . $usuario . "
                      AND age.cdAnimal = " . $animal ."
                      AND age.cdSituacao = 1";
          if($oDados = $this->getConexao()->fetch_query($sSql)){
            return "4"; //Já existe uma solicitação de agendamento pendente para o animal.
          }
          else
            return "1"; /*Realizado com sucesso*/

        }

      }
  		else
        return "2"; /*Fora do horario permitido*/

  	}

    public function enviaEmailAtendente($usuario, $data, $horaInicial, $horaFinal){

      $sSql = "SELECT dsEmail
                 FROM tbusuario usu
                WHERE usu.cdPerfil IN (2,3)";

      $resultado = mysql_query($sSql);

      $assunto = "AVISO: Nova solicitação de agendamento";

      $mensagem	= "O cliente " . $usuario . " gerou uma nova solicitação de agendamento no dia " . $data ." das ". $horaInicial ." às " . $horaFinal . ".
                   Este e-mail é automatico, favor não responder.";

      $emailAtendente = "";
      $contador = 0;
      while ($linha = mysql_fetch_assoc($resultado)) {

        $contador = $contador + 1;

        //Se for a primeira vez
        if ($contador = 1)
          $emailAtendente = $linha["dsEmail"];
        else
          $emailAtendente = $emailAtendente . ";" . $linha["dsEmail"];
      }
      $email = new Email();
      $email->enviaEmail($emailAtendente,$mensagem,$assunto,"Sistema");

  	}

}




?>
