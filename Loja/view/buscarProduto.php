<html>
<body>

<?php 
session_start();

include_once('../model/DBConexao.class.php');
include_once('../dao/ProdutoDAO.class.php');



$textoBusca = $_POST["txtbusca"];

$dbConexao = new DBConexao();
$dbConexao->conecta();


$produtoDAO = new ProdutoDAO();

?>
<?php include "../include/menu.php"; ?>

				<table align="center">

					
					<?php

					if ($textoBusca <> "") {
					
					?>

					<tr>
					
						<table border="1" align="center">
						<?php
						
						$rs = $produtoDAO->getProdutos($textoBusca,0,0);


						$qtdeLinhaRetornadas = mysql_num_rows($rs);

						if ($qtdeLinhaRetornadas == 0) {

						?>
							<tr>
								<td colspan="3" rowspan="1">Sua Busca Não Encontrou Nenhum Resultado</td>
							
							</tr>					
						
						<?php 
							
						}
						
						while ($reg = mysql_fetch_assoc($rs)) {
						
						?>

							<tr>
								<td colspan="3" rowspan="1">Foi(ram) Encontrado(s) <b><?php print $qtdeLinhaRetornadas; ?></b> Produto(s) na sua Busca por "<?php print $textoBusca; ?>"</td>
							
							</tr>					


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
						
					
					</tr>
					
					<?php 
					} else {
						
					?>
					<tr>
						<td><?php print "Sua Busca Não Encontrou Nenhum Resultado";?></td>
					</tr>

					<?php 
					}
					?>


				
				</table>	
	


</body>
</html>	
