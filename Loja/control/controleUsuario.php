<?php

// Inicializa Sessão do Usuário
session_start();

// Declaração de Classes
include_once('../model/DBConexao.class.php');
include_once('../model/Usuario.class.php');
include_once('../model/Util.class.php');
include_once('../dao/UsuarioDAO.class.php');
include_once('../control/controleSessao.php');


// Inicializa Conexão com o Banco de Dados
$db = new DBConexao();
$db->conecta();


// Armazena os Erros do Formulário de Cadastro
$erro = Array();
$dados = Array();

// Resgatando os dados do formulário
$form = $_POST;

// Instanciamento da Classe Usuario
$usuario = new Usuario();


// Instaciamento da Classe de E-mail
//$sendMail = new Email();

// Atribuição de Valores Passados através do Método POST
$usuario->setId(UsuarioDAO::getIdUsuario($_SESSION["user"]));
$usuario->setApelido($form[txtapelido]);
$usuario->setNome($form[txtnome]);
$usuario->setCPF(Util::removeCaracteres($form[txtcpf]));
$usuario->setDtNascimento(Util::removeCaracteres($form[txtnascimento]));
$usuario->setSexo($form[fgsexo]);
$usuario->setEmail($form[txtemail]);
$usuario->setRepeteEmail($form[txtemail2]);
$usuario->setSenha($form[txtsenha]);
$usuario->setRepeteSenha($form[txtsenha2]);
$usuario->setCEP(Util::removeCaracteres($form[txtcep]));
$usuario->setEndereco($form[txtendereco]);
$usuario->setNumero($form[txtnumero]);
$usuario->setComplemento($form[txtcomplemento]);
$usuario->setBairro($form[txtbairro]);
$usuario->setCidade($form[txtcidade]);
$usuario->setEstado($form[txtestado]);
$usuario->setTelefone(Util::removeCaracteres($form[txttelefone]));
$usuario->setTelefone2(Util::removeCaracteres($form[txttelefone2]));

print "ID Usuario: " . $usuario->getId() . "<br/>";
print "Apelido: " . $usuario->getApelido() . "<br/>";
print "Nome Completo: " . $usuario->getNome() . "<br/>";
print "CPF: " . $usuario->getCPF() . "<br/>";
print "Data Nascimento: " . $usuario->getDtNascimento() . "<br/>";
print "Sexo: " . $usuario->getSexo() . "<br/>";
print "E-mail: " . $usuario->getEmail() . "<br/>";
print "Repete E-mail: " . $usuario->getRepeteEmail() . "<br/>";
print "Senha: " . $usuario->getSenha() . "<br/>";
print "Repete Senha: " . $usuario->getRepeteSenha() . "<br/>";
print "CEP " . $usuario->getCEP() . "<br/>";
print "Endereço: " . $usuario->getEndereco() . "<br/>";
print "Número: " . $usuario->getNumero() . "<br/>";
print "Complemento: " . $usuario->getComplemento() . "<br/>";
print "Bairro: " . $usuario->getBairro() . "<br/>";
print "Cidade: " . $usuario->getCidade() . "<br/>";
print "Estado: " . $usuario->getEstado() . "<br/>";
print "Telefone: " . $usuario->getTelefone() . "<br/>";
print "Telefone2: " . $usuario->getTelefone2() . "<br/>";



// Verifica a Ação a Ser Executada
$acao = $_POST['acao'];

print "Ação: " . $acao . "<br/>";


// 1 - Cadastrar Novo Usuário
// 2 - Alterar Dados Cadastrais do Usuário
// 3 - Alterar Endereço do Usuário
// 4 - Alterar E-mail do Usuário
// 5 - Alterar Senha do Usuário

switch ($acao) {
	
	case 1:
		cadastraUsuario($acao,$usuario);
 		break;

	case 2:
		alterarCadastro($acao, $usuario);
		break;

	case 3:
		alterarEndereco($acao, $usuario);
		break;
		
	case 4:
		alterarEmail($acao, $usuario);
		break;

	case 5:
		alterarSenha($acao, $usuario);
		break;		
}


