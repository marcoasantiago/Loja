<html>
<body>


<?php 
session_start();

include_once('../model/DBConexao.class.php');
include_once('../dao/ProdutoDAO.class.php');

$dbConexao = new DBConexao();
$dbConexao->conecta();

$idCategoria = $_GET["idCategoria"];

$produtoDAO = new ProdutoDAO();

$arrayProdutos = $produtoDAO->getProdutosCategoria($idCategoria,0,5);

$qtdeLinhaRetornadas = mysql_num_rows($arrayProdutos);

?>

	<?php include '../include/menu.php'; ?>

	<table border="1" align="center">
		<tr>
			<td>
			
			

				<table border="1" align="center">
				
				<?php
						

				if ($qtdeLinhaRetornadas == 0) {

				?>
					<tr>
						<td colspan="3" rowspan="1">Não Existe Produtos Cadastrados para Esta Categoria.</td>
						
					</tr>					
						
				<?php 
							
				}
						
				while ($reg = mysql_fetch_assoc($arrayProdutos)) {
						
						?>

					


							<tr>
								<td width="100px" height="100px">
									<a href="./detalheProduto.php?idProduto=<?php print $reg["ID_PRODUTO"]; ?>"><img src="../imagens/body_rosa.jpg" width="100px" height="100px"></img></a>
								</td>
								
								<td>
									<table>
										<tr>
											<td><?php print $reg["NM_PRODUTO"]; ?></td>
											<td>Tamanho: [<?php print $reg["NM_FAIXA_ETARIA"] ?>]</td>
										</tr>
										<tr>
											<td><?php print $reg["DS_ESTADO_PRODUTO"]; ?></td>
										</tr>
										<tr>
											<td>R$ <?php print number_format($reg["VL_PRODUTO"]/100,2,',','.'); ?></td>
										</tr>
									</table>
								
								</td>
							</tr>
							
						<?php 
						}
						?>
						</table>
			
				
			
			
			</td>
		</tr>
	</table>


</body>
</html>


