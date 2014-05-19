<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="./css/style.css"/>
<title>Guaianas Importa&ccedil;&atilde;o e Com&eacute;rcio</title>
</head>

<body  class=" catalog-category-view categorypath-laptops-notebooks-html category-laptops-notebooks">

<script src="jquery-accordion/lib/jquery.js" type="text/javascript"></script>
<script src="jquery-accordion/jquery.maskedinput.js" type="text/javascript"></script>

<script>

jQuery(function($){
       $("#txtcpf").mask("999.999.999-99");
       $("#txtnascimento").mask("99/99/9999");
       $("#txttelefone").mask("(99) 99999-9999");
       $("#txttelefone2").mask("(99) 99999-9999");
});
</script>

<?php 
session_start();

// 1 - Cadastrar Novo Usuário
// 2 - Alterar Dados Cadastrais do Usuário
// 3 - Alterar Endereço do Usuário
// 4 - Alterar E-mail do Usuário
// 5 - Alterar Senha do Usuário
$acao = 5;

// Resgatando as Informações de Erro na Validação da Alteração de Senha
$erro = explode(',', $_GET[erro]);
$dados = explode(',', $_GET[dados]);

include_once('../control/controleSessao.php');
include_once('../model/DBConexao.class.php');
include_once('../dao/UsuarioDAO.class.php');

validaSessao();

$email = $_SESSION["user"];

$db = new DBConexao();
$db->conecta();

$usuario = UsuarioDAO::getInfoUsuario($email);

?>

		<?php include '../include/menu.php'; ?>

	<table border="1" align="center">
	
		<tr>
		
			<td>
			
				<form action="../control/controleUsuario.php" method="post">
			
				<table>
					<tr>
					
						<td colspan="3" rowspan="1">Senha</td>
					
					</tr>
					
					<tr>
					
						<td colspan="3">
	
							
								<?php if ($_GET[sucesso] != "") { ?> <b><br/> <?php print urldecode($_GET[sucesso]); ?> </b><br/> <?php } ?>
								<?php if ($_GET[erro] != "") { ?>  <b><br/> <?php print urldecode($erro[0]); ?> </b><br/> <?php } ?>
						
							<br/>
						</td>
					
					</tr>

					
					<tr>
						<td>Senha (6 a 20 Caracteres)<em>*</em></td>
						<td><input type="password" name="txtsenha" id="txtsenha" maxlength="20" title="Senha" value="" /></td>
						<td><?php if ($erro[1] <> "") { print $erro[1]; } ?></td>
					</tr>					


					<tr>
						<td>Repita a Senha<em>*</em></td>
						<td><input type="password" name="txtsenha2" id="txtsenha2" maxlength="20" title="Repita a Senha" value="" /></td>
						<td><?php if ($erro[2] <> "") { print $erro[2]; } ?></td>
					</tr>					

					<tr>
						<td>
							<button type="submit" title="Alterar Dados Cadastrais" value="5" name="tipoAlteracao" class="button"><span><span>Alterar Senha</span></span></button>
						</td>
					</tr>

				
				</table>
				
				<input type="hidden" id="acao" value="<?php print $acao ?>" name="acao"/>
			
				</form>			
			
			</td>
		
		</tr>
		

	
	</table>

</body>
</html>    	