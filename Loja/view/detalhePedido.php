<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Guaianas Importa&ccedil;&atilde;o e Com&eacute;rcio</title>

<link rel="stylesheet" type="text/css" href="./css/style.css"/>

</head>

<body class="">

<?php 

session_start();

include_once('../control/controleSessao.php');
include_once('../model/DBConexao.class.php');
include_once('../dao/PedidoDAO.class.php');

// Inicializa Conexão com a Base de Dados
$db = new DBConexao();
$db->conecta();

//
validaSessao();

//
$idPedido = $_GET["idPedido"];

//
$pedidoDAO = new PedidoDAO();

//
$detalhesPedido = $pedidoDAO->getDetalhesPedido($idPedido);

//
$infoPedido = $pedidoDAO->getInfoPedido($idPedido);

?>
 

<div class="wrapper">
	<div class="page">
	
		<div class="header-container">
			<div class="header">
		

			</div>
		</div>

       	<div class="body_wrapper">
			<div class="main-container col1-layout">
           		
           		<div class="main">
           		
           			<div class="col-main">		
						<div class="content_wrapper">

							<div class="page-title">
								<h1>Detalhe do Seu Pedido</h1>
                            </div>
                            
                            <p>Abaixo segue o detalhamento de seu pedido de n&uacute;mero: # &eacute;: <strong><?php print $idPedido; ?></strong>.</p>
                            <p>Data da Compra: <strong><?php print $infoPedido["DT_COMPRA"]; ?></strong></p>
                            <br/><br/>
                            
                            
               						<fieldset>

                							<table id="shopping-cart-table" class="data-table cart-table">
	                			

	                							
                								<thead>
	                								
                									<tr class="first last">
	                									
                										<th class="a-center" rowspan="1"><div class="t1"><div class="t2"><span class="nobr">#</span></div></div></th>
                										<th class="a-center" rowspan="1"><div class="t1"><div class="t2"><span class="nobr">Produto</span></div></div></th>
                        								<th class="a-center" rowspan="1"><div class="t1"><div class="t2">Quantidade</div></div></th>
                        								<th class="a-center" colspan="1"><div class="t1"><div class="t2"><span class="nobr">Valor Unit&aacute;rio</span></div></div></th>
                        								<th class="a-center" colspan="1"><div class="t1"><div class="t2">Subtotal</div></div></th>
	
                									</tr>
	                								
                								</thead>
	                						
                 									
	                			
                									
               									<tbody>
               									
               									<?php 

               									while ($list = mysql_fetch_assoc($detalhesPedido)) {
               									
													$idProduto = $list["ID_PRODUTO"];
               										$rowNun = $list["ROWNUM"];
               										$nomeProduto = $list["NM_PRODUTO"];
               										$quantidade = $list["QTD_PRODUTO"];
               										$valorProduto = $list["VL_PRODUTO"]/100;
               										$valorTotalProduto = $list["VL_TOTAL_PRODUTO"]/100;

               										$total += $valorTotalProduto;
               										
               										
               									?>
                                   					<tr>    

														<td class="a-center"><span class="price"><?php print $rowNun; ?></span></td>

   														<td class="a-center">
     														<h2 class="product-name">
                   												<a href="./detalheProduto.php?idProduto=<?php print $idProduto; ?>"><?php print $nomeProduto; ?></a>
               												</h2>
                                               			</td>

														<td class="a-center"><?php print $quantidade; ?></td>
               											<td class="a-center"><span class="cart-price"><span class="price">R$ <?php print number_format($valorProduto,2,',','.'); ?></span></span></td>

       													<td class="a-center"><span class="cart-price"><span class="price">R$ <?php print number_format($valorTotalProduto,2,',','.'); ?></span></span></td>

													</tr>
												
												<?php } ?>
												
												</tbody>

               									<tbody>

                                   					<tr class="teste">    

   														<td class="a-center"></td>

														<td class="a-center"></td>
                										<td class="a-center"></td>

														<td class="a-center"><strong>Frete</strong></td>


        												<td class="a-center"><span class="cart-price"><span class="price">R$ <?php print number_format($infoPedido["VL_FRETE"]/100,2,',','.'); ?></span></span></td>

													</tr>
														
												</tbody>

               									<tbody>

                                   					<tr class="teste">    

   														<td class="a-center"></td>

														<td class="a-center"></td>
                										<td class="a-center"></td>

														<td class="a-center"><strong>Total</strong></td>


        												<td class="a-center"><span class="cart-price"><span class="price">R$ <?php print number_format($total+$infoPedido["VL_FRETE"]/100,2,',','.'); ?></span></span></td>

													</tr>
														
												</tbody>						


	               							</table>
	               						</fieldset>
                            
                            
           				</div>
           				
           				
           			</div>


           		</div>

				<br/>

           		<div class="buttons-set">
                	<a href="javascript:history.back();" target="_self"" class="f-left">Voltar</a>
                </div>

           		
            </div>   
            
        </div>
		
	</div>
</div>

</body>
</html>