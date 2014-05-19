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
$acao = 3;

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
					
						<td colspan="3" rowspan="1">Alteração de Endereço</td>
					
					</tr>
					
					<tr>
					
						<td colspan="3">
								<?php if ($_GET[sucesso] != "") { ?> <b><br/> <?php print urldecode($_GET[sucesso]); ?> </b><br/> <?php } ?>
								<?php if ($_GET[erro] != "") { ?>  <b><br/> <?php print urldecode($erro[0]); ?> </b><br/> <?php } ?>
						
							<br/>
						</td>
					
					</tr>

					
					<tr>
						<td>Logradouro<em>*</em></td>
						<td><input type="text" name="txtendereco" value="<?PHP if ($erro[1] == "") { print $usuario["NM_ENDERECO"]; } else { print $dados[1]; } ?>" maxlength="80" title="Endereço" id="txtendereco" /></td>
						<td><?php if ($erro[1] <> "") { print $erro[1]; } ?></td>

					</tr>

					<tr>
						<td>Número<em>*</em></td>
						<td><input type="text" name="txtnumero" value="<?PHP if ($erro[2] == "") { print $usuario["NO_ENDERECO"]; } else { print $dados[2]; } ?>" maxlength="11" title="Número" id="txtnumero" /></td>
						<td><?php if ($erro[2] <> "") { print $erro[2]; } ?></td>
					</tr>

					<tr>
						<td>Complemento</td>
						<td><input type="text" name="txtcomplemento" id="txtcomplemento" maxlength="20" title="Complemento" value="<?PHP if ($erro[3] == "") { print $usuario["NM_COMPLEMENTO"]; } else { print $dados[3]; } ?>" /></td>
						<td><?php if ($erro[3] <> "") { print $erro[3]; } ?></td>
					</tr>

					<tr>
						<td>Bairro<em>*</em></td>
						<td><input type="text" name="txtbairro" value="<?PHP if ($erro[4] == "") { print $usuario["NM_BAIRRO"]; } else { print $dados[4]; } ?>" maxlength="45" title="Bairro" id="txtbairro" /></td>
						<td><?php if ($erro[4] <> "") { print $erro[4]; } ?></td>
					</tr>

					<tr>
						<td>CEP<em>*</em></td>
						<td><input type="text" name="txtcep" id="txtcep" title="CEP" value="<?PHP if ($erro[5] == "") { print $usuario["NO_CEP"]; } else { print $dados[5]; } ?>"/></td>
						<td><?php if ($erro[5] <> "") { print $erro[5]; } ?></td>
					</tr>
					
					<tr>
						<td>Cidade<em>*</em></td>
						<td><input type="text" name="txtcidade" value="<?PHP if ($erro[6] == "") { print $usuario["NM_CIDADE"]; } else { print $dados[6]; } ?>" maxlength="45"  title="Cidade" id="txtcidade" /></td>
						<td><?php if ($erro[6] <> "") { print $erro[6]; } ?></td>
					</tr>
			
					<tr>
						<td>Estado<em>*</em></td>
						<td>
							<select id="txtestado" name="txtestado" title="Estado">
                            	<?php  

                            	if ($erro[7] <> "") {
									$usuario["NM_ESTADO"] = "";
								} 
								
                            	
                                	// Recebe o ResultSet com as Informações dos Estados Brasileiros
                                    $rs = Util::getEstados();
                                                       
                                    while ( $reg = mysql_fetch_array($rs)) { ?>
                                                       
                                   		<option id="ïdEstado" <?php if ( ($usuario["NM_ESTADO"] == $reg["ID_ESTADO"]) || ($reg["ID_ESTADO"] == $dados[7]) ) { ?> selected="selected" <?php } ?>  value="<?php print $reg["ID_ESTADO"]; ?>" ><?php print $reg["NM_ESTADO"]; ?></option>
                                   		
                                    <?php } ?>
                            </select>
						</td>
						<td><?php if ($erro[7] <> "") { print $erro[7]; } ?></td>
					</tr>

					
			

					<tr>
						<td>
							<button type="submit" title="Alterar Dados Cadastrais" value="3" name="tipoAlteracao" class="button"><span><span>Alterar Endereço</span></span></button>
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