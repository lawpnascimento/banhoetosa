<?php

class AnimalModel {

    private $codigo;
    private $nome;
    private $raca;
    private $idade;
    private $porte;


    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getNome(){
        return $this->nome;
    }

    public function setRaca($raca){
        $this->raca = $raca;
    }
    public function getRaca(){
        return $this->raca;
    }

    public function setIdade($idade){
        $this->idade = $idade;
    }
    public function getIdade(){
        return $this->idade;
    }

    public function setPorte($porte){
        $this->porte = $porte;
    }
    public function getPorte(){
        return $this->porte;
    }
?>