// FUNÇÃO QUE REALIZA O CADASTRO DE UM NOVO USUARIO NA BASE DE DADOS DO SISTEMA
function cadastraUsuario($acao,$usuario) {

	$Ok = boolean;

	$erro[0] = "";
	$dados[0] = "";
	
	$util = new Util();
	$usuarioDAO = new usuarioDAO();
			
	// Valida Preenchimento de Campos Obrigatórios
	
	// Valida Preenchimento do Nome Completo
	if ( $usuario->getNome() == "" ) {
		$erro[1] = "Informe o Nome Completo";
		$dados[1] = "";
		$Ok = False;
	} else {
		$erro[1] = "";
		$dados[1] = $usuario->getNome();
	}
	

	// Apelido
	$erro[2] = "";
	$dados[2] = $usuario->getApelido();
	
	
	// Valida Preenchimento do CPF
	if ( $usuario->getCPF() == "" ) {
		$erro[3] = "Informe o CPF";
		$dados[3] = "";
		$Ok = False;
	} else {
		
		if ($util->validaCPF($usuario->getCPF()) == false) {
		
			$erro[3] = "CFP Informado N&atilde;o &eacute; V&aacute;lido";
			$dados[3] = "";
			$Ok = False;
		
		} else {

			if ($usuarioDAO->verificaCPFDuplicado($usuario->getCPF())== 1) {
				
				$erro[3] = "CFP ja Cadastrado na Base de Dados";
				$dados[3] = "";
				$Ok = False;				
				
			} else {
			
				$erro[3] = "";
				$dados[3] = $usuario->getCPF();
			}
			
		}
	
	}

	
	// Valida Preenchimento de Data de Nascimento
	if ( $usuario->getDtNascimento() == "" ) {
		$erro[4] = "Informe a Data de Nascimento";
		$dados[4] = "";
		$Ok = False;
	} else {
		$erro[4] = "";
		$dados[4] = $usuario->getDtNascimento();
	}
	
	// Valida Preenchimento do Sexo
	if ( $usuario->getSexo() == "" ) {
		$erro[5] = "Informe o Sexo";
		$dados[5] = "";
		$Ok = False;
	} else {
		$erro[5] = "";
		$dados[5] = $usuario->getSexo();
	}
	
	// Valida Preenchimento de Telefone
	if ( $usuario->getTelefone() == "" ) {
		$erro[6] = "Informe o Telefone de Contato";
		$dados[6] = "";
		$Ok = False;
	} else {
		$erro[6] = "";
		$dados[6] = $usuario->getTelefone();
	}
	
	// Telefone 2
	$erro[7] = "";
	$dados[7] = $usuario->getTelefone2();

	// Valida Se já Existe E-mail Cadastrado
	// Valida Preenchimento de E-Mail
	if ( $usuario->getEmail() == "" ) {
		$erro[8] = "Informe um e-mail";
		$dados[8] = "";
		$Ok = False;
	} else {
	
		if ( $util->validaEmail($usuario->getEmail()) == FALSE ) {
	
				$erro[8] = "Endere&ccedil;o de e-mail informado &eacute; inv&aacute;lido";
				$dados[8] = "";
	
				$Ok = False;
				
		} else {
		
			if ( $usuarioDAO->validaEmail($usuario->getEmail()) > 0 ) {
		
				$erro[8] = "Endere&ccedil;o de e-mail j&aacute; cadastrado";
				$dados[8] = "";
		
				$Ok = False;
				
			} else {
			
				$erro[8] = "";
				$dados[8] = $usuario->getEmail();
	
			}
			
		}
	
	}
	
	// Verifica Preenchimento do Campo E-Mail
	if ( $usuario->getRepeteEmail() == "" ) {
		
		$erro[9] = "Informe um e-mail";
		$dados[9] = ""; //$usuario->getEmail();
		$Ok = False;
		
	} else {

		if ( $util->validaEmail($usuario->getRepeteEmail()) == FALSE ) {
	
				$erro[9] = "Endere&ccedil;o de e-mail informado &eacute; inv&aacute;lido";
				$dados[9] = "";
	
				$Ok = False;

		} else {

			if ( $usuario->getRepeteEmail() <> $usuario->getEmail() ) {

				$erro[9] = "Endere&ccedil;os de e-mail informados são diferentes";
				$dados[9] = "";
	
				$Ok = False;				
			
			} else {
				
				$erro[9] = "";
				$dados[9] = $usuario->getRepeteEmail();
				
			}
		
		}
	}
	
	
	//print "valida E-mail: " . $usuarioDAO->validaEmail($usuario->getEmail()) ."<br/>";
	
	// Valida Preenchimento de Senha
	if ( $usuario->getSenha() == "" ) {
		$erro[10] = "Informe uma Senha";
		$dados[10] = "";
		$Ok = False;
	} else {
		
		if ( (strlen($usuario->getSenha()) < 6) || (strlen($usuario->getSenha()) > 20) ) {
		
			$erro[10] = "O tamanho da senha deve conter de 6 a 20 caracteres";
			$dados[10] = "";
			$Ok = False;
		
		} else {
	
			$erro[10] = "Informe uma Senha";
			$dados[10] = "";
			
		}
		
	}
	

	
	
	// Valida a Contra-Prova da Senha
	if ( $usuario->getRepeteSenha() == "" ) { // && $usuario->getSenha() <> "" ) {
	
		$erro[11] = "Informar Contra Senha";
		$dados[11] = "";
		$Ok = False;	
	
	} else { 
	
		if ( (strlen($usuario->getRepeteSenha()) < 6) || (strlen($usuario->getRepeteSenha()) > 20) ) {
		
			$erro[11] = "O tamanho da senha deve conter de 6 a 20 caracteres";
			$dados[11] = "";
			$Ok = False;
		
		} else { 
		
			if ( $usuario->getSenha() <> $usuario->getRepeteSenha() && $usuario->getSenha() <> "" ){
				$erro[11] = "Senhas Informadas s&atilde;o Divergentes";
				$dados[11] = "";
				$Ok = False;
		
			} else {
			
				$erro[11] = "Informar Contra Senha";
				$dados[11] = "";
			}
	
		}
		
	}
	
	
		
	// Valida Preenchimento de Endereço
	if ( $usuario->getEndereco() == "" ) {
		$erro[12] = "Informe o Endere&ccedil;o";
		$dados[12] = "";
		$Ok = False;
	} else {
		$erro[12] = "";
		$dados[12] = $usuario->getEndereco();
	}
	
	// Valida Preenchimento de Número
	if ( $usuario->getNumero() == "" ) {
		$erro[13] = "Informe o N&uacute;mero do Endere&ccedil;o de Cadastro";
		$dados[13] = "";
		$Ok = False;
	} else {
		$erro[13] = "";
		$dados[13] = $usuario->getNumero();
	}
	
	// Complemento
	$erro[14] = "";
	$dados[14] = $usuario->getComplemento();
	
	
	// Valida Preenchimento de Bairro
	if ( $usuario->getBairro() == "" ) {
		$erro[15] = "Informe o Bairro";
		$dados[15] = "";
		$Ok = False;
	} else {
		$erro[15] = "";
		$dados[15] = $usuario->getBairro();
	}
	
	// Valida Preenchimento de CEP
	if ( $usuario->getCEP() == "" ) {
		$erro[16] = "Informe o CEP do Endere&ccedil;o de Cadastro";
		$dados[16] = "";
		$Ok = False;
	} else {
		$erro[16] = "";
		$dados[16] = $usuario->getCEP();
	}
	
	// Valida Preenchimento de Cidade
	if ( $usuario->getCidade() == "" ) {
		$erro[17] = "Informe a Cidade";
		$dados[17] = "";
		$Ok = False;
	} else {
		$erro[17] = "";
		$dados[17] = $usuario->getCidade();
	}
	
	// Valida Preenchimento de Estado
	if ( $usuario->getEstado() == "0" ) {
		$erro[18] = "Informe o Estado";
		$dados[18] = "";
		$Ok = False;
	} else {
		$erro[18] = "";
		$dados[18] = $usuario->getEstado();
	}

	
	
	// Se ocorreu algum erro na validação dos dados cadastrais do usuário apresenta mensagens
	// de erro na tela de Cadastro. Caso contrário criar usuário no sistema
	if ($Ok == False)  {
		$erro[0] = "Verifique o preenchimento dos campos obrigat&oacute;rios";
		header("Location: ../view/cadastrarUsuario.php?erro=" . urlencode(implode(',', $erro)) . "&dados=" . urlencode(implode(',', $dados)));	
	} else {
	
		print "Antes do Cadastro de Usuario ...";
		
		// Insere as Informações do Cliente no Banco de Dados
		$resultado = $usuarioDAO->cadastraUsuario($usuario);
	
		print "Resultado: ". $resultado;
		
		if ($resultado == -1) {

			$erro[0] = "Erro no Cadastro do Usuário";
			header("Location: ../view/cadastrarUsuario.php?erro=" . urlencode(implode(',', $erro)) . "&dados=" . urlencode(implode(',', $dados)));
			
		}
		
		print "Antes do Envio do E-mail ...";
		
		//Envia o e-mail de Confirmação do Cadastro do Usuário
		//$enviaEmail = $sendMail->enviaEmailNovoUsuario($usuario->getEmail(),$usuario->getSenha(),$usuarioDAO->getNomeCliente($usuario->getEmail()));
		
		//if ($enviaEmail == true) {
	
			// Loga usuário na Sessão
			inicializaSessao($usuario->getEmail());
			
			$sucesso = "Usu%26aacute;rio Cadastrado com Sucesso";
		
			header("Location: ../view/cadastrarUsuario.php?sucesso=" . $sucesso);
				
	//	} else {
			
	//		header("Location: ../cadastroCliente.php?mail=Falha no Envio do E-mail");
	//	}
		
	}

}

