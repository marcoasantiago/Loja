<?php

class DBConexao{

/*
	private $localhost = "mysql01.guaianas2.hospedagemdesites.ws";
    private $root = "guaianas2";
    private $senha = "sofia13";
    private $banco = "guaianas2";
*/	
 
    private $localhost = "localhost";
    private $root = "root";
    private $senha = "mags31";
    private $banco = "Loja";


	public function conecta() {
        $conexao = mysql_connect($this->localhost, $this->root, $this->senha);
        if (!$conexao){
            echo "Erro ao se conectar ao banco de dados";
        }

        
        $banco = mysql_select_db($this->banco, $conexao);
        if (!$banco){
            echo "Erro ao selecionar o banco de dados";
        }


	    mysql_select_db($this->banco);
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');        

        
    }

	public function desconecta() {
        
		mysql_close($conexao);

	}    
    
}
?>

