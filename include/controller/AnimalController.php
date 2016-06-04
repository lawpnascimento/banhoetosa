<?php
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('America/Sao_Paulo');

require_once("../model/AnimalModel.php");
require_once("../persistencia/AnimalPersistencia.php");
require_once("../../estrutura/iniciar_sessao.php");

switch($_POST["action"]){

    case 'cadastrar':
        $oModel = new AnimalModel();

        $oPersistencia = new AnimalPersistencia();

        $oModel->setNome($_POST["nome"]);
        $oModel->setRaca($_POST["raca"]);
        $oModel->setIdade($_POST["idade"]);
        $oModel->setPorte($_POST["porte"]);
        $oModel->setUsuario($_SESSION["cdusuario"]);

        $oPersistencia->setModel($oModel);

        $oPersistencia->Inserir();
        break;

    case 'buscar':
      break;

    case 'atualizar':

        break;

    case 'excluir':

        break;


}


?>