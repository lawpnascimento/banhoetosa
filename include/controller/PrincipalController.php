<?php
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('America/Sao_Paulo');
session_start();

require_once("../model/PrincipalModel.php");
require_once("../persistencia/PrincipalPersistencia.php");
require_once("../../estrutura/iniciar_sessao.php");

switch($_POST["action"]){

    case 'buscar':
      $oModel = new PrincipalModel();

      $oPersistencia = new PrincipalPersistencia();

      $oModel->setData($_POST["data"]);

      $oPersistencia->setModel($oModel);

      $retorno = $oPersistencia->buscaAgenda();

      echo $retorno;

      break;
   case 'buscahoraparametrizada':
      $oModel = new PrincipalModel();

      $oPersistencia = new PrincipalPersistencia();

      $oModel->setData($_POST["data"]);

      $oPersistencia->setModel($oModel);

      $retorno = $oPersistencia->buscaHoraParametrizada();

      echo $retorno;

      break;
   case 'validahorarioagendamento':

      $oModel = new PrincipalModel();

      $oPersistencia = new PrincipalPersistencia();

      $oModel->setData($_POST["data"]);
      $oModel->setHorarioDe($_POST["horarioDe"]);
      $oModel->setHorarioAte($_POST["horarioAte"]);

      $oPersistencia->setModel($oModel);

      $retorno = $oPersistencia->validaHorarioAgendamento();

      echo $retorno;

      break;
}


?>
