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

include '../model/DBConexao.class.php';
include '../control/controleSessao.php';


// Valida Sess�o do Usu�rio
validaSessao();

$db = new DBConexao();
$db->conecta();

// Atualiza Carrinho de Compras
if(!isset($_SESSION['carrinho'])){
	$_SESSION['carrinho'] = array();
}


if ( isset($_GET['incluir']) ){

	if(!isset($_SESSION['carrinho'][$_GET['incluir']])){
	$_SESSION['carrinho'][$_GET['incluir']] = 1;
	}//else{
//	$_SESSION['carrinho'][$_GET['incluir']] += 1;
//	}	
	
//	print_r(serialize($_SESSION['carrinho']));		

}

// Verificação de Remoção (Quantidade) de Produtos no Carrinho
if ( isset($_GET['excluir']) ){

	$idProduto = $_GET['excluir'];

if(isset($_SESSION['carrinho'][$idProduto])){	
	if ($_SESSION['carrinho'][$idProduto] == 1) {		
		unset($_SESSION['carrinho'][$idProduto]);
				
	} else {

		$_SESSION['carrinho'][$idProduto] --;
	}
}

//	print_r(serialize($_SESSION['carrinho']));	
}
	
// Verifica��o de Remo��o de Produto do Carrinho
if ( isset($_GET['remover'])){

	$idProduto = 	$_GET['remover'];

	if(isset($_SESSION['carrinho'][$idProduto])){
		unset($_SESSION['carrinho'][$idProduto]);	
	}
}

// Verifica a Quantidade de Itens no Carrinho
foreach ($_SESSION['carrinho'] as $id => $quantidade);

if ($quantidade == "") { $quantidade = 0; }


?>

										<form action="./enderecoEntrega.php" method="post">

                							<table id="shopping-cart-table" class="data-table cart-table">
	                			
<?php 

if ($quantidade <> 0) {

?>
	                							
                								<thead>
	                								
                									<tr class="first last">
	                									
                										<th class="a-center" rowspan="1"><div class="t1"><div class="t2"><span class="nobr">Produto</span></div></div></th>
                        								<th class="a-center"rowspan="1" ><div class="t1"><div class="t2">Quantidade</div></div></th>
                        								<th class="a-center" colspan="1"><div class="t1"><div class="t2"><span class="nobr">Valor Unit&aacute;rio</span></div></div></th>
                        								<th class="a-center" rowspan="1"><div class="t1"><div class="t2"></div></div></th>                        
                        								<th class="a-center" colspan="1"><div class="t1"><div class="t2">Subtotal</div></div></th>
	
                									</tr>
	                								
                								</thead>
	                							
	                						

                									
<?php 

	foreach ($_SESSION['carrinho'] as $id => $quantidade) {

		$query = mysql_query("SELECT ID_PRODUTO, NM_PRODUTO, VL_PRODUTO FROM tb_produto WHERE ID_PRODUTO = 1");//. mysql_real_escape_string((int) $id));

			while ($list = @mysql_fetch_assoc($query)) {

			$idProduto = $list["ID_PRODUTO"];
			$nomeProduto = $list["NM_PRODUTO"];
			$valorProduto = $list["VL_PRODUTO"]/100;
			$subTotal = $quantidade * $valorProduto;
			
			$total += $subTotal;

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

														<td class="a-center"><a href="./carrinho.php?remover=<?php print $id; ?>" title="" class="btn-remove btn-remove2">Remove Item</a></td>


       													<td class="a-center"><span class="cart-price"><span class="price">R$ <?php print number_format($subTotal,2,',','.'); ?></span></span></td>

													</tr>
												</tbody>

<?php 
			}
	}

?>
               									<tbody>

                                   					<tr class="teste">    

   														<td class="a-center"></td>

														<td class="a-center"></td>
                										<td class="a-center"></td>

														<td class="a-center"></td>
														<td class="a-center"></td>
														<td class="a-center"><strong>Total</strong></td>


        												<td class="a-center"><span class="cart-price"><span class="price">R$ <?php print number_format($total,2,',','.'); ?></span></span></td>

													</tr>
														
												</tbody>						
<?php 

}
?>

	               							</table>
	               							
	               							
	               							
	               							<?php 


	if ($total <> 0) {

?>
	               							<br/>
	               							
	               							<table id="shopping-cart-table" class="data-table cart-table">
	               							
	               							                								<tfoot>

                   									<tr>

                       									<td colspan="0" class="a-left">
														    <button type="button" title="Voltar a Loja" class="button btn-proceed-checkout btn-checkout" onclick="window.location='./index.php';"><span><span>Voltar a Loja</span></span></button>
														</td>
														<td colspan="50">
														<td colspan="0" class="a-right">
                                                      		<button type="submit" title="Concluir Compra" <?php if ($quantidade == 0) { ?> disabled="disabled" <?php } ?> class="button btn-update"><span><span>Concluir Compra</span></span></button>
                       									</td>

                   									</tr>
                   									
               									</tfoot>
	               							
	               							</table>

<?php 
	} 
?>

	               						</fieldset>

<?php 


	if ($total == 0) {

?>		
										<table>
											<tr>
									  			<td colspan="7">Seu carrinho de compras est&aacute; vazio.<br>Clique <a href="./index.php">aqui</a> para continuar comprando.<br><br><br></td>
									  		</tr>
									  	</table>
			  	
<?php 
	} 
?>               					
	                				</form>



</body>
</html>