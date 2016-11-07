<?php
require_once("../../estrutura/email.php");

function enviaEmail($email, $mensagem, $assunto, $empresa){
  $email = new Email();
  echo $email;
  /*$email->enviaEmail("kelvinott3112@gmail.com","teste do kelvin hehe","teste2","banho e tosa");*/
  /*$email->enviaEmail(trim($email),trim($mensagem),trim($assunto),trim($empresa));*/
}

?>
