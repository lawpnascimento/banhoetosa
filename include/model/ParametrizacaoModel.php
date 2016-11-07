<?php

class ParametrizacaoModel {

    private $empresa;
    private $usuario;
    private $perfil;
    private $situacao;
    private $horarioDe;
    private $horarioAte;

    public function setEmpresa($empresa){
        $this->empresa = $empresa;
    }
    public function getEmpresa(){
        return $this->empresa;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    public function getUsuario(){
        return $this->usuario;
    }

    public function setPerfil($perfil){
        $this->perfil = $perfil;
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
    public function setHorarioDe($horarioDe){
        $this->horarioDe = $horarioDe;
    }
    public function getHorarioDe(){
        return $this->horarioDe;
    }

    public function setHorarioAte($horarioAte){
        $this->horarioAte = $horarioAte;
    }
    public function getHorarioAte(){
        return $this->horarioAte;
    }

}
?>
