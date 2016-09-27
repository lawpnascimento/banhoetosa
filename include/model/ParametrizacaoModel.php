<?php

class ParametrizacaoModel {

    private $usuario;
    private $perfil;
    private $situacao;

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    public function getUsuario(){
        return $this->usuario;
    }

    public function setPerfil($perfil){
        $this->$perfil = $perfil;
    }
    public function getPerfil(){
        return $this->perfil;
    }
    public function setSituacao($situacao){
        $this->situacao = $situacao;
    }
    public function getSituacao(){
        return $this->situacao;
    }

}
?>
