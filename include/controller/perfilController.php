<?php
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('America/Sao_Paulo');
require_once("../model/PerfilModel.php");
require_once("../persistencia/PerfilPersistencia.php");

switch($_POST["action"]) {

    case 'buscar':

        $oModel = new PerfilModel();

        $oPersistencia = new PerfilPersistencia();

        $oModel->setUsuario($_SESSION["cdusuario"]);

        $oPersistencia->setModel($oModel);

        $retorno = $oPersistencia->buscaUsuario();

        echo $retorno;

        break;
    case 'atualizar':
        $oModel = new PerfilModel();

        $oPersistencia = new PerfilPersistencia();

        $oModel->setUsuario($_SESSION["cdusuario"]);
        $oModel->setEmail($_POST["email"]);
        $oModel->setNome($_POST["nome"]);
        $oModel->setSobrenome($_POST["sobrenome"]);
        $oModel->setCpf($_POST["cpf"]);
        $oModel->setTelefone($_POST["telefone"]);

        $oPersistencia->setModel($oModel);

        $oPersistencia->Atualizar();

        break;
    case 'upload':
        return;

        break;
}
?>
