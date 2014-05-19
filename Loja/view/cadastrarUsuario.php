<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>

<script src="../jquery-accordion/lib/jquery.js" type="text/javascript"></script>
<script src="../jquery-accordion/jquery.maskedinput.js" type="text/javascript"></script>


<script>

jQuery(function($){
       $("#txtcpf").mask("999.999.999-99");
       $("#txtnascimento").mask("99/99/9999");
       $("#txtcep").mask("99999-999");
       $("#txttelefone").mask("(99) 99999-9999");
       $("#txttelefone2").mask("(99) 99999-9999");
});
</script>

<body>

<?php 

session_start();

include_once('../model/DBConexao.class.php');
include_once('../model/Util.class.php');

$dbConexao = new DBConexao();
$dbConexao->conecta();

// 1 - Cadastrar Novo Usu�rio
// 2 - Alterar Dados Cadastrais do Usu�rio
// 3 - Alterar Endere�o do Usu�rio
// 4 - Alterar E-mail do Usu�rio
// 5 - Alterar Senha do Usu�rio
$acao = 1;

// Resgatando as Informa��es de Erro na Valida��o do Login
$erro = explode(',', $_GET[erro]);
$dados = explode(',', $_GET[dados]);

?>

<?php include '../include/menu.php'; ?>

	<table border="1" align="center">
	
		<tr>
		
			<td>
			
				<form action="../control/controleUsuario.php" method="post">
			
				<table>
					<tr>
					
						<td colspan="3" rowspan="1">Seja Bem-Vindo!Cadastrar Novo Usu�rio</td>
					
					</tr>
					
					<tr>
					
						<td colspan="3">
							<br/>Informa��es Pessoais<br/>
							
								<?php if ($_GET[sucesso] != "") { ?> <b><br/> <?php print urldecode($_GET[sucesso]); ?> </b><br/> <?php } ?>
								<?php if ($_GET[erro] != "") { ?>  <b><br/> <?php print urldecode($erro[0]); ?> </b><br/> <?php } ?>
						
							<br/>
						</td>
					
					</tr>
				
					<tr>
						<td><label>Nome Completo</label><em>*</em></td>
						<td><input type="text" id="txtnome" maxlength="80" name="txtnome" value="<?PHP print $dados[1]; ?>" title="Nome Completo"/></td>
						<td><?php if ($erro[1] <> "") { print $erro[1]; } ?></td>
					</tr>
					
					<tr>
						<td><label>Apelido</label></td>
						<td><input type="text" id="txtapelido" maxlength="20" name="txtapelido" value="<?PHP print $dados[2]; ?>" title="Apelido"/></td>
						<td><?php if ($erro[2] <> "") { print $erro[2]; } ?></td>
					</tr>
													
					<tr>
						<td><label>CPF</label><em>*</em></td>
						<td><input type="text" name="txtcpf" id="txtcpf" title="CPF" value="<?PHP print $dados[3]; ?>" /></td>
						<td><?php if ($erro[3] <> "") { print $erro[3]; } ?></td>
					</tr>
					
					<tr>
						<td><label>Data de Nascimento</label><em>*</em></td>
						<td><input type="text" name="txtnascimento" id="txtnascimento" title="Data de Nascimento" value="<?PHP print $dados[4]; ?>"/></td>
						<td><?php if ($erro[4] <> "") { print $erro[4]; } ?></td>
					</tr>
					
					<tr>
						<td>Sexo<em>*</em></td>
						<td>
							<select name="fgsexo" id="fgsexo" title="Sexo">
                            	<option value="<?PHP print $dados[5]; ?>" ><?PHP print $dados[5]; ?></option>
								<option value="M" >Masculino</option>
                                <option value="F" >Feminino</option>
				        	</select>
						</td>
						<td><?php if ($erro[5] <> "") { print $erro[5]; } ?></td>
					</tr>
					
					<tr>
						<td>Telefone Fixo<em>*</em></td>
						<td><input type="text" name="txttelefone" value="<?PHP print $dados[6]; ?>" title="Telefone" id="txttelefone" /></td>
						<td><?php if ($erro[6] <> "") { print $erro[6]; } ?></td>
					</tr>										

					<tr>
						<td>Telefone M�vel</td>
						<td><input type="text" name="txttelefone2" id="txttelefone2" title="Telefone2" value="<?PHP print $dados[7]; ?>" /></td>
						<td><?php if ($erro[7] <> "") { print $erro[7]; } ?></td>
					</tr>	


					<tr>
					
						<td colspan="3"><br/>Informa��es de Login<br/><br/></td>
					
					</tr>
					
					<tr>
						<td>E-mail<em>*</em></td>
						<td><input type="text" name="txtemail" id="txtemail" maxlength="80" title="E-mail" value="<?PHP print $dados[8]; ?>" /></td>
						<td><?php if ($erro[8] <> "") { print $erro[8]; } ?></td>
					</tr>					
					

					<tr>
						<td>Repita o E-mail<em>*</em></td>
						<td><input type="text" name="txtemail2" id="txtemail2" maxlength="80" title="Repita o E-mail" value="<?PHP print $dados[9]; ?>" /></td>
						<td><?php if ($erro[9] <> "") { print $erro[9]; } ?></td>
					</tr>					


					<tr>
						<td>Senha (6 a 20 Caracteres)<em>*</em></td>
						<td><input type="password" name="txtsenha" id="txtsenha" maxlength="20" title="Senha" value="<?PHP print $dados[10]; ?>" /></td>
						<td><?php if ($erro[10] <> "") { print $erro[10]; } ?></td>
					</tr>					


					<tr>
						<td>Repita a Senha<em>*</em></td>
						<td><input type="password" name="txtsenha2" id="txtsenha2" maxlength="20" title="Repita a Senha" value="<?PHP print $dados[11]; ?>" /></td>
						<td><?php if ($erro[11] <> "") { print $erro[11]; } ?></td>
					</tr>					

					<tr>
						<td colspan="3"><br/>Endere�o<br/><br/></td>
					
					</tr>
					
					<tr>
						<td>Logradouro<em>*</em></td>
						<td><input type="text" name="txtendereco" value="<?PHP print $dados[12]; ?>" maxlength="80" title="Endere�o" id="txtendereco" /></td>
						<td><?php if ($erro[12] <> "") { print $erro[12]; } ?></td>

					</tr>

					<tr>
						<td>N�mero<em>*</em></td>
						<td><input type="text" name="txtnumero" value="<?PHP print $dados[13]; ?>" maxlength="11" title="N�mero" id="txtnumero" /></td>
						<td><?php if ($erro[13] <> "") { print $erro[13]; } ?></td>
					</tr>

					<tr>
						<td>Complemento</td>
						<td><input type="text" name="txtcomplemento" id="txtcomplemento" maxlength="20" title="Complemento" value="<?PHP print $dados[14]; ?>" /></td>
						<td><?php if ($erro[14] <> "") { print $erro[14]; } ?></td>
					</tr>

					<tr>
						<td>Bairro<em>*</em></td>
						<td><input type="text" name="txtbairro" value="<?PHP print $dados[15]; ?>" maxlength="45" title="Bairro" id="txtbairro" /></td>
						<td><?php if ($erro[15] <> "") { print $erro[15]; } ?></td>
					</tr>

					<tr>
						<td>CEP<em>*</em></td>
						<td><input type="text" name="txtcep" id="txtcep" title="CEP" value="<?PHP print $dados[16]; ?>"/></td>
						<td><?php if ($erro[16] <> "") { print $erro[16]; } ?></td>
					</tr>
					
					<tr>
						<td>Cidade<em>*</em></td>
						<td><input type="text" name="txtcidade" value="<?PHP print $dados[17]; ?>" maxlength="45"  title="Cidade" id="txtcidade" /></td>
						<td><?php if ($erro[17] <> "") { print $erro[17]; } ?></td>
					</tr>
			
					<tr>
						<td>Estado<em>*</em></td>
						<td>
							<select id="txtestado" name="txtestado" title="Estado">
                            	<?php  
                                                       
                                	// Recebe o ResultSet com as Informa��es dos Estados Brasileiros
                                    $rs = Util::getEstados();
                                                       
                                    while ( $reg = mysql_fetch_array($rs)) { ?>
                                                       
                                    	<option id="�dEstado" <?php if ($reg["NM_ESTADO"] == $dados[18]) { ?> selected="selected" <?php } ?>  value="<?php print $reg["ID_ESTADO"]; ?>" ><?php print $reg["NM_ESTADO"]; ?></option>
                                                       
                                    <?php } ?>
                            </select>
						</td>
						<td><?php if ($erro[18] <> "") { print $erro[18]; } ?></td>
					</tr>

					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
			

					<tr>
						<td><button type="submit" title="Cadastrar Cliente" class="button"><span><span>Cadastrar Cliente</span></span></button></td>
					</tr>

				
				</table>
				
				<input type="hidden" id="acao" value="<?php print $acao ?>" name="acao"/>
			
				</form>			
			
			</td>
		
		</tr>
		

	
	</table>


</body>
</html>