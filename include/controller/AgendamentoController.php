<?php
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('America/Sao_Paulo');
require_once("../model/AgendamentoModel.php");
require_once("../persistencia/AgendamentoPersistencia.php");
session_start();

require_once("../../estrutura/iniciar_sessao.php");

switch($_POST["action"]){

    case 'cadastrar':
        $oModel = new AgendamentoModel();

        $oPersistencia = new AgendamentoPersistencia();

        $oModel->setHorarioDe($_POST["horarioDe"]);
        $oModel->setHorarioAte($_POST["horarioAte"]);
        $oModel->setTipoPagamento($_POST["tipoPagamento"]);
        $oModel->setAnimal($_POST["animal"]);
        $oModel->setData($_POST["data"]);
        $oModel->setUsuario($_SESSION["cdusuario"]);

        $oPersistencia->setModel($oModel);

        $AgendamentoValido = $oPersistencia->Inserir();

        if($AgendamentoValido == 1)
          echo '{ "mensagem": "Agendamento cadastrado com sucesso!", "status" : "1" }';
        elseif($AgendamentoValido == 2)
          echo '{ "mensagem": "Agendamento fora do horário permitido", "status" : "2" }';
        elseif($AgendamentoValido == 3)
          echo '{ "mensagem": "Já existe agendamento para o período informado", "status" : "3" }';
        elseif($AgendamentoValido == 4)
          echo '{ "mensagem": "Já existe uma solicitação de agendamento pendente para o animal informado", "status": "4" }';
        break;

    case 'buscar':

        $oModel = new AgendamentoModel();

        $oPersistencia = new AgendamentoPersistencia();

        $oModel->setHorarioDe($_POST["horarioDe"]);
        $oModel->setHorarioAte($_POST["horarioAte"]);
        $oModel->setTipoPagamento($_POST["tipoPagamento"]);
        $oModel->setAnimal($_POST["animal"]);
        $oModel->setData($_POST["data"]);
        $oModel->setUsuario($_SESSION["cdusuario"]);
  
        if(isset($_POST["codigo"])){
            $oModel->setCodigo($_POST["codigo"]);
        }

        $oPersistencia->setModel($oModel);

        $retorno = $oPersistencia->BuscaAgendamentos();

        echo $retorno;

        break;

    case 'atualizar':
        $oModel = new AgendamentoModel();

        $oPersistencia = new AgendamentoPersistencia();

        $oModel->setHorarioDe($_POST["horarioDe"]);
        $oModel->setHorarioAte($_POST["horarioAte"]);
        $oModel->setTipoPagamento($_POST["tipoPagamento"]);
        $oModel->setAnimal($_POST["animal"]);
        $oModel->setData($_POST["data"]);
        $oModel->setUsuario($_SESSION["cdusuario"]);
        $oModel->setCodigo($_POST["codigo"]);

        $oPersistencia->setModel($oModel);

        $oPersistencia->Atualizar();

        break;

    case 'excluir':
        $oModel = new AgendamentoModel();

        $oPersistencia = new AgendamentoPersistencia();

        $oModel->setUsuario($_SESSION["cdusuario"]);
        $oModel->setCodigo($_POST["codigo"]);

        $oPersistencia->setModel($oModel);

        $oPersistencia->Excluir();
        break;

    case 'animaldropdown':

        $oModel = new AgendamentoModel();

        $oPersistencia = new AgendamentoPersistencia();

        $oModel->setUsuario($_SESSION["cdusuario"]);

        $oPersistencia->setModel($oModel);

        $retorno = $oPersistencia->buscaAnimaisDropDown();

        echo $retorno;

        break;
    case 'tipopagamentodropdown':

        $oPersistencia = new AgendamentoPersistencia();

        $retorno = $oPersistencia->buscaTipoPagamentoDropDown();

        echo $retorno;

        break;

    }
?>
