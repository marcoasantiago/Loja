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
$acao = 2;

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
					
						<td colspan="3" rowspan="1">Alteração de Dados Cadastrais</td>
					
					</tr>
					
					<tr>
					
						<td colspan="3">
							<br/>Informações Pessoais<br/>
							
								<?php if ($_GET[sucesso] != "") { ?> <b><br/> <?php print urldecode($_GET[sucesso]); ?> </b><br/> <?php } ?>
								<?php if ($_GET[erro] != "") { ?>  <b><br/> <?php print urldecode($erro[0]); ?> </b><br/> <?php } ?>
						
							<br/>
						</td>
					
					</tr>
				
					<tr>
						<td><label>Nome Completo</label><em>*</em></td>
						<td><input type="text" id="txtnome" maxlength="80" name="txtnome" value="<?PHP if ($erro[1] == "") { print $usuario["NM_CLIENTE"]; } else { print $dados[1]; } ?>" title="Nome Completo"/></td>
						<td><?php if ($erro[1] <> "") { print $erro[1]; } ?></td>
					</tr>
					
					<tr>
						<td><label>Apelido</label></td>
						<td><input type="text" id="txtapelido" maxlength="20" name="txtapelido" value="<?PHP if ($erro[2] == "") { print $usuario["NM_APELIDO"]; } else { print $dados[2]; } ?>" title="Apelido"/></td>
						<td><?php if ($erro[2] <> "") { print $erro[2]; } ?></td>
					</tr>
													
					<tr>
						<td><label>CPF</label><em>*</em></td>
						<td><?PHP print Util::formataCPF($usuario["NO_CPF"]); ?></td>
						<td></td>
					</tr>
					
					<tr>
						<td><label>Data de Nascimento</label><em>*</em></td>
						<td><input type="text" name="txtnascimento" id="txtnascimento" title="Data de Nascimento" value="<?PHP if ($erro[3] == "") { print $usuario["DT_NASCIMENTO"]; } else { print $dados[3]; } ?>"/></td>
						<td><?php if ($erro[3] <> "") { print $erro[3]; } ?></td>
					</tr>
					
					<tr>
						<td>Sexo<em>*</em></td>
						<td>
							<select name="fgsexo" id="fgsexo" title="Sexo">
							
								<?php 
								if ($erro[4] <> "") {
									$usuario["FG_SEXO"] = "";
								}
								?>
							
								<option <?php if ( ($erro[4] <> "" )  ||  ("" == $dados[4]) ) { ?> selected="selected" <?php } ?> value="" >Selecione uma Opção</option>
                                <option <?php if ( ($usuario["FG_SEXO"] == "M" )  || ("M" == $dados[4]) ) { ?> selected="selected" <?php } ?> value="M" >Masculino</option>
                                <option <?php if ( ($usuario["FG_SEXO"] == "F" )  || ("F" == $dados[4]) ) { ?> selected="selected" <?php } ?> value="F" >Feminino</option>							

				        	</select>
						</td>
						<td><?php if ($erro[4] <> "") { print $erro[4]; } ?></td>
					</tr>
					
					<tr>
						<td>Telefone Fixo<em>*</em></td>
						<td><input type="text" name="txttelefone" value="<?PHP if ($erro[5] == "") { print $usuario["NO_TELEFONE_1"]; } else { print $dados[5]; } ?>" title="Telefone" id="txttelefone" /></td>
						<td><?php if ($erro[5] <> "") { print $erro[5]; } ?></td>
					</tr>										

					<tr>
						<td>Telefone Móvel</td>
						<td><input type="text" name="txttelefone2" id="txttelefone2" title="Telefone2" value="<?PHP if ($erro[6] == "") { print $usuario["NO_TELEFONE_2"]; } else { print $dados[6]; } ?>" /></td>
						<td><?php if ($erro[6] <> "") { print $erro[6]; } ?></td>
					</tr>	


					
			

					<tr>
						<td>
							<button type="submit" title="Alterar Dados Cadastrais" value="2" name="tipoAlteracao" class="button"><span><span>Alterar Cadastro</span></span></button>
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