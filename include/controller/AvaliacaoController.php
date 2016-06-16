<?php
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('America/Sao_Paulo');

require_once("../model/AvaliacaoModel.php");
require_once("../persistencia/AvaliacaoPersistencia.php");
session_start();

require_once("../../estrutura/iniciar_sessao.php");

switch($_POST["action"]){

    case 'buscar':
        $oModel = new AvaliacaoModel();

        $oPersistencia = new AvaliacaoPersistencia();

        $oModel->setUsuario($_SESSION["cdusuario"]);

        $oPersistencia->setModel($oModel);

        $retorno = $oPersistencia->BuscaAgendamentos();

        echo $retorno;

        break;

}
?>
