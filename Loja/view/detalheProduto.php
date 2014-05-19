<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="./css/style.css"/>
<title>Guaianas Importa&ccedil;&atilde;o e Com&eacute;rcio</title>
</head>

<body  class=" catalog-category-view categorypath-laptops-notebooks-html category-laptops-notebooks">


<?php 
session_start();

include_once('../control/controleSessao.php');
include_once('../model/DBConexao.class.php');
include_once('../dao/ProdutoDAO.class.php');
include_once('../dao/UsuarioDAO.class.php');

validaSessao();

$email = $_SESSION["user"];
$idProduto = $_GET["idProduto"];

$db = new DBConexao();
$db->conecta();

$produtoDAO = new ProdutoDAO();
$usuarioDAO = new UsuarioDAO();

$rs = $produtoDAO->getInfoProduto($idProduto);

$reg = mysql_fetch_array($rs);

$idUsuario = $reg["ID_USUARIO"];
$nomeProduto = $reg["NM_PRODUTO"];
$descricaoProduto = $reg["DS_PRODUTO"];
$marcaProduto = $reg["NM_MARCA"];
$categoriaProduto = $reg["NM_CATEGORIA_PRODUTO"];
$subCategoriaProduto = $reg["NM_SUBCATEGORIA_PRODUTO"];
$generoProduto = $reg["NM_GENERO_PRODUTO"];
$faixaEtaria = $reg["NM_FAIXA_ETARIA"];
$valorProduto = $reg["VL_PRODUTO"];


$reg = $usuarioDAO->getInfoVendedor($idUsuario);

$nomeVendedor = $reg["NM_CLIENTE"];
$cidade = $reg["NM_CIDADE"];
$estado = $reg["NM_SIGLA"];
// FALTANDO INFORMAÇÕES DE QUALIFICAÇÕES

?>

		<?php include '../include/menu.php'; ?>

	<table border="0" align="center">
	
		<tr>
		
			<td>
			
				<form action="./carrinho.php?incluir=1" method="post">
				<table border="1">
					<tr>
						<td>
							
							
									<table border="1" align="center">
										<tr>
											<td width="100px" height="100px">
												<img src="../imagens/body_rosa.jpg" width="100px" height="100px"/>
											</td>
											
											<td>
												<table>
													<tr>
														<td><?php print $nomeProduto; ?></td>
														
													</tr>
													
													<tr>
														<td><?php print $descricaoProduto; ?></td>
													</tr>
													
													<tr>
														<td>Tamanho: [<?php print $faixaEtaria; ?>]</td>
													</tr>
													
													<tr>
														<td>Marca: <?php print $marcaProduto; ?></td>
													</tr>
													
													<tr>
														<td>Categoria: <?php print $categoriaProduto; ?></td>
													</tr>
													
													<tr>
														<td>Sub-Categoria: <?php print $subCategoriaProduto; ?></td>
													</tr>
													
													<tr>
														<td><?php print $estadoProduto; ?></td>
													</tr>
													
													<tr>
														<td>Gênero: <?php print $generoProduto; ?></td>
													</tr>
													
													<tr>
														<td>R$ <?php print number_format($valorProduto/100,2,',','.'); ?></td>
													</tr>
												</table>
											
											</td>
										</tr>
									</table>
									
								

						</td>
						
						<td>
							<table border="0">
								<tr>
									<td><b>Informações do Vendedor</b></td>
								</tr>
								<tr>
									<td><?php print $nomeVendedor; ?></td>
								</tr>
								<tr>
									<td><?php print $cidade . " - " . $estado; ?></td>
								</tr>
								<tr>
									<td>Qualificações -> XXXXX</td>
								</tr>															
							</table>

							<table border="0">
								<tr>
									<td><b>Calcular Frete</b></td>
								</tr>
								<tr>
									<td>CEP</td>
									<td><input type="text" name="txtcep"/></td>
								</tr>
								<br/>
								<tr>
									<td>Valor do Frete par o CEP 22775-033</td>
								</tr>
								<tr>
									<td>PAC</td>
								</tr>															
								<tr>
									<td>SEDEX</td>
								</tr>
							</table>
						
						</td>
						
					</tr>
				</table>	

		
			
			</td>
		
		</tr>
		
		<tr>
			<td>
				<button title="Comprar" name="Comprar">Comprar</button> 
			</td>
		</tr>
		<tr>
			<td>
				<a href=".">Facebook</a> - <a href=".">Twitter</a> - <a href=".">Google+</a>
			</td>
		</tr>
		

	
	</table>
	</form>

</body>
</html>    	