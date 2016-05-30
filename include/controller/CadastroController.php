<?php
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('America/Sao_Paulo');

require_once("../model/CadastroModel.php");
require_once("../persistencia/CadastroPersistencia.php");

if($_POST["login"] == '' OR
   $_POST["senha"] == '' OR
   $_POST["email"] == '' OR
   $_POST["nome"] == '' OR
   $_POST["sobrenome"] == '' OR
   $_POST["cpf"] == '' ){
	   exit;
   }

$oModel = new CadastroModel();
$oPersistencia = new CadastroPersistencia();

$oModel->setUsuario($_POST["login"]);
$oModel->setSenha($_POST["senha"]);
$oModel->setEmail($_POST["email"]);
$oModel->setNome($_POST["nome"]);
$oModel->setSobrenome($_POST["sobrenome"]);
$oModel->setCpf($_POST["cpf"]);

$oPersistencia->setModel($oModel);

$retorno = $oPersistencia->Inserir();

if($retorno == "1"){
	echo '{ "mensagem": "Login já cadastrado! Tente novamente.", "status" : '. $retorno .' }';
}
elseif($retorno == "2"){
	echo '{ "mensagem": "CPF já cadastrado!", "status" : '. $retorno .' }';
}
elseif ($retorno == "3"){
	echo '{ "mensagem": "E-mail já cadastrado! Tente novamente.", "status" : '. $retorno .' }';
}
elseif($retorno = "4"){
	echo '{ "mensagem": "Cadastro realizado com sucesso!", "status" : '. $retorno .' }';
}

?>