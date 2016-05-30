<?php
session_start();
//Caso o usuário não esteja autenticado, limpa os dados e redireciona
if (!isset($_SESSION['cdusuario'])) {

  
    //Limpa
    unset ($_SESSION['cdusuario']);
    unset ($_SESSION['nome']);

    //Redireciona para a página de autenticação
    header('location: /banhoetosa/index.php');
}

?>