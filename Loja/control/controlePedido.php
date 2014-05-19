<?php
session_start();

include_once('../model/DBConexao.class.php');
include_once('../dao/UsuarioDAO.class.php');
include_once('../dao/ProdutoDAO.class.php');
include_once('controleSessao.php');
include_once('../model/Email.class.php');
include_once('../dao/PedidoDAO.class.php');
include_once('../model/Util.class.php');


// Verificar esse ponto do código
//validaSessao();

//
$email = $_SESSION["user"];


//
$db = new DBConexao();
$db->conecta();

$contador = 0;


foreach ($_SESSION['carrinho'] as $id => $quantidade) {

	$query = mysql_query("SELECT ID_PRODUTO, NM_PRODUTO, VL_PRODUTO FROM tb_produto WHERE ID_PRODUTO =". mysql_real_escape_string((int) $id));

	while ($list = mysql_fetch_assoc($query)) {

		$nomeProduto = $list["NM_PRODUTO"];
		$valorProduto = $list["VL_PRODUTO"]/100;
		$subTotal = $quantidade * $valorProduto;
			
		$total += $subTotal;
		
				print "Produto: " . $nomeProduto . "<br/>";

		}
}



$valorFrete = 0;



$sqlPedido = 'INSERT INTO tb_pedido (ID_CLIENTE, VL_PEDIDO, DT_COMPRA, VL_FRETE) ';
$sqlPedido = $sqlPedido . "VALUES (". UsuarioDAO::getIdUsuario($email) .", ". $total*100 . ", '" . date("Y-m-d H:i:s") ."', ". $valorFrete*100 . ")";
print "Aqui";


$rs = mysql_query($sqlPedido) or die (mysql_error());
$result = mysql_affected_rows();



//Busca o Último ID da Transação na Tabela TB_PEDIDOS
$sqlID = "select last_insert_id() ID";
$rs = mysql_query($sqlID);
$reg = mysql_fetch_array($rs);
$idPedido = $reg["ID"];


$total = 0;

foreach ($_SESSION['carrinho'] as $id => $quantidade) {

	$query = mysql_query("SELECT ID_PRODUTO, NM_PRODUTO, VL_PRODUTO FROM tb_produto WHERE ID_PRODUTO =". mysql_real_escape_string((int) $id));
	
	while ($list = mysql_fetch_assoc($query)) {

		$contador += 1;
		
		print "Contador: " . $contador . "<br/>";
		
		$nomeProduto = $list["NM_PRODUTO"];
		$valorProduto = $list["VL_PRODUTO"]/100;
		$idProduto = $list["ID_PRODUTO"];
		$subTotal = $quantidade * $valorProduto;
		
		$sqlDetalhe = 'INSERT INTO tb_detalhe_pedido (ID_PEDIDO, NUM_DETALHE_PEDIDO, ID_PRODUTO, ';
		$sqlDetalhe = $sqlDetalhe . 'QTD_PRODUTO, VL_TOTAL_PRODUTO) VALUES (';
		$sqlDetalhe = $sqlDetalhe . $idPedido . ', ' . $contador . ', ' . $idProduto . ', ' . $quantidade . ',';
		$sqlDetalhe = $sqlDetalhe . $subTotal * 100 . ')';

	}
		
		$rs = mysql_query($sqlDetalhe) or die (mysql_error());
		$result = mysql_affected_rows();

	$total += $subTotal;
}


// Envia o E-mail com a Confirmação do Pedido
//$resultado = Email::enviaEmailConfirmacaoPedido( $email, $idPedido );

//Retorna a Página de Confirmação de Pagamento
header("Location: ../view/confirmacaoPedido.php?idPedido=".$idPedido);



?>