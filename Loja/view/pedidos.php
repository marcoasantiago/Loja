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
include_once('../dao/PedidoDAO.class.php');
include_once('../model/DBConexao.class.php');

validaSessao();

$email = $_SESSION["user"];

$db = new DBConexao();
$db->conecta();

// Paginação - Demonstrar apenas 5 Pedidos por Página

if($_GET["indice"] == "") {
	$indice = 0;
} else {
	$indice = $_GET["indice"]-1;
}

$indice = $indice * 5;

// Instancia o Objeto de Queries para Pedidos
$pedidoDAO = new PedidoDAO();
$arrayPedidos = $pedidoDAO->getInfoPedidos($email,($indice),5);

$numPedidos = mysql_num_rows($arrayPedidos);

// Busca o Número Total de Pedidos do Cliente
$totalPedidos = $pedidoDAO->getTotalPedidos($email);

// Lista o Número Total de Páginas da Busca
$totalPaginas = ceil($totalPedidos/5);

?>

<?php include '../include/menu.php'; ?>


<div class="wrapper">
	<div class="page">



		<div class="body_wrapper">

			<div class="main-container col2-left-layout">

		    	<div class="main">  
	
					<div class="col-main">			
						<div class="new_prod_title">
	    					<h2>Hist&oacute;rico de Pedidos</h2>
	    				</div>
	    				
	    				<div class="new_prod_list">
	        				<ul class="products-grid-new">
	    						<div align="center">
	    						
	    							<fieldset>
		
										<table border="0" width="100%" align="left">
					    					<tr>
					    						<td align="left" colspan="5"><h2><strong>Informa&ccedil;&otilde;es do Pedido</strong></h2></td>
					    					</tr>
					    					<tr>
					    						<td colspan="5"><strong>Confira detalhes sobre a entrega do seu pedido e hist&oacute;rico de suas compras:</strong></td>
					    					</tr>	
					    					<tr>
					    						<td colspan="5">Foram listados os &uacute;ltimos <strong><?php print $totalPedidos; ?> Pedido(s)</strong>. Dividida(s) em <strong><?php print $totalPaginas; ?></strong> p&aacute;gina(s).</td>
					    					</tr>	
					    					<tr>
					    						<td colspan="5">Clique em <strong>"N&ordm; do Pedido"</strong> para ver o detalhamento de sua(s) compra(s)</td>
					    					</tr>
		    							</table>
		    							
									</fieldset>
	
									<br/>
									
									<fieldset>
		
			                			<table id="shopping-cart-table" class="data-table cart-table">
			                			
			                				<thead>
			                								
			                					<tr class="first last">
			                									
			                						<th class="a-center" rowspan="1"><div class="t1"><div class="t2"><span class="nobr">Data do Pedido</span></div></div></th>
			                        				<th rowspan="1" class="a-center"><div class="t1"><div class="t2">N&ordm do Pedido</div></div></th>
			                        				<th class="a-center" colspan="1"><div class="t1"><div class="t2"><span class="nobr">Total (R$)</span></div></div></th>
			                        				<th class="a-center" colspan="1"><div class="t1"><div class="t2">Forma de Pagamento</div></div></th>
													<th class="a-center" colspan="1"><div class="t1"><div class="t2">Status do Pedido</div></div></th>
														
			                					</tr>
			                						
			                				</thead>
		
			                						
		               						<tbody>
		
						    					<?php 
				    					
						    					$contador = 0;
						    					
						    					while ($regPedidos = mysql_fetch_assoc($arrayPedidos)){

												?> 						
		
		
		                       					<tr>    
		
		   											<td class="a-center">
		     											<h2 class="product-name"> <?php print $regPedidos['DT_COMPRA'];  ?></h2>
		                                           	</td>
		
		               								<td class="a-center"><a href="./detalhePedido.php?idPedido=<?php print $regPedidos['ID_PEDIDO']; ?>"><span class="cart-price"><span class="price"><?php print $regPedidos['ID_PEDIDO']; ?></span></span></a></td>
													<td class="a-center"><span class="cart-price"><span class="price">R$ <?php print number_format($regPedidos['VL_PEDIDO']/100,2,',','.');?></span></span></td>
													<td class="a-center"><span class="cart-price"><span class="price"></span></span></td>
													<td class="a-center"><?php ?></td>
		
												</tr>
		
						    					<?php 
						    					
						    						$contador++;
						    					
						    					}

						    					?>
		
			
			
			
											</tbody>
		           						</table>
		               				</fieldset>	
									
						    		<?php 
						    									    					
						    					
						    					for ($i=1; $i<=$totalPaginas; $i++) {
						    						
						    		?>
						    						<a href="./pedidos.php?indice=<?php print $i; ?>"><?php print $i?></a>
						    		<?php 
						    					}

						    		?>
						    		
		               				<br/>
		               				<?php 

										if ($contador == 0) {
													
									?>
												
											<p><strong><font size="2">N&atilde;o existem pedido(s) efetuado(s) at&eacute; o momento.</font></strong></p>
												
									<?php 
										}
												
									?>						    		
						    		
						    		
	    						</div>
							</ul>
						</div>  
					</div>
				</div>				
			</div>

						
		</div>
	</div>
</div>
		
    			
</body>
</html>    	