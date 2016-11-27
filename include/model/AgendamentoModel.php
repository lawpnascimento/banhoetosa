<?php

class AgendamentoModel {

    private $codigo;
    private $data;
    private $horarioDe;
    private $horarioAte;
    private $tipoPagamento;
    private $animal;
    private $usuario;

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function setData($data){
        $this->data = $data;
    }
    public function getData(){
        return $this->data;
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

    public function setTipoPagamento($tipoPagamento){
        $this->tipoPagamento = $tipoPagamento;
    }
    public function getTipoPagamento(){
        return $this->tipoPagamento;
    }

    public function setAnimal($animal){
        $this->animal = $animal;
    }
    public function getAnimal(){
        return $this->animal;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    public function getUsuario(){
        return $this->usuario;
    }
}
?>
