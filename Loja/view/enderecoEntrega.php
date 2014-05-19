<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Guaianas Importa&ccedil;&atilde;o e Com&eacute;rcio</title>

<link rel="stylesheet" type="text/css" href="./css/style.css"/>

</head>

<body>

<?php 

session_start();


include_once('../control/controleSessao.php');
include_once('../model/DBConexao.class.php');
include_once('../dao/ProdutoDAO.class.php');
include_once('../dao/UsuarioDAO.class.php');
include_once('../model/Util.class.php');


// Valida Sessão do Usuário
validaSessao();

// Verifica a Quantidade de Itens no Carrinho
foreach ($_SESSION['carrinho'] as $id => $quantidade);
	if ($quantidade == "") { $quantidade = 0; }

$email = $_SESSION['user'];
	
$db = new DBConexao();
$db->conecta();

$usuarioDAO = new UsuarioDAO();

$idUsuario = $usuarioDAO->getIdUsuario($email);

$sql = "SELECT NM_CLIENTE, NM_ENDERECO, NO_ENDERECO, NM_COMPLEMENTO, NM_BAIRRO, NM_CIDADE, NM_ESTADO, NO_CEP FROM tb_usuario WHERE ID_CLIENTE = " . $idUsuario;

$resultSet = mysql_query($sql);

$list = mysql_fetch_array($resultSet);
	
$nomeCliente = $list["NM_CLIENTE"];
$enderecoCliente = $list["NM_ENDERECO"];
$numeroEndereco = $list["NO_ENDERECO"];
$complementoEndereco = $list["NM_COMPLEMENTO"];
$nomeBairro = $list["NM_BAIRRO"];
$nomeCidade = $list["NM_CIDADE"];
$nomeEstado = $list["NM_ESTADO"];
$numCEP = $list["NO_CEP"];



?>
 
<?php include '../include/menu.php'; ?> 

<form name="frmFinalizaPedido" method="post" action="../control/controlePedido.php">
 
<table align="center" border="1">
	<tr>
		<td>
			<h3>Detalhes do Pedido - Checkout</h3>
		</td>
	</tr>
	
	<tr>
		<td>
		
			<table>
				<tr>
					<td></td>
				</tr>
								
				<tr>
					<td>1) Informa&ccedil;&otilde;es de Envio<br><br></td>
				</tr>
				
				<tr>
					<td>
						<?php print $enderecoCliente . " " . $numeroEndereco . " - " . $complementoEndereco . "<br/>" ?>
						<?php print $nomeBairro . " - " . $nomeCidade . " - " . $nomeEstado . "<br/>" ?>
						CEP: <?php print Util::formataCEP($numCEP)  . "<br/><br/>" ?>
									 		  
					</td>
				</tr>
			</table>
		
		</td>
	</tr>
	
	<tr>
		<td>
			<table>
				<tr>
					<td>2) M&eacute;todo de Envio<br><br></td>
				</tr>
				
				<tr>
					<td>

											<form action="./frete.php" method="post" >	
											
												<p>Selecione o M&eacute;todo de Envio Desejado:</p><br/>
												<input type="radio" name="nCdServico" value="40010" checked="checked" /> Sedex<br/>
												<input type="radio" name="nCdServico" value="41106" disabled="disabled"/> PAC<br/>
												
												<br/>
												
												<?php //$pesoTotal = Util::calculoPesoPedido($_SESSION['carrinho']); ?>
												
												Peso Total do Pedido:  <?php print $pesoTotal; ?> Kg(s) <br/>
											
												<br/>
												
												<?php 
												$codServico = "40010";
												$cepOrigem = "22631051";
												$cepDestino = $numCEP;
												$comprimento = "16";
												$altura = "6";
												$largura = "11";
												
												?>
												
												<?php// $frete = (Util::calculaFrete($codServico, $cepOrigem, $cepDestino, $pesoTotal, $comprimento, $altura, $largura)) ?>
												
												Valor Total do Frete: R$ <?php print $frete; ?> 
												
												<?php $frete = str_replace(',','.',$frete); ?>
											</form>

					
					</td>
				</tr>		
			</table>					
				
		
		</td>
	</tr>
	
	<tr>
		<td>
			<table>
				<tr>
					<td>3) Resumo do Pedido<br><br></td>
				</tr>
				
				<tr>
					<td>
					
					
                		<fieldset>
							<table>
	                		
							<?php 
							
							if ($quantidade <> 0) {
							
							?>
	                							
								<thead>
	                								
	                				<tr class="first last">
	                									
	                					<th class="a-center" rowspan="1"><div class="t1"><div class="t2"><span class="nobr">Produto</span></div></div></th>
	                        			<th rowspan="1" class="a-center"><div class="t1"><div class="t2">Quantidade</div></div></th>
	                        			<th class="a-center" colspan="1"><div class="t1"><div class="t2"><span class="nobr">Valor Unit&aacute;rio</span></div></div></th>
	                        			<th class="a-center" colspan="1"><div class="t1"><div class="t2">Subtotal</div></div></th>
	
	                				</tr>
	                								
	                			</thead>
	                						
                									
							<?php 
								foreach ($_SESSION['carrinho'] as $id => $quantidade) {
							
									$query = mysql_query("SELECT ID_PRODUTO, NM_PRODUTO, VL_PRODUTO FROM TB_PRODUTO WHERE ID_PRODUTO =". mysql_real_escape_string((int) $id));
							
										while ($list = mysql_fetch_assoc($query)) {
							
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
                    							<a href="detalheProduto.php?idproduto=<?php print $idProduto; ?>"><?php print $nomeProduto; ?></a>
                							</h2>
                               			</td>

										<td class="a-center"><?php print $quantidade; ?></td>
                						<td class="a-center"><span class="cart-price"><span class="price">R$ <?php print number_format($valorProduto,2,',','.'); ?></span></span></td>


        								<td class="a-center"><span class="cart-price"><span class="price">R$ <?php print number_format($quantidade * $valorProduto,2,',','.'); ?></span></span></td>

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
										<td class="a-center"><strong>Frete</strong></td>
        								<td class="a-center"><span class="cart-price"><span class="price">R$ <?php print str_replace('.',',',$frete); ?></span></span></td>

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
							<?php 
							}
							?>

   							</table>
	                						
   						</fieldset>

						<?php 
						
						
						if ($total == 0) {
						
						?>		
						<tr>
					  		<td colspan="7">Seu carrinho de compras est&aacute; vazio.<br>Clique <a href="./index.php">aqui</a> para continuar comprando.<br><br><br></td>
						</tr>
									  	
						<?php 
							} 
						?>               					
	 					
					</td>
				</tr>
			</table>
		</td>
	</tr>	
	
	<tr>
		<td>
			<table>
				<tr>
					<td></td>
				</tr>
								
				<tr>
					<td>4) Informa&ccedil;&otilde;es de Pagamento<br><br></td>
				</tr>
				
				<tr>
					<td>
					</td>
				</tr>
			</table>		
		</td>
	</tr>
	
	<tr>
		<td>
			<button type="button" title="Voltar" onclick="javascript:window.history.go(-1)"><span><span>Voltar</span></span></button>
			<button type="button" title="Continue" onclick="window.location.href='./index.php'"><span><span>Continuar Comprando</span></span></button>
			<button type="submit" title="Finalizar Compra"><span><span>Finalizar Compra</span></span></button>
		
		</td>
	</tr>
	
</table>

</form>	

</body>
</html>