// FUNÇÃO QUE REALIZA ALTERAÇÃO DE DADOS CADASTRAIS DO USUARIO NA BASE DE DADOS DO SISTEMA
function alterarCadastro($acao,$usuario) {

	$Ok = boolean;

	$erro[0] = "";
	$dados[0] = "";
	
	$util = new Util();
	$usuarioDAO = new UsuarioDAO();
			
	// Valida Preenchimento de Campos Obrigatórios
	
	
	// Valida Preenchimento do Nome Completo
	if ( $usuario->getNome() == "" ) {
		$erro[1] = "Informe o Nome Completo";
		$dados[1] = "";
		$Ok = False;
	} else {
		$erro[1] = "";
		$dados[1] = $usuario->getNome();
	}
	

	// Apelido
	$erro[2] = " ";
	$dados[2] = $usuario->getApelido();
	
	
	// Valida Preenchimento de Data de Nascimento
	if ( $usuario->getDtNascimento() == "" ) {
		$erro[3] = "Informe a Data de Nascimento";
		$dados[3] = "";
		$Ok = False;
	} else {
		$erro[3] = "";
		$dados[3] = $usuario->getDtNascimento();
	}
	
	// Valida Preenchimento do Sexo
	if ( $usuario->getSexo() == "" ) {
		$erro[4] = "Informe o Sexo";
		$dados[4] = "";
		$Ok = False;
	} else {
		$erro[4] = "";
		$dados[4] = $usuario->getSexo();
	}
	
	// Valida Preenchimento de Telefone
	if ( $usuario->getTelefone() == "" ) {
		$erro[5] = "Informe o Telefone de Contato";
		$dados[5] = "";
		$Ok = False;
	} else {
		$erro[5] = "";
		$dados[5] = $usuario->getTelefone();
	}
	
	// Telefone 2
	$erro[6] = " ";
	$dados[6] = $usuario->getTelefone2();

	// Se ocorreu algum erro na validação dos dados cadastrais do usuário apresenta mensagens
	// de erro na tela de Cadastro. Caso contrário criar usuário no sistema
	if ($Ok == False)  {
		$erro[0] = "Verifique o preenchimento dos campos obrigat&oacute;rios";
		header("Location: ../view/alterarCadastro.php?erro=" . urlencode(implode(',', $erro)) . "&dados=" . urlencode(implode(',', $dados)));	
	} else {
	
		print "Antes do Cadastro de Usuario ...";
		
		// Insere as Informações do Cliente no Banco de Dados
		$resultado = $usuarioDAO->atualizaCadastro($usuario);

		if ($resultado < 0) {
			
			$erro[0] = "Erro ao Atualizar o Cadastro do Usuário";
			header("Location: ../view/alterarCadastro.php?erro=" . urlencode(implode(',', $erro)) . "&dados=" . urlencode(implode(',', $dados)));
							
		} else {
				
			if ($resultado == 0) {

				$erro[0] = "Dados a Atualizar S&atilde;o Iguais aos J&aacute; Cadastrados no Banco de Dados";
				header("Location: ../view/alterarCadastro.php?erro=" . urlencode(implode(',', $erro)) . "&dados=" . urlencode(implode(',', $dados)));
								
				
			} else {

				$sucesso = "Dados Cadastrais Alterados com Sucesso";
				header("Location: ../view/alterarCadastro.php?sucesso=" . $sucesso);
			}
			
		}		
				
	}
	

}

