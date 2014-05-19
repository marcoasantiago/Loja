	<table border="1" align="center">
	
		
		<tr> 
			<td valign="top">
				<table border="1">
					<tr>
						<td><b>Login</b></td>
					</tr>
					
					<tr>
						<td><a href="login.php">Login</a></td>
					</tr>
					<tr>
						<td><a href="logout.php">Logout</a></td>
					</tr>
				
				</table>
			</td>
		
			<td valign="top">
				<table border="1">
					<tr>
						<td><b>Clientes</b></td>
					</tr>
					
					<tr>
						<td><a href="cadastrarUsuario.php">Cadastro</a></td>
					</tr>
					<tr>
						<td><a href="alterarCadastro.php">Alteraçã de Dados Cadastrais</a></td>
					</tr>
					<tr>
						<td><a href="alterarEndereco.php">Alteraçã de Endereço</a></td>
					</tr>
					<tr>
						<td><a href="alterarEmail.php">Alteraçã de E-mail</a></td>
					</tr>
					<tr>
						<td><a href="alterarSenha.php">Alteraçã de Senha</a></td>
					</tr>
					<tr>
						<td><a href="esqueceuSenha.php">Esqueçi Minha Senha</a></td>
					</tr>
					
					
					
				
				</table>

			</td>
			
			<td valign="top">
				<table border="1">
					<tr>
						<td><b>Produtos</b></td>
					</tr>
					<tr>
						<td><a href="listarProduto.php">Lista de Produtos</a></td>
					</tr>					
					<tr>
						<td><a href="cadastrarProduto.php">Cadastrar</a></td>
					</tr>
					<tr>
						<td><a href="alterarProduto.php">Alterar</a></td>
					</tr>
					<tr>
						<td><a href="excluirProduto.php">Excluir</a></td>
					</tr>
				
				</table>			
			</td>
	
			<td valign="top">
				<table border="1">
					<tr>
						<td><b>Busca</b></td>
					</tr>
					<tr>
						<td><a href="buscarProduto.php">Busca de Produtos</a></td>
					</tr>					

				
				</table>			
			</td>	

			<td valign="top">
				<table border="1">
					<tr>
						<td><b>Categorias</b></td>
					</tr>
					
					<?php 
			
					$sql = "SELECT ID_CATEGORIA_PRODUTO, NM_CATEGORIA_PRODUTO FROM tb_categoria_produto ORDER BY NO_PRIORIDADE";
		
					$rs = mysql_query($sql) or die (mysql_error());
		
					while ($reg = mysql_fetch_assoc($rs)) {
		
					?>
					
					<tr>
						<td><a href="./produto.php?idCategoria=<?php print utf8_decode($reg["ID_CATEGORIA_PRODUTO"]); ?>"><?php print $reg["NM_CATEGORIA_PRODUTO"]; ?></a></td>
					</tr>
					
					<?php 
					}
					
					?>

				
				</table>			
			</td>	
			
			<td valign="top">
				<table border="1">
					<tr>
						<td><b>Pedidos</b></td>
					</tr>
					<tr>
						<td><a href="ultimosPedidos.php">Últimos Pedidos</a></td>
					</tr>					
					<tr>
						<td><a href="pedidos.php">Todos Pedidos</a></td>
					</tr>	
				
				</table>			
			</td>			
							
			<td valign="top">
				<table border="1">
					<tr>
						<td><b>Carrinho de Compras</b></td>
					</tr>
					<tr>
						<td><a href="carrinho.php">Visualizar</a></td>
					</tr>					

				
				</table>			
			</td>
			
			<td valign="top">
				<table border="1">
					<tr>
						<td><b>Mapa do Site</b></td>
					</tr>
					
					<tr>
						<td>Como Funciona</td>
					</tr>

					<tr>
						<td>Contato</td>
					</tr>
				
					<tr>
						<td>Depoimentos</td>
					</tr>

					<tr>
						<td>FAQ - Dúvidas Frequentes</td>
					</tr>

					<tr>
						<td>Parceiros</td>
					</tr>
				
				</table>			
			</td>				
									
		</tr>
	
	</table>
	
	<form name="buscar" method="post" action="./buscarProduto.php">
		<table align="center">
			<tr>
				<td rowspan="8"><input type="text" size="100" name="txtbusca" /></td>
				<td><button>Buscar</button></td>
			</tr>
		</table>
	</form>	
