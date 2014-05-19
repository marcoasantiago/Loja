<?php

include_once('../model/Common.class.php');
include_once('../model/Util.class.php');
include_once('../model/Usuario.class.php');

class UsuarioDAO {

	private $sql;
	private $query;
	private $result;    	

	public function validaEmail($email) {
		
		$sql = "SELECT COUNT(0) TOTAL FROM tb_usuario WHERE NM_EMAIL = '" . $email . "'";
		
		$rs = mysql_query($sql);

		$reg = mysql_fetch_array($rs);
				
		return $reg["TOTAL"];

	}
	
	public function verificaCPFDuplicado($cpf) {
		
		$sql = "SELECT COUNT(0) TOTAL FROM tb_usuario WHERE NO_CPF = '" . $cpf . "'";
		
//		print "SQL: ". $sql . "<br>";
		
		$rs = mysql_query($sql);

		$reg = mysql_fetch_array($rs);
				
		return $reg["TOTAL"];
		
	}
	
	public function getIdUsuario($email) {
		
		$sql = "SELECT ID_CLIENTE FROM tb_usuario WHERE NM_EMAIL = '" . $email . "'";
		
//		print "SQL: ". $sql ."<br>";
		
		$rs = mysql_query($sql) or die (mysql_error());
			
		$reg = mysql_fetch_assoc($rs);
		
		$idCliente = $reg["ID_CLIENTE"];
		
		if ($idCliente == "") {
	
			$idCliente = 0;
	
		}
				
		return $idCliente;

	}	
	
	public function getInfoUsuario($email) {

		$sql = "SELECT ID_CLIENTE, NM_CLIENTE, NM_APELIDO, NO_CPF, DATE_FORMAT(DT_NASCIMENTO,'%d%m%Y') DT_NASCIMENTO, FG_SEXO, NO_CEP, NM_ENDERECO, NO_ENDERECO, NM_COMPLEMENTO, ";

	    $sql = $sql . "NM_BAIRRO, NM_CIDADE, NM_ESTADO, NO_TELEFONE_1, NO_TELEFONE_2 FROM tb_usuario WHERE NM_EMAIL = '" . $email . "'";
	    
//	    print "SQL: ". $sql . "<br>";

		$rs = mysql_query($sql)  or die (mysql_error());;
			
		$reg = mysql_fetch_assoc($rs);
		
		return $reg;
		
	}

	
	public function getInfoVendedor($idUsuario) {

		$sql = "SELECT U.NM_CLIENTE, U.NM_CIDADE, E.NM_SIGLA FROM tb_usuario U, tb_estados E WHERE U.ID_CLIENTE = " . $idUsuario ." AND U.NM_ESTADO = E.ID_ESTADO ";
	    
//	    print "SQL: ". $sql . "<br>";

		$rs = mysql_query($sql)  or die (mysql_error());;
			
		$reg = mysql_fetch_assoc($rs);
		
		return $reg;
		
	}	
	
    public function cadastraUsuario(Usuario $usuario){
    	
    	$sql = "INSERT INTO tb_usuario (ID_CLIENTE, NM_CLIENTE, NO_CPF, NM_APELIDO, DT_NASCIMENTO, ";
    	
    	$sql = $sql . "FG_SEXO, NM_EMAIL, NM_SENHA, NO_CEP, NM_ENDERECO, NO_ENDERECO, NM_COMPLEMENTO, ";
    	
    	$sql = $sql . "NM_BAIRRO, NM_CIDADE, NM_ESTADO, NO_TELEFONE_1, NO_TELEFONE_2) VALUES (";
    	
    	$sql = $sql . "NULL, '". $usuario->getNome() ."', '" . Common::removerCaracteresEspeciais($usuario->getCPF()) . "', '" . $usuario->getApelido() . "','";

    	$sql = $sql . substr($usuario->getDtNascimento(),4,4) . "-" . substr($usuario->getDtNascimento(), 2, 2) . "-"  . substr($usuario->getDtNascimento(), 0, 2) ."','". $usuario->getSexo() ."', '". $usuario->getEmail() ."', '";
    	
    	$sql = $sql . $usuario->getSenha() . "', '". Common::removerCaracteresEspeciais($usuario->getCEP()) ."', '". $usuario->getEndereco() ."', '";
    	
    	$sql = $sql . $usuario->getNumero() ."', '". $usuario->getComplemento() ."', '". $usuario->getBairro() ."', '";
    	
  	 	$sql = $sql . $usuario->getCidade() ."', '". $usuario->getEstado() ."', '". $usuario->getTelefone() ."', '";
    	
    	$sql = $sql . $usuario->getTelefone2() ."')";

    	print "SQL: ". $sql ."<br>";
    	
	   	$rs = mysql_query($sql); //or die (mysql_error());
	   	
	   	$result = mysql_affected_rows();
	   	
		return $result;
    
    }
    
