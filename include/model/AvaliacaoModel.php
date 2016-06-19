<?php
class AvaliacaoModel {
    private $usuario;
    private $agendamento;

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    public function getUsuario(){
        return $this->usuario;
    }
    public function setAgendamento($agendamento){
        $this->agendamento = $agendamento;
    }
    public function getAgendamento(){
        return $this->agendamento;
    }
}
?>
