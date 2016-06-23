<?php

class PerfilModel {

    private $usuario;
    private $senha;
    private $email;
    private $nome;
    private $sobrenome;
    private $cpf;
    private $telefone;

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    public function getUsuario(){
        return $this->usuario;
    }

    public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getNome(){
        return $this->nome;
    }

    public function setSobrenome($sobrenome){
        $this->sobrenome = $sobrenome;
    }
    public function getSobrenome(){
        return $this->sobrenome;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }
    public function getCpf(){
        return $this->cpf;
    }

    public function setTelefone($telefone){
      $this->telefone = $telefone;
    }

    public function getTelefone(){
      return $this->telefone;
    }
}
?>