// FUNÇÃO QUE REALIZA ALTERAÇÃO DO ENDEREÇO DE ENTREGA DO USUARIO NA BASE DE DADOS DO SISTEMA
function alterarEndereco($acao,$usuario) {
	
	$Ok = boolean;

	$erro[0] = "";
	$dados[0] = "";
	
	$util = new Util();
	$usuarioDAO = new UsuarioDAO();
			
	// Valida Preenchimento de Campos Obrigatórios

	// Valida Preenchimento de Endereço
	if ( $usuario->getEndereco() == "" ) {
		$erro[1] = "Informe o Endere&ccedil;o";
		$dados[1] = "";
		$Ok = False;
	} else {
		$erro[1] = "";
		$dados[1] = $usuario->getEndereco();
	}
	
	// Valida Preenchimento de Número
	if ( $usuario->getNumero() == "" ) {
		$erro[2] = "Informe o N&uacute;mero do Endere&ccedil;o de Cadastro";
		$dados[2] = "";
		$Ok = False;
	} else {
		$erro[2] = "";
		$dados[2] = $usuario->getNumero();
	}
	
	// Complemento
	$erro[3] = " ";
	$dados[3] = $usuario->getComplemento();
	
	
	// Valida Preenchimento de Bairro
	if ( $usuario->getBairro() == "" ) {
		$erro[4] = "Informe o Bairro";
		$dados[4] = "";
		$Ok = False;
	} else {
		$erro[4] = "";
		$dados[4] = $usuario->getBairro();
	}
	
	// Valida Preenchimento de CEP
	if ( $usuario->getCEP() == "" ) {
		$erro[5] = "Informe o CEP do Endere&ccedil;o de Cadastro";
		$dados[5] = "";
		$Ok = False;
	} else {
		$erro[5] = "";
		$dados[5] = $usuario->getCEP();
	}
	
	// Valida Preenchimento de Cidade
	if ( $usuario->getCidade() == "" ) {
		$erro[6] = "Informe a Cidade";
		$dados[6] = "";
		$Ok = False;
	} else {
		$erro[6] = "";
		$dados[6] = $usuario->getCidade();
	}
	
	// Valida Preenchimento de Estado
	if ( $usuario->getEstado() == "0" ) {
		$erro[7] = "Informe o Estado";
		$dados[7] = "";
		$Ok = False;
	} else {
		$erro[7] = "";
		$dados[7] = $usuario->getEstado();
	}
	
	// Se ocorreu algum erro na validação dos dados cadastrais do usuário apresenta mensagens
	// de erro na tela de Cadastro. Caso contrário criar usuário no sistema
	if ($Ok == False)  {
		$erro[0] = "Verifique o preenchimento dos campos obrigat&oacute;rios";
		header("Location: ../view/alterarEndereco.php?erro=" . urlencode(implode(',', $erro)) . "&dados=" . urlencode(implode(',', $dados)));	
	} else {
	
		print "Antes do Cadastro de Usuario ...";
		
		// Insere as Informações do Cliente no Banco de Dados
		$resultado = $usuarioDAO->atualizaEndereco($usuario);

		if ($resultado < 0) {
			
			$erro[0] = "Erro ao Atualizar o Endereço do Usuário";
			header("Location: ../view/alterarEndereco.php?erro=" . urlencode(implode(',', $erro)) . "&dados=" . urlencode(implode(',', $dados)));
							
		} else {
				
			if ($resultado == 0) {

				$erro[0] = "Dados a Atualizar S&atilde;o Iguais aos J&aacute; Cadastrados no Banco de Dados";
				header("Location: ../view/alterarEndereco.php?erro=" . urlencode(implode(',', $erro)) . "&dados=" . urlencode(implode(',', $dados)));
								
				
			} else {

				$sucesso = "Endereço do Usuario Alterado com Sucesso";
				header("Location: ../view/alterarEndereco.php?sucesso=" . $sucesso);
			}
			
		}		
				
	}
		
	
}