    public function atualizaEMail(Usuario $usuario) {
    	
    	$sql = "UPDATE tb_usuario SET NM_EMAIL = '". $usuario->getEmail() ."' WHERE ID_CLIENTE = ". $usuario->getId();
    	
    	$rs = mysql_query($sql) or die (mysql_error());
		
	   	$result = mysql_affected_rows();
	   	
		return $result;
		
    }

    public function atualizaSenha(Usuario $usuario) {
    	
    	$sql = "UPDATE tb_usuario SET NM_SENHA = '". $usuario->getSenha() ."' WHERE ID_CLIENTE = ". $usuario->getId();
    	
    	print "SQL: ". $sql . "<br>";
    	
    	$rs = mysql_query($sql) or die (mysql_error());
		
	   	$result = mysql_affected_rows();
	   	
		return $result;
		
    }    

    public function atualizaEndereco(Usuario $usuario) {
    	
    	$sql = "UPDATE tb_usuario SET NM_ENDERECO = '" . $usuario->getEndereco() . "', NO_ENDERECO = " . $usuario->getNumero() . ", NM_COMPLEMENTO = '" . $usuario->getComplemento() . "',"; 
    	
    	$sql = $sql . "NM_BAIRRO = '" . $usuario->getBairro() . "', NM_CIDADE = '" . $usuario->getCidade() . "', NM_ESTADO = '" . $usuario->getEstado() . "', NO_CEP = '" . $usuario->getCEP() . "'";
    	
     	$sql = $sql . " WHERE ID_CLIENTE = ". $usuario->getId();
    	
    	$rs = mysql_query($sql) or die (mysql_error());
		
	   	$result = mysql_affected_rows();
	   	
		return $result;
		
    }     

    public function atualizaCadastro(Usuario $usuario) {
    	
    	$sql = "UPDATE tb_usuario SET NM_CLIENTE = '" . $usuario->getNome()  . "', NM_APELIDO = '" . $usuario->getApelido() . "', "; 
    	
    	$sql = $sql . "DT_NASCIMENTO = '" . substr($usuario->getDtNascimento(),4,4) . "-" . substr($usuario->getDtNascimento(), 2, 2) . "-"  . substr($usuario->getDtNascimento(), 0, 2) . "', ";
    	
		$sql = $sql . "FG_SEXO = '" . $usuario->getSexo() . "', NO_TELEFONE_1 = '" . $usuario->getTelefone() . "', NO_TELEFONE_2 = '" . $usuario->getTelefone2() . "' ";
    	
    	$sql = $sql . "WHERE ID_CLIENTE = ". $usuario->getId();
    	
    	print "SQL: ". $sql ."<br>";
    	
    	$rs = mysql_query($sql) or die (mysql_error());
		
	   	$result = mysql_affected_rows();
	   	
		return $result;
		
    }     

    public function getNomeSaudacao($email) {
    	
    	$sql = "SELECT NM_APELIDO, NM_CLIENTE FROM tb_usuario WHERE NM_EMAIL = '" . $email . "'";
    	
    	$rs = mysql_query($sql) or die (mysql_error());
			
		$reg = mysql_fetch_assoc($rs);
		
		$nomeCliente = $reg["NM_CLIENTE"];
		$nomeApelido = $reg["NM_APELIDO"];
		
		if ($nomeApelido == "") {
			
			if ($nomeCliente <> "") {
	
				$i = 0;
				
				while ($nomeCliente[$i] <> " " ) {
	
					$texto .= $nomeCliente[$i];
					$i++;
					
				}
				
			} else {
				
				$texto = "Visitante";
				
			}

		} else {
			
			$texto = $nomeApelido;
		}

		return $texto;
    	
    }
    

    public function getNomeCliente($email) {

		$sql = "SELECT NM_CLIENTE FROM tb_usuario WHERE NM_EMAIL = '" . $email . "'";
		
		$rs = mysql_query($sql) or die (mysql_error());
			
		$reg = mysql_fetch_assoc($rs);
		
		$nomeCliente = $reg["NM_CLIENTE"];
		
		return $nomeCliente;
		    	
    }
    	
         
}
    

?>