<?php
session_start();

include_once('../dao/LoginDAO.class.php');
include_once('../dao/UsuarioDAO.class.php');
include_once('../model/DBConexao.class.php');
include_once('../model/Usuario.class.php');
include_once('../model/Util.class.php');
include_once('../model/Email.class.php');



// Inicializa Conexгo com o Banco de Dados
$db = new DBConexao();
$db->conecta();

$loginDAO = new LoginDAO();
$usuarioDAO = new UsuarioDAO();
$usuario = new Usuario();

$util = new Util();
//$sendMail = new Email();

$email = $_POST["txtemail"];

$ok = boolean;
$ok = true;

if ($email == "") {
	
	$erro = "Verifique o preenchimento do campo e-mail";
	$ok = false;
	
} else {
	
	if ($loginDAO->validaEmail($email) == 0) {
	
		$erro = "E-mail Informado Inexistente em Nosso Sistema";
		$dados = $email;
		$ok = false;
		
	}
	
}


if ($ok == false) {

	header("Location: ../view/esqueceuSenha.php?erro=".$erro . "&dados=" . $dados);
		
} else {
	
	// Geraзгo de Nova Senha Randфmica 
	// -> Chamada da Funзгo: (Tamanho, Maiusculas, Nъmeros, Sнmbolos)
	//		-> Tamanho da Nova Senha
	//		-> Contem Letras Maiusculas?
	//		-> Contem Nъmeros?
	//		-> Contem Simbolos?
	$novaSenha = $util->geraNovaSenha(8,true,true,false);
	
	$idUsuario = $usuarioDAO->getIdUsuario($email);
	
	$usuario->setSenha($novaSenha);
	$usuario->setId($idUsuario);
	
	$usuarioDAO->atualizaSenha($usuario);
	
	$nomeCliente = $usuarioDAO->getNomeCliente($email);
	
	// Envia Nova Senha Para o E-mail do Cleinte
//	$enviaEmail = $sendMail->enviaEmailNovaSenha($email,$novaSenha,$nomeCliente);
	
//	if ($enviaEmail == true) {
		header("Location: ../view/esqueceuSenha.php?sucesso=Senha Regerada com Sucesso.");
//	} else {
//		header("Location: ../esqueceuSenha.php?erro=Falha no Envio do E-mail");
//	}
	
}


?>