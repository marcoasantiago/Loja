<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Guaianas Importa&ccedil;&atilde;o e Com&eacute;rcio</title>

<link rel="stylesheet" type="text/css" href="./css/style.css"/>
</head>
<body class="checkout-cart-index">


<?php

session_start();

include_once('../model/DBConexao.class.php');
include_once('../control/controleSessao.php');
include_once('../dao/PedidoDAO.class.php');
include_once('../dao/UsuarioDAO.class.php');
include_once('../model/Util.class.php');


//
$email = $_SESSION["user"];

$idPedido = $_GET["idPedido"];

// Valida Sessão do Usuário
//validaSessao();

//
$db = new DBConexao();
$db->conecta();

//
$pedidoDAO = new PedidoDAO();

//
$usuarioDAO = new UsuarioDAO();

//
$infoPedido = $pedidoDAO->getInfoPedido($idPedido);

//
$infoCliente = $usuarioDAO->getInfoUsuario($email);

// Remove as Informações da Variável de Carrinho de Compra
unset($_SESSION["carrinho"]);


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
                		
               				<div class="cart">
                				
               					<div class="cart-holder"> 
                					<div class="page-title">
                						<h1>Resumo do Seu Pedido </h1>
                					</div>
	                					
	                					<h1 class="sub-title">Obrigado por comprar no FOI DO MEU BEBÊ. Sua compra foi realizada com sucesso!</h1>
	                					<p>Confirma&ccedil;&atilde;o de sua compra foi enviada para o e-mail: <u><?php print $email; ?></u></p> 
	                					
								
								<br/>
								
    							<p>O n&uacute;mero do seu Pedido &eacute; #<?php print $idPedido; ?></p>
    							<p>Pedido realizado no dia <?php print $infoPedido["DT_COMPRA"];  ?> &agrave;s <?php print $infoPedido["HH_COMPRA"]; ?> </p>
    							<p>Voc&ecirc; ir&aacute; receber um e-mail de confirma&ccedil;&atilde;o do seu pedido com os detalhes do pedido e um link para rastrear seu pedido.</p>
								<p>Obrigado pela prefer&ecirc;ncia!</p>
								
								<br/>
	                			

	                			
		                			<div class="col2-set">

	            	
	           								<div class="col-2 registered-users">
	               								<div class="content">
													<h1>Dados da Entrega</h1>
													<br/>
													<p><?php print $infoCliente["NM_CLIENTE"]; ?></p>
													<p><?php print $infoCliente["NM_ENDERECO"]; ?> <?php print $infoCliente["NO_ENDERECO"]; ?> - <?php print $infoCliente["NM_COMPLEMENTO"]; ?></p>
													<p><?php print $infoCliente["NM_BAIRRO"]; ?> - <?php print $infoCliente["NM_CIDADE"]; ?> - <?php print $infoCliente["NM_ESTADO"]; ?></p>
													<p>CEP: <?php print Util::formataCEP($infoCliente["NO_CEP"]); ?></p>
	               								</div>
	               							</div>
	               					</div>


	                			<br/><br/>
		                		
                				<fieldset>

                					<table id="shopping-cart-table" class="data-table cart-table" align="center">
	                			
           								<thead>
	                								
	                						<tr class="first last">
	                									
	                							<th class="a-center" rowspan="1"><div class="t1"><div class="t2"><span class="nobr">Produto</span></div></div></th>
	                        					<th rowspan="1" class="a-center"><div class="t1"><div class="t2">Quantidade</div></div></th>
	                        					<th class="a-center" colspan="1"><div class="t1"><div class="t2"><span class="nobr">Valor Unit&aacute;rio</span></div></div></th>
	                        					<th class="a-center" colspan="1"><div class="t1"><div class="t2">Subtotal</div></div></th>
	
	                						</tr>
	                								
           								</thead>

	                						
                									
<?php 
											$sql = "SELECT P.ID_PRODUTO, P.NM_PRODUTO, P.VL_PRODUTO, PED.VL_FRETE, DP.VL_TOTAL_PRODUTO, DP.QTD_PRODUTO, PED.VL_PEDIDO ";
											$sql = $sql . "FROM tb_pedido PED, tb_detalhe_pedido DP, tb_produto P ";
											$sql = $sql . "WHERE PED.ID_PEDIDO = " . $idPedido . " AND PED.ID_PEDIDO = DP.ID_PEDIDO AND DP.ID_PRODUTO = P.ID_PRODUTO";
													
											$rs = mysql_query($sql);
													
											while ($reg = mysql_fetch_assoc($rs)) {
														
												$idProduto = $reg["ID_PRODUTO"];
												$nomeProduto = $reg["NM_PRODUTO"];
												$quantidade = $reg["QTD_PRODUTO"];
												$valorProduto = ($reg["VL_TOTAL_PRODUTO"]/100) / $quantidade;
												$valorTotalProduto = $reg["VL_TOTAL_PRODUTO"]/100;
												$frete = $reg["VL_FRETE"]/100;
												
												$total += $reg["VL_TOTAL_PRODUTO"]/100;
													
										?>
		                			
                									
										<tbody>
                                   			<tr>    
   												<td class="a-center">
     												<h2 class="product-name">
                   										<a href="./detalheProduto.php?idproduto=<?php print $idProduto; ?>"><?php print $nomeProduto; ?></a>
               										</h2>
                                        		</td>

												<td class="a-center"><?php print $quantidade; ?></td>
               									<td class="a-center"><span class="cart-price"><span class="price">R$ <?php print number_format($valorProduto,2,',','.'); ?></span></span></td>



       											<td class="a-center"><span class="cart-price"><span class="price">R$ <?php print number_format($valorTotalProduto,2,',','.'); ?></span></span></td>

											</tr>
										</tbody>

										<?php 
													}
											
										
										?>


										<tbody>

                                    		<tr class="teste">    

    											<td class="a-center"></td>

       											<td class="a-center"></td>

												<td class="a-center"><strong>Frete</strong></td>

        										<td class="a-center"><span class="cart-price"><span class="price">R$ <?php print number_format($frete,2,',','.'); ?></span></span></td>

											</tr>
														
										</tbody>

       									<tbody>

                           					<tr class="teste">    
												<td class="a-center"></td>
												<td class="a-center"></td>
												<td class="a-center"><strong>Total</strong></td>


    											<td class="a-center"><span class="cart-price"><span class="price">R$ <?php print number_format($total+$frete,2,',','.'); ?></span></span></td>

											</tr>
														
										</tbody>						

           							</table>
	               						</fieldset>

								<br/>                				

	                			</div>

                				</div>
                					
                			</div>
                 		</div>
                </div>
                
            </div>        	
        </div>
    </div>
</div>

<a href="./index.php">Página Inicial</a>

<?php

// Limpar Carrinho de Compras
unset($_SESSION["carrinho"]);


?>

</body>
</html>