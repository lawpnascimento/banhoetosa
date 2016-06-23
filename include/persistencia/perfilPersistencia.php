<?php
session_start();
/*require_once("../PersistenciaPadrao.php");*/
require_once("../../estrutura/conexao.php");

class PerfilPersistencia {

    protected $conexao;
    protected $Model;

    function __construct(){
        $this->conexao = new Conexao();
    }

    public function getModel(){
        return $this->Model;
    }

    public function setModel($Model){
        $this->Model = $Model;
    }

    public function getConexao(){
        return $this->conexao;
    }

    public function buscaUsuario(){
        $usuario = $this->getModel()->getUsuario();

        $sSql = "SELECT usu.dsEmail
                       ,usu.nrCpf
                       ,usu.dsNome
                       ,usu.dsSobrenome
                       ,usu.nrTelefone
                   FROM tbusuario usu
                  WHERE usu.cdUsuario =" . $usuario;


        $this->getConexao()->conectaBanco();

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';

        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"dsEmail": "'.$linha["dsEmail"].'"
                                   , "nrCpf" : "'.$linha["nrCpf"].'"
                                   , "dsNome" : "'.$linha["dsNome"].'"
                                   , "nrTelefone" : "'.$linha["nrTelefone"].'"
                                   , "dsSobrenome" : "'.$linha["dsSobrenome"].'"}';

            //Para não concatenar a virgula no final do json
            if($qtdLinhas != $contador)
                $retorno = $retorno . ',';

        }
        $retorno = $retorno . "]";

        return $retorno;

        $this->getConexao()->fechaConexao();
    }

    public function Atualizar(){
        $this->getConexao()->conectaBanco();

        $usuario = intval($this->getModel()->getUsuario());
        $nome = $this->getModel()->getNome();
        $sobrenome = $this->getModel()->getSobrenome();
        $email = $this->getModel()->getEmail();
        $cpf = $this->getModel()->getCpf();
        $telefone = $this->getModel()->getTelefone();

        $sSql = "UPDATE tbusuario usu
                    SET usu.dsEmail = '" . $email ."'
                       ,usu.nrCpf = '" . $cpf ."'
                       ,usu.dsNome = '" . $nome ."'
                       ,usu.dsSobrenome = '". $sobrenome ."'
                       ,usu.nrTelefone = '". $telefone ."'
                  WHERE usu.cdUsuario = " . $usuario;

        $this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();
    }
}
?>
