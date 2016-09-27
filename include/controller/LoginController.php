<?php
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('America/Sao_Paulo');
require_once("../model/LoginModel.php");
require_once("../persistencia/LoginPersistencia.php");

if($_POST["login"] == '' OR
   $_POST["senha"] == '' ){
	   exit;
   }

$oModel = new LoginModel();

$oPersistencia = new LoginPersistencia();

$oModel->setSenha($_POST["senha"]);

$oModel->setLogin($_POST["login"]);

$oPersistencia->setModel($oModel);

$bLogou = $oPersistencia->validaLogin();


if($bLogou) {
	echo '{ "mensagem": "Login realizado com sucesso", "status" : "0" }';
} else {
	echo '{ "mensagem": "Usuário ou senha incorretos", "status" : "1" }';
}
?>
