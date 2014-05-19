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
include_once('../control/controleSessao.php');
include_once('../dao/UsuarioDAO.class.php');

validaSessao();

$dbConexao = new DBConexao();
$dbConexao->conecta();

$email = $_SESSION["user"];

print "USER: ". $email ."<br>";

$usuario = UsuarioDAO::getInfoUsuario($email);

// 1 - Cadastrar Novo Usuário
// 2 - Alterar Usuário
$acao = 2;

// Resgatando as Informações de Erro na Validação do Login
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
					
						<td colspan="3" rowspan="1">Seja Bem-Vindo!Alterar Informações do Usuário</td>
					
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
						<td><input type="text" name="txtcpf" id="txtcpf" title="CPF" value="<?PHP if ($erro[3] == "") { print $usuario["NO_CPF"]; } else { print $dados[3]; } ?>" /></td>
						<td><?php if ($erro[3] <> "") { print $erro[3]; } ?></td>
					</tr>
					
					<tr>
						<td><label>Data de Nascimento</label><em>*</em></td>
						<td><input type="text" name="txtnascimento" id="txtnascimento" title="Data de Nascimento" value="<?PHP if ($erro[4] == "") { print $usuario["DT_NASCIMENTO"]; } else { print $dados[4]; } ?>"/></td>
						<td><?php if ($erro[4] <> "") { print $erro[4]; } ?></td>
					</tr>
					
					<tr>
						<td>Sexo<em>*</em></td>
						<td>
							<select name="fgsexo" id="fgsexo" title="Sexo">
							
								<option value=" " >Selecione uma Opção</option>
                                <option <?php if ( ($usuario["FG_SEXO"] == "M" )  || ("M" == $dados[5]) ) { ?> selected="selected" <?php } ?> value="M" >Masculino</option>
                                <option <?php if ( ($usuario["FG_SEXO"] == "F" )  || ("F" == $dados[5]) ) { ?> selected="selected" <?php } ?> value="F" >Feminino</option>							

				        	</select>
						</td>
						<td><?php if ($erro[5] <> "") { print $erro[5]; } ?></td>
					</tr>
					
					<tr>
						<td>Telefone Fixo<em>*</em></td>
						<td><input type="text" name="txttelefone" value="<?PHP if ($erro[6] == "") { print $usuario["NO_TELEFONE_1"]; } else { print $dados[6]; } ?>" title="Telefone" id="txttelefone" /></td>
						<td><?php if ($erro[6] <> "") { print $erro[6]; } ?></td>
					</tr>										

					<tr>
						<td>Telefone Móvel</td>
						<td><input type="text" name="txttelefone2" id="txttelefone2" title="Telefone2" value="<?PHP if ($erro[7] == "") { print $usuario["NO_TELEFONE_2"]; } else { print $dados[7]; } ?>" /></td>
						<td><?php if ($erro[7] <> "") { print $erro[7]; } ?></td>
					</tr>	


					<tr>
					
						<td colspan="3"><br/>Informações de Login<br/><br/></td>
					
					</tr>
					
					<tr>
						<td>E-mail<em>*</em></td>
						<td><input type="text" name="txtemail" id="txtemail" maxlength="80" title="E-mail" value="<?PHP if ($erro[8] == "") { print $email; } else { print $dados[8]; } ?>" /></td>
						<td><?php if ($erro[8] <> "") { print $erro[8]; } ?></td>
					</tr>					
					

					<tr>
						<td>Repita o E-mail<em>*</em></td>
						<td><input type="text" name="txtemail2" id="txtemail2" maxlength="80" title="Repita o E-mail" value="<?PHP if ($erro[9] <> "") { print $dados[9]; } ?>" /></td>
						<td><?php if ($erro[9] <> "") { print $erro[9]; } ?></td>
					</tr>					


					<tr>
						<td>Senha (6 a 20 Caracteres)<em>*</em></td>
						<td><input type="password" name="txtsenha" id="txtsenha" maxlength="20" title="Senha" value="<?PHP if ($erro[10] == "") { print $dados[10]; } ?>" /></td>
						<td><?php if ($erro[10] <> "") { print $erro[10]; } ?></td>
					</tr>					


					<tr>
						<td>Repita a Senha<em>*</em></td>
						<td><input type="password" name="txtsenha2" id="txtsenha2" maxlength="20" title="Repita a Senha" value="<?PHP if ($erro[11] == "") { print $dados[11]; } ?>" /></td>
						<td><?php if ($erro[11] <> "") { print $erro[11]; } ?></td>
					</tr>					

					<tr>
						<td colspan="3"><br/>Endereço<br/><br/></td>
					
					</tr>
					
					<tr>
						<td>Logradouro<em>*</em></td>
						<td><input type="text" name="txtendereco" value="<?PHP if ($erro[12] == "") { print $usuario["NM_ENDERECO"]; } else { print $dados[12]; } ?>" maxlength="80" title="Endereço" id="txtendereco" /></td>
						<td><?php if ($erro[12] <> "") { print $erro[12]; } ?></td>

					</tr>

					<tr>
						<td>Número<em>*</em></td>
						<td><input type="text" name="txtnumero" value="<?PHP if ($erro[13] == "") { print $usuario["NO_ENDERECO"]; } else { print $dados[13]; } ?>" maxlength="11" title="Número" id="txtnumero" /></td>
						<td><?php if ($erro[13] <> "") { print $erro[13]; } ?></td>
					</tr>

					<tr>
						<td>Complemento</td>
						<td><input type="text" name="txtcomplemento" id="txtcomplemento" maxlength="20" title="Complemento" value="<?PHP if ($erro[14] == "") { print $usuario["NM_COMPLEMENTO"]; } else { print $dados[14]; } ?>" /></td>
						<td><?php if ($erro[14] <> "") { print $erro[14]; } ?></td>
					</tr>

					<tr>
						<td>Bairro<em>*</em></td>
						<td><input type="text" name="txtbairro" value="<?PHP if ($erro[15] == "") { print $usuario["NM_BAIRRO"]; } else { print $dados[15]; } ?>" maxlength="45" title="Bairro" id="txtbairro" /></td>
						<td><?php if ($erro[15] <> "") { print $erro[15]; } ?></td>
					</tr>

					<tr>
						<td>CEP<em>*</em></td>
						<td><input type="text" name="txtcep" id="txtcep" title="CEP" value="<?PHP if ($erro[16] == "") { print $usuario["NO_CEP"]; } else { print $dados[16]; } ?>"/></td>
						<td><?php if ($erro[16] <> "") { print $erro[16]; } ?></td>
					</tr>
					
					<tr>
						<td>Cidade<em>*</em></td>
						<td><input type="text" name="txtcidade" value="<?PHP if ($erro[17] == "") { print $usuario["NM_CIDADE"]; } else { print $dados[17]; } ?>" maxlength="45"  title="Cidade" id="txtcidade" /></td>
						<td><?php if ($erro[17] <> "") { print $erro[17]; } ?></td>
					</tr>
			
					<tr>
						<td>Estado<em>*</em></td>
						<td>
							<select id="txtestado" name="txtestado" title="Estado">
                            	<?php  
                                                       
                                	// Recebe o ResultSet com as Informações dos Estados Brasileiros
                                    $rs = Util::getEstados();
                                                       
                                    while ( $reg = mysql_fetch_array($rs)) { ?>
                                                       
                                   		<option id="ïdEstado" <?php if ( ($usuario["NM_ESTADO"] == $reg["NM_ESTADO"]) || ($reg["ID_ESTADO"] == $dados[18]) ) { ?> selected="selected" <?php } ?>  value="<?php print $reg["ID_ESTADO"]; ?>" ><?php print $reg["NM_ESTADO"]; ?></option>
                                   		
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
						<td><button type="submit" title="Alterar Usuário" class="button"><span><span>Alterar Usuário</span></span></button></td>
					</tr>

				
				</table>
				
				<input type="hidden" id="acao" value="<?php print $acao ?>" name="acao"/>
			
				</form>			
			
			</td>
		
		</tr>
		

	
	</table>


</body>
</html>