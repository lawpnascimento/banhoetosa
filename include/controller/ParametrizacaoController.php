<?php
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('America/Sao_Paulo');
session_start();

require_once("../model/ParametrizacaoModel.php");
require_once("../persistencia/ParametrizacaoPersistencia.php");
require_once("../../estrutura/iniciar_sessao.php");

switch($_POST["action"]){

    case 'atualizar':

        $oModel = new ParametrizacaoModel();

        $oPersistencia = new ParametrizacaoPersistencia();
        $oModel->setEmpresa($_POST["empresa"]);
        $oModel->setUsuario($_POST["usuario"]);
        $oModel->setPerfil($_POST["perfil"]);
        $oModel->setSituacao($_POST["situacao"]);
        $oModel->setHorarioDe($_POST["horarioDe"]);
        $oModel->setHorarioAte($_POST["horarioAte"]);

        $oPersistencia->setModel($oModel);

        $oPersistencia->Atualizar();

        break;


    case 'usuariosdropdown':

        $oPersistencia = new ParametrizacaoPersistencia();

        $retorno = $oPersistencia->buscaUsuariosDropdown();

        echo $retorno;

        break;

    case 'perfisdropdown':

        $oPersistencia = new ParametrizacaoPersistencia();

        $retorno = $oPersistencia->buscaPerfisDropdown();

        echo $retorno;

        break;
    case 'situacoesdropdown':

        $oPersistencia = new ParametrizacaoPersistencia();

        $retorno = $oPersistencia->buscaSituacoesDropdown();

        echo $retorno;

        break;
    case 'perfisdropdownusuario':
        $oModel = new ParametrizacaoModel();

        $oPersistencia = new ParametrizacaoPersistencia();

        $oModel->setUsuario($_POST["usuario"]);

        $oPersistencia->setModel($oModel);

        $retorno = $oPersistencia->buscaPerfisDropdownUsuarios();

        echo $retorno;

        break;
    case 'situacaodropdownusuario':
        $oModel = new ParametrizacaoModel();

        $oPersistencia = new ParametrizacaoPersistencia();

        $oModel->setUsuario($_POST["usuario"]);

        $oPersistencia->setModel($oModel);

        $retorno = $oPersistencia->buscaSituacaoDropdownUsuarios();

        echo $retorno;

        break;


}


?>
