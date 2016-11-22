<?php

class PrincipalModel {

    private $data;
    private $horarioDe;
    private $horarioAte;

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
}
?>
