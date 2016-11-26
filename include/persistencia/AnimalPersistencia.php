<?php
require_once("../../estrutura/conexao.php");

class AnimalPersistencia {

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

    public function Inserir(){

        $this->getConexao()->conectaBanco();

        $nome = $this->getModel()->getNome();
        $raca = $this->getModel()->getRaca();
        $idade = intval($this->getModel()->getIdade());
        $porte = intval($this->getModel()->getPorte());
        $usuario = intval($this->getModel()->getUsuario());

        $sSql = "INSERT INTO tbanimal (dsNome, dsRaca, nrIdade, cdPorte, cdUsuario)
                          VALUES ('". $nome ."'
                                ,'". $raca ."'
                                , ". $idade ."
                                , ". $porte."
                                , ". $usuario .")";

        $this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();
    }

    public function buscaPorteDropdown(){
        $this->getConexao()->conectaBanco();

        $sSql = "SELECT prt.cdPorte cdPorte
                       ,prt.dsPorte dsPorte
                   FROM tbporte prt
                  ORDER BY prt.cdPorte";

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';
        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"cdPorte": "'.$linha["cdPorte"].'"
                                   , "dsPorte" : "'.$linha["dsPorte"].'"}';
            //Para não concatenar a virgula no final do json
            if($qtdLinhas != $contador)
               $retorno = $retorno . ',';

        }
        $retorno = $retorno . "]";

        $this->getConexao()->fechaConexao();

        return $retorno;
    }

    public function BuscaAnimais(){
        $this->getConexao()->conectaBanco();

        $usuario = intval($this->getModel()->getUsuario());
        $codigo = intval($this->getModel()->getCodigo());
        $nome = $this->getModel()->getNome();
        $raca = $this->getModel()->getRaca() ;
        $idade = $this->getModel()->getIdade();
        $porte = $this->getModel()->getPorte();

        if($codigo == null){
            $sSql = "SELECT ani.cdAnimal
                        	 ,ani.dsNome
                       		 ,ani.dsRaca
                      		 ,ani.cdPorte
                      		 ,ani.cdUsuario
                           ,ani.nrIdade
                           ,prt.dsPorte
                       FROM tbanimal ani
                       JOIN tbporte prt
                         ON prt.cdPorte = ani.cdPorte
                      WHERE ani.cdUsuario = " .$usuario;

            if($nome != null){
                $sSql = $sSql . " AND UPPER(ani.dsNome) LIKE UPPER('%" . $nome ."%')";
            }

            if($raca != null){
                $sSql = $sSql . " AND UPPER(ani.dsRaca) LIKE UPPER('%" . $raca ."%')";
            }

            if($idade != null){
                $sSql = $sSql . " AND ani.nrIdade = ". intval($idade);
            }

            if($porte != null){
                $sSql = $sSql . " AND ani.cdPorte = ". intval($porte);
            }

            $sSql = $sSql . " ORDER BY ani.cdAnimal";
        }
        else{
            $sSql = "SELECT ani.cdAnimal
                        	 ,ani.dsNome
                       		 ,ani.dsRaca
                      		 ,ani.cdPorte
                      		 ,ani.cdUsuario
                           ,ani.nrIdade
                           ,prt.dsPorte
                       FROM tbanimal ani
                       JOIN tbporte prt
                         ON prt.cdPorte = ani.cdPorte
                      WHERE ani.cdUsuario = " .$usuario. "
                        AND ani.cdAnimal = " . $codigo."
                      ORDER BY ani.cdAnimal";
        }

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';
        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"cdAnimal": "'.$linha["cdAnimal"].'"
                                   , "dsNome" : "'.$linha["dsNome"].'"
                                   , "dsRaca" : "'.$linha["dsRaca"].'"
                                   , "cdPorte" : "'.$linha["cdPorte"].'"
                                   , "dsPorte" : "'.$linha["dsPorte"].'"
                                   , "cdUsuario" : "'.$linha["cdUsuario"].'"
                                   , "nrIdade" : "'.$linha["nrIdade"].'"}';
            //Para não concatenar a virgula no final do json
            if($qtdLinhas != $contador)
                $retorno = $retorno . ',';

        }
        $retorno = $retorno . "]";

        $this->getConexao()->fechaConexao();

        return $retorno;

    }

    public function Atualizar(){
        $this->getConexao()->conectaBanco();

        $nome = $this->getModel()->getNome();
        $raca = $this->getModel()->getRaca();
        $idade = intval($this->getModel()->getIdade());
        $porte = intval($this->getModel()->getPorte());
        $usuario = intval($this->getModel()->getUsuario());
        $codigo = intval($this->getModel()->getCodigo());

        $sSql = "UPDATE tbanimal ani
                	  SET ani.dsNome = '" . $nome ."'
                	     ,ani.dsRaca = '" . $raca ."'
                	     ,ani.nrIdade = " . $idade ."
                	     ,ani.cdPorte = " . $porte ."
                	WHERE ani.cdAnimal = " . $codigo;

        $this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();
    }

    public function Excluir(){
        $this->getConexao()->conectaBanco();

        $usuario = intval($this->getModel()->getUsuario());
        $codigo = intval($this->getModel()->getCodigo());


        $retorno = $this->ValidaExclusao($usuario, $codigo);
        
        if($retorno == 'N'){
          $sSql = "DELETE
                     FROM tbanimal
                    WHERE cdanimal = " . $codigo ."
                      AND cdUsuario = " . $usuario;

          $this->getConexao()->query($sSql);

          echo '[{"mensagem": "Agendamento excluido com sucesso!"}]';
        }
        else{
          echo '[{"mensagem": "Não é possível excluir este animal pois está vinculado a um agendamento!"}]';

        }


        $this->getConexao()->fechaConexao();
    }

    public function ValidaExclusao($codigo, $usuario){

        $sSql = "SELECT 'S' idExclusao
                   FROM tbagendamento age
                  WHERE age.cdAnimal = " . $codigo ."
                    AND age.cdUsuario = " . $usuario;


        if($oDados = $this->getConexao()->fetch_query($sSql))
            return $oDados->idExclusao;
        else
            return  "N";

    }
}




?>
