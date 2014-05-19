<?php

session_start();

include_once('../model/DBConexao.class.php');
include_once('../dao/LoginDAO.class.php');


// Tempo da Sessão de Login (Tempo Sem Atividade)
$temposessao = 60; //Tempo da Sessão: 1 Minuto

//
$loginDAO = new LoginDAO();


// Inicializa Conexão com o Banco de Dados
$db = new DBConexao();
$db->conecta();

//
$erro = Array();
$dados = Array();

//
$ok = boolean;
$ok = true;

//
$email = $_POST[txtemail];
$senha = $_POST[txtsenha];

print "E-Mail: ". $email ."<br>";
print "Senha: ". $senha ."<br>";

//
if ( ($email == "") && ($senha == "") ) {

	$erro[0] = "Campo E-mail &eacute; Obrigat&oacute;rio";
	$erro[1] = "Campo Senha &eacute; Obrigat&oacute;rio"; 	
	$ok = false;

} else {
	
	if ($email == "") {

		$erro[0] = "Campo E-mail &eacute; Obrigat&oacute;rio";
		$ok = false;
		
	} else {
		
		if ($senha == "") {

			$erro[0] = "";
			$erro[1] = "Campo Senha &eacute; Obrigat&oacute;rio";
			
			$dados[0] = $email;
			
			$ok = false; 

		} else {
			
			if ( $loginDAO->validaEmail($email) == 0 ) {

				$erro[0] = "E-mail n&atilde;o Cadastrado";
				$ok = false;

			} else {

				if ( $loginDAO->validaSenha($senha,$email) == 0 ) { 
	
					$erro[0] = "";
					$erro[1] = "Senha Inv&aacute;lida";
					
					$dados[0] = $email;
					
					$ok = false;
	
				} 
				
			}
			
		} 
	
	} 

}


	
if ( $ok == true ) {

	$_SESSION["logado"] = TRUE;
	$_SESSION["user"] = $email;
	$_SESSION["sessiontime"] = time();

	header("Location: ../view/index.php");

} else {
	
	header("Location: ../view/login.php?erro=".urlencode(implode(',', $erro)) . "&dados=" . urlencode(implode(',', $dados)));
	
}
	
?>