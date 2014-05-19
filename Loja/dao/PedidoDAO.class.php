<?php

class PedidoDAO {

	private $sql;
	private $query;
	private $result; 

	public function getDetalhesPedido($idPedido) {
		
		$sql = "SELECT @rownum:=@rownum+1 AS ROWNUM, DP.ID_PEDIDO, P.ID_PRODUTO, P.NM_PRODUTO, P.VL_PRODUTO, DP.NUM_DETALHE_PEDIDO, DP.QTD_PRODUTO, DP.VL_TOTAL_PRODUTO, DATE_FORMAT(PD.DT_COMPRA,'%d/%m/%Y') DT_COMPRA ";

		$sql = $sql . "FROM tb_detalhe_pedido DP, tb_produto P, (SELECT @rownum:=0) R, tb_pedido PD ";

		$sql = $sql . "WHERE DP.ID_PRODUTO = P.ID_PRODUTO AND DP.ID_PEDIDO = PD.ID_PEDIDO AND DP.ID_PEDIDO = " . $idPedido;
		
		//print "SQL: ". $sql ."<br>";
		
		$rs = mysql_query($sql) or die (mysql_error());
			
		return $rs;		
	}	
	
	public function getIdCliente($idPedido) {
		
		$sql = "SELECT P.ID_CLIENTE, C.NM_EMAIL FROM tb_usuario C, tb_pedido P WHERE P.ID_CLIENTE = C.ID_CLIENTE AND P.ID_PEDIDO = " . $idPedido;

		//print "SQL: ". $sql ."<br>";
		
		$rs = mysql_query($sql)or die (mysql_error());
			
		$reg = mysql_fetch_assoc($rs);
		
		return $reg;	
	}

	public function getValorPedido($idPedido) {
		
		$sql = "SELECT VL_PEDIDO FROM tb_pedido WHERE ID_PEDIDO = " . $idPedido;

		//print "SQL: ". $sql ."<br>";
		
		$rs = mysql_query($sql)or die (mysql_error());
			
		$reg = mysql_fetch_assoc($rs);
		
		return $reg["VL_PEDIDO"];	
	}

	public function getTotalPedidos($email) {
		
		$sql = "SELECT COUNT(*) TOTAL FROM tb_pedido P, tb_usuario C ";

		$sql = $sql . "WHERE P.ID_CLIENTE = C.ID_CLIENTE AND C.NM_EMAIL = '" . $email . "'";

		//print "SQL: ". $sql ."<br>";
		
		$rs = mysql_query($sql)or die (mysql_error());
		
		$reg = mysql_fetch_assoc($rs);
		
		return $reg["TOTAL"];
	}	
	
	public function getInfoPedido($idPedido) {

		$sql = "SELECT P.ID_PEDIDO, P.VL_PEDIDO, P.VL_FRETE, DATE_FORMAT(P.DT_COMPRA,'%d/%m/%Y') DT_COMPRA, DATE_FORMAT(P.DT_COMPRA,'%H:%i:%S') HH_COMPRA ";

		$sql = $sql . "FROM tb_pedido P ";
		
		$sql = $sql . "WHERE P.ID_PEDIDO = ". $idPedido;
		
		$rs = mysql_query($sql)or die (mysql_error());

		$reg = mysql_fetch_assoc($rs);
		
		return $reg;
		
	}	
	
	public function getInfoPedidos($email,$inicio,$indice) {
		
		$sql = "SELECT P.ID_PEDIDO, P.VL_PEDIDO, DATE_FORMAT(P.DT_COMPRA,'%e/%m/%Y') DT_COMPRA FROM tb_pedido P, tb_usuario C ";

		$sql = $sql . "WHERE P.ID_CLIENTE = C.ID_CLIENTE AND C.NM_EMAIL = '" . $email . "' ORDER BY P.ID_PEDIDO DESC LIMIT " . $inicio . "," . $indice;
		
		//print "SQL: ". $sql ."<br>";
		
		$rs = mysql_query($sql)or die (mysql_error());
		
		return $rs;		
	}	
	
	
}
?>