<?php 

session_start();

// Resgatando as Informações de Erro na Validação do Login
$erro = explode(',', $_GET[erro]);
$dados = explode(',', $_GET[dados]);

?>

<form method="post" action="../control/controleLogin.php">
	<table border="1" align="center">
	
		
		<tr> 
			<td>
				Usuário:
			</td>
		
			<td>
				<input type="text" name="txtemail" maxlength="80" value="<?PHP print $dados[0]; ?>" id="txtemail" title="E-mail" />
			</td>	
			<td><?php if ($erro[0] <> "") { print $erro[0]; } ?></td>			
				
		</tr>
	
		<tr> 
			<td>
				Senha:
			</td>
		
			<td>
				<input type="password" name="txtsenha" maxlength="20" id="txtsenha" title="Senha" />
			</td>		
	

			<td><?php if ($erro[1] <> "") { print $erro[1]; } ?></td>			
		</tr>
		
		<tr>
			<td colspan="3" align="center">
				<button type="submit" title="Cadastrar Cliente" class="button">Login</button>
				<a href="./esqueceuSenha.php"><small></small>Esqueçeu Senha</a>
			</td>
		</tr>		
	
	</table>
</form>