// FUNÇÃO QUE REALIZA ALTERAÇÃO DO E-MAIL DO USUARIO NA BASE DE DADOS DO SISTEMA
function alterarEmail($acao,$usuario) {
	
	$Ok = boolean;

	$erro[0] = "";
	$dados[0] = "";
	
	$util = new Util();
	$usuarioDAO = new UsuarioDAO();

	// Valida Se já Existe E-mail Cadastrado
	// Valida Preenchimento de E-Mail
	if ( $usuario->getEmail() == "" ) {
		$erro[1] = "Informe um e-mail";
		$dados[1] = "";
		$Ok = False;
	} else {
	
		if ( $util->validaEmail($usuario->getEmail()) == FALSE ) {
	
				$erro[1] = "Endere&ccedil;o de e-mail informado &eacute; inv&aacute;lido";
				$dados[1] = "";
	
				$Ok = False;
				
		} else {
		
			if ( $usuarioDAO->validaEmail($usuario->getEmail()) > 0 ) {
		
				$erro[1] = "Endere&ccedil;o de e-mail j&aacute; cadastrado";
				$dados[1] = "";
		
				$Ok = False;
				
			} else {
			
				$erro[1] = "";
				$dados[1] = $usuario->getEmail();
	
			}
			
		}
	
	}
		
	// Verifica Preenchimento do Campo E-Mail
	if ( $usuario->getRepeteEmail() == "" ) {
		
		$erro[2] = "Informe um e-mail";
		$dados[2] = ""; //$usuario->getEmail();
		$Ok = False;
		
	} else {

		if ( $util->validaEmail($usuario->getRepeteEmail()) == FALSE ) {
	
				$erro[2] = "Endere&ccedil;o de e-mail informado &eacute; inv&aacute;lido";
				$dados[2] = "";
	
				$Ok = False;

		} else {

			if ( $usuario->getRepeteEmail() <> $usuario->getEmail() ) {

				$erro[2] = "Endere&ccedil;os de e-mail informados são diferentes";
				$dados[2] = "";
	
				$Ok = False;				
			
			} else {
				
				$erro[2] = "";
				$dados[2] = $usuario->getRepeteEmail();
				
			}
		
		}
	}
	
	// Se ocorreu algum erro na validação dos dados cadastrais do usuário apresenta mensagens
	// de erro na tela de Cadastro. Caso contrário criar usuário no sistema
	if ($Ok == False)  {
		$erro[0] = "Verifique o preenchimento dos campos obrigat&oacute;rios";
		header("Location: ../view/alterarEmail.php?erro=" . urlencode(implode(',', $erro)) . "&dados=" . urlencode(implode(',', $dados)));	
	} else {
	
		//
		$resultado = $usuarioDAO->atualizaEMail($usuario);

		if ($resultado < 0) {
			
			$erro[0] = "Erro ao Atualizar o E-mail do Usuário";
			header("Location: ../view/alterarEmail.php?erro=" . urlencode(implode(',', $erro)) . "&dados=" . urlencode(implode(',', $dados)));
							
		} else {
				
			if ($resultado == 0) {

				$erro[0] = "Dados a Atualizar S&atilde;o Iguais aos J&aacute; Cadastrados no Banco de Dados";
				header("Location: ../view/alterarEmail.php?erro=" . urlencode(implode(',', $erro)) . "&dados=" . urlencode(implode(',', $dados)));
								
				
			} else {

				$_SESSION["user"] = $usuario->getEmail();
				
				$sucesso = "E-mail do Usuario Alterado com Sucesso";
				header("Location: ../view/alterarEmail.php?sucesso=" . $sucesso);
			}
			
		}		
				
	}	
		
}

// FUNÇÃO QUE REALIZA ALTERAÇÃO DA SENHA DO USUARIO NA BASE DE DADOS DO SISTEMA
function alterarSenha($acao,$usuario) {
	
	$Ok = boolean;

	$erro[0] = "";
	$dados[0] = "";
	
	$util = new Util();
	$usuarioDAO = new UsuarioDAO();	

	// Valida Preenchimento de Senha
	if ( $usuario->getSenha() == "" ) {
		$erro[1] = "Informe uma Senha";
		$dados[1] = "";
		$Ok = False;
	} else {
		
		if ( (strlen($usuario->getSenha()) < 6) || (strlen($usuario->getSenha()) > 20) ) {
		
			$erro[1] = "O tamanho da senha deve conter de 6 a 20 caracteres";
			$dados[1] = "";
			$Ok = False;
		
		} else {
	
			$erro[1] = "Informe uma Senha";
			$dados[1] = "";
			
		}
		
	}
	

	
	
	// Valida a Contra-Prova da Senha
	if ( $usuario->getRepeteSenha() == "" ) { // && $usuario->getSenha() <> "" ) {
	
		$erro[2] = "Informar Contra Senha";
		$dados[2] = "";
		$Ok = False;	
	
	} else { 
	
		if ( (strlen($usuario->getRepeteSenha()) < 6) || (strlen($usuario->getRepeteSenha()) > 20) ) {
		
			$erro[2] = "O tamanho da senha deve conter de 6 a 20 caracteres";
			$dados[2] = "";
			$Ok = False;
		
		} else { 
		
			if ( $usuario->getSenha() <> $usuario->getRepeteSenha() && $usuario->getSenha() <> "" ){
				$erro[2] = "Senhas Informadas s&atilde;o Divergentes";
				$dados[2] = "";
				$Ok = False;
		
			} else {
			
				$erro[2] = "Informar Contra Senha";
				$dados[2] = "";
			}
	
		}
		
	}	
	

	// Se ocorreu algum erro na validação dos dados cadastrais do usuário apresenta mensagens
	// de erro na tela de Cadastro. Caso contrário criar usuário no sistema
	if ($Ok == False)  {
		$erro[0] = "Verifique o preenchimento dos campos obrigat&oacute;rios";
		header("Location: ../view/alterarSenha.php?erro=" . urlencode(implode(',', $erro)) . "&dados=" . urlencode(implode(',', $dados)));	
	} else {
		
		//
		$resultado = $usuarioDAO->atualizaSenha($usuario);

		if ($resultado < 0) {
			
			$erro[0] = "Erro ao Atualizar a Senha do Usuário";
			header("Location: ../view/alterarSenha.php?erro=" . urlencode(implode(',', $erro)) . "&dados=" . urlencode(implode(',', $dados)));
							
		} else {
				
			if ($resultado == 0) {

				$erro[0] = "Nova Senha &eacute; Igual a Anterior";
				header("Location: ../view/alterarSenha.php?erro=" . urlencode(implode(',', $erro)) . "&dados=" . urlencode(implode(',', $dados)));
								
				
			} else {

				$sucesso = "Senha do Usuario Alterado com Sucesso";
				header("Location: ../view/alterarSenha.php?sucesso=" . $sucesso);
			}
			
		}		
				
	}	

	
}

?>