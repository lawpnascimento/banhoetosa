<?php
class Conexao {
    private $banco;
    private $hostBanco;
    private $portaBanco;
    private $usuarioBanco;
    private $senhaBanco;
    private $dataBase;
    private $conexao;

    public function __construct() {
        $this->banco        = 'MY';
        $this->hostBanco    = 'localhost';
        $this->usuarioBanco = 'root';
        $this->senhaBanco   = 'root';
        $this->portaBanco   = '3306';
        $this->dataBase     = 'dbbanhotosa';
    }

    public function conectaBanco() {
        switch (strtoupper($this->banco)){      
            case 'MY':
                $this->conexao = mysql_connect($this->hostBanco,$this->usuarioBanco,$this->senhaBanco);
               
                if (!$this->conexao)
                    exit("Banco n�o conectado [MYSQL]");
                             
                $db = mysql_select_db($this->dataBase) or die('Erro ao selecionar o Banco de Dados!');              
            break;

            default:
                exit('Banco n�o Configurado!');
            break;
        }
    }

    public function query($sSQL) {
        $sSQL = str_replace("'null'","null",$sSQL);
        
        switch (strtoupper($this->banco)) {
            case "MY":
                mysql_real_escape_string($sSQL);
                $qQuery = mysql_query($sSQL,$this->conexao);
            break;
        }
    
        if(!$qQuery)
            exit("Erro ao tentar executar o SQL <br>".$sSQL.mysql_error());
        else
            return $qQuery;
    }

    public function begin() {
        $this->query("begin;");
    }

    public function rollback() {
        $this->query("rollback;");
    }

    public function commit() {
        $this->query("commit;");
    }

    public function fetch_query($sSQL) {
        $qQuery = $this->query($sSQL);
        $oObj   = $this->fetch_object($qQuery);
        $this->free_result($qQuery);
        return $oObj;
    }

    public function fetch_object($query) {
        switch (strtoupper($this->banco)) {
            case "MY":
                return mysql_fetch_object($query);
            break;
        }
    }

    public function exec_sql_trans(&$bErro, $sSQL) {
        if (!$this->query($sSQL))
            $bErro = true;
        return $bErro;
    }

    public function fechaConexao() {
        switch (strtoupper($this->banco)) {
            case "MY":
                return mysql_close($this->conexao);
            break;

            case "PG":
                return pg_close($this->conexao);
            break;
        }
    }

    public function getMaxCodigo($sTabela, $sCampo, $sCondicao = false){
        $sSQL = "select max(".$sCampo.") as resultado from ".$sTabela." ";
        if ($sCondicao){
            $sSQL .= " where ".$sCondicao." ";
        }
        
        $oDados = $this->fetch_query($sSQL);
        return ($oDados->resultado + 1);
    }

    public function free_result($qQuery){
        switch (strtoupper($this->banco)) {
            case "MY":
                mysql_free_result($qQuery);
            break;

            case "PG":
                pg_free_result($qQuery);
            break;
        }
    }

    public function num_rows($qQuery) {
        switch (strtoupper($this->banco)) {
            case "MY":
                $iTotalLinha = mysql_num_rows($qQuery);
            break;

            case "PG":
                $iTotalLinha = pg_num_rows($qQuery);
            break;
        }
        return $iTotalLinha;
    }

    public function associativa($qQuery) {
        switch (strtoupper($this->banco)) {
            case "MY":
                return mysql_fetch_assoc($qQuery);
            break;

            case "PG":
                return pg_fetch_assoc($qQuery);
            break;
        }
    }
}

$oConexao = new Conexao();

?>