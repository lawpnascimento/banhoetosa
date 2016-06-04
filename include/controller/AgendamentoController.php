<?php
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('America/Sao_Paulo');
require_once("../model/AgendamentoModel.php");
require_once("../persistencia/AgendamentoPersistencia.php");

require_once("../../estrutura/iniciar_sessao.php");

/*if($_POST["horarioDe"] == '' OR
    $_POST["horarioAte"] == '' OR
    $_POST["animal"] == '' OR
    $_POST["data"] == '' OR
    $_POST["sobrenome"] == '' OR
    $_POST["cpf"] == '' ){
    exit;
}*/

switch($_POST["action"]){

    case 'cadastrar':
        $oModel = new AgendamentoModel();

        $oPersistencia = new AgendamentoPersistencia();

        $oModel->setHorarioDe($_POST["horarioDe"]);
        $oModel->setHorarioAte($_POST["horarioAte"]);
        $oModel->setAnimal($_POST["animal"]);
        $oModel->setData($_POST["data"]);
        $oModel->setUsuario($_SESSION["cdusuario"]);

        $oPersistencia->setModel($oModel);

        $oPersistencia->Inserir();
        break;

    case 'buscar':

        $oModel = new AgendamentoModel();

        $oPersistencia = new AgendamentoPersistencia();

        $oModel->setHorarioDe($_POST["horarioDe"]);
        $oModel->setHorarioAte($_POST["horarioAte"]);
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
    case 'animalDropDown':

        $oModel = new AgendamentoModel();

        $oPersistencia = new AgendamentoPersistencia();

        $oModel->setUsuario($_SESSION["cdusuario"]);

        $oPersistencia->setModel($oModel);

        $retorno = $oPersistencia->buscaAnimaisDropDown();

        echo $retorno;

        break;

}
?>
