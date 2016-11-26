<?php
require_once("../../estrutura/conexao.php");

class PrincipalPersistencia {

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


    public function buscaHoraParametrizada(){
        $data = date("m/d/y",strtotime(str_replace('/','-',$this->getModel()->getData())));

        $this->getConexao()->conectaBanco();


        $sSql = "SELECT HOUR(emp.hrInicial) hrInicial
                     	 ,HOUR(emp.hrFinal) hrFinal
                   FROM tbempresa emp";

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $hrInicial = 0;
        $hrFinal = 0;
        $grid = "";
        $retorno = "";

        while ($linha = mysql_fetch_assoc($resultado)) {
            $hrInicial = $linha["hrInicial"];
            $hrFinal = $linha["hrFinal"];
        }

        for ($i = $hrInicial; $i <= $hrFinal - 1; $i++) {
           $retorno =  $this->validaHorarioAgendamento($data, $i, $i + 1);

          $arr = json_decode($retorno, true);
          if($arr[0]['idReservado'] == 1){
               if ($_SESSION["cdperfil"] <> 1){
                 $grid .=  "<tr style='background-color:rgb(166, 166, 166)'>";
                 $grid .=   "<td>" . $i . ":00</td>";
                 $grid .=   "<td>" . $arr[0]['dsNome'] . "</td>";
                 $grid .=   "<td>" . $arr[0]['nmAnimal'] . "</td>";
                 $grid .=   "<td>" . $arr[0]['dsRaca'] . "</td>";
                 $grid .=   "<td>" . $arr[0]['dsPorte'] . "</td>";
                 $grid .=   "<td>" . $arr[0]['nrTelefone'] . "</td>";
                 $grid .=   "</tr>";
               }
               else {
                 $grid .=  "<tr style='background-color:rgb(128, 255, 128)'>";
                 $grid .=   "<td>" . $i . ":00</td>";
                 $grid .=   "<td></td>";
                 $grid .=   "<td></td>";
                 $grid .=   "<td></td>";
                 $grid .=   "<td></td>";
                 $grid .=   "<td></td>";
                 $grid .=  "</tr>";
               }

           }else{
               $grid .=  "<tr style='background-color:rgb(128, 255, 128)'>";
               $grid .=   "<td>" . $i . ":00</td>";
               $grid .=   "<td></td>";
               $grid .=   "<td></td>";
               $grid .=   "<td></td>";
               $grid .=   "<td></td>";
               $grid .=   "<td></td>";
               $grid .=  "</tr>";
           }

        }

        return $grid;

        $this->getConexao()->fechaConexao();

    }

    public function validaHorarioAgendamento($data, $horarioDe, $horarioAte){
        $sSql = "SELECT age.cdAgendamento cdAgendamento
                   FROM tbagendamento age
                  WHERE age.dtAgendamento = STR_TO_DATE('". $data ."','%m/%d/%Y')
                    AND '". $horarioDe ."' <  hour(age.hrfinal)
                    AND '". $horarioAte ."' > hour(age.hrinicial)
                    AND cdSituacao = 3";

      if($oDados = $this->getConexao()->fetch_query($sSql)){

        $cdAgendamento = $oDados->cdAgendamento;

        $sSql = "SELECT usu.dsNome dsNome
                       ,usu.dsSobrenome dsSobrenome
                  		 ,ani.dsRaca dsRaca
                       ,ani.dsNome nmAnimal
                   		 ,por.dsPorte dsPorte
                  		 ,usu.nrTelefone nrTelefone
                   FROM tbagendamento age
                   JOIN tbusuario usu
                     ON usu.cdUsuario = age.cdUsuario
                   JOIN tbanimal ani
                     ON ani.cdAnimal = age.cdAnimal
                   JOIN tbporte por
                     ON por.cdPorte = ani.cdPorte
                  WHERE age.cdAgendamento = " . $cdAgendamento;

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';
        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"dsNome": "'.$linha["dsNome"].'"
                                   , "dsSobrenome" : "'.$linha["dsSobrenome"].'"
                                   , "nmAnimal" : "'.$linha["nmAnimal"].'"
                                   , "dsRaca" : "'.$linha["dsRaca"].'"
                                   , "dsPorte" : "'.$linha["dsPorte"].'"
                                   , "idReservado" : "1"
                                   , "nrTelefone" : "'.$linha["nrTelefone"].'"}';

            //Para não concatenar a virgula no final do json
            if($qtdLinhas != $contador)
               $retorno = $retorno . ',';

        }
        $retorno = $retorno . "]";


        return $retorno; //Reservado
      }
      else {
        return '[{"dsNome": " "
               , "dsSobrenome" : " "
               , "nmAnimal" : " "
               , "dsRaca" : " "
               , "dsPorte" : " "
               , "idReservado" : "2"
               , "nrTelefone" : " "}]';

      }



  	}



}




?>
