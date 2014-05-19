<?php

class ProdutoDAO {

	private $sql;
	private $rs;
	private $reg;

	
	public function getCategorias() {
		
		$sql = "SELECT ID_CATEGORIA_PRODUTO, NM_CATEGORIA_PRODUTO FROM tb_categoria_produto";
		
		$rs = mysql_query($sql) or die (mysql_error());
		
		return $rs;
		
	}	

	public function getGeneros() {
		
		$sql = "SELECT ID_GENERO_PRODUTO, NM_GENERO_PRODUTO FROM tb_genero_produto";
		
		$rs = mysql_query($sql) or die (mysql_error());
		
		return $rs;
		
	}		

	public function getProdutos($textoBusca,$inicio,$indice) {
		
		$sql = "SELECT ID_PRODUTO, NM_PRODUTO, DS_PRODUTO, VL_PRODUTO, DS_ESTADO_PRODUTO, NM_FAIXA_ETARIA ";

		$sql = $sql . "FROM tb_produto P LEFT OUTER JOIN (tb_faixa_etaria FE) ON (P.ID_FAIXA_ETARIA = FE.ID_FAIXA_ETARIA), tb_estado_produto EP ";
		
		$sql = $sql . "WHERE (NM_PRODUTO LIKE '%". $textoBusca ."%' OR DS_PRODUTO LIKE '%". $textoBusca . "%') AND P.ID_ESTADO_PRODUTO = EP.ID_ESTADO_PRODUTO";
		
		if ( ($inicio <> 0) && ($indice) ) {
			
			$sql = $sql . " LIMIT " . $inicio . "," . $indice;
			
		}

//		print "SQL: ". $sql . "<br>";
		
		$rs = mysql_query($sql) or die (mysql_error());
			
		return $rs;		
		
	}	

	public function getProdutosCategoria($idCategoria,$inicio,$indice) {
		
		$sql = "SELECT ID_PRODUTO, NM_PRODUTO, DS_PRODUTO, VL_PRODUTO, DS_ESTADO_PRODUTO, NM_FAIXA_ETARIA ";
		
		$sql = $sql . "FROM tb_produto P LEFT OUTER JOIN (tb_faixa_etaria FE) ON (P.ID_FAIXA_ETARIA = FE.ID_FAIXA_ETARIA), tb_estado_produto EP ";

		$sql = $sql . "WHERE P.ID_CATEGORIA_PRODUTO = " . $idCategoria ." AND P.ID_ESTADO_PRODUTO = EP.ID_ESTADO_PRODUTO ";
		
		$sql = $sql . " ORDER BY ID_PRODUTO ASC LIMIT " . $inicio . "," . $indice;
		
//		print "SQL: ". $sql ."<br>";
		
		$rs = mysql_query($sql) or die (mysql_error());
			
		return $rs;		
		
	}

	public function getInfoProduto($idProduto) {
		
		$sql = "SELECT P.ID_PRODUTO, P.NM_PRODUTO, P.DS_PRODUTO, P.NM_MARCA, CP.NM_CATEGORIA_PRODUTO, IFNULL(SP.NM_SUBCATEGORIA_PRODUTO,'Sem Sub-Categoria') NM_SUBCATEGORIA_PRODUTO, GP.NM_GENERO_PRODUTO, FE.NM_FAIXA_ETARIA, P.LARGURA, P.COMPRIMENTO, ";
		
		$sql = $sql . "P.ALTURA, P.PESO, ID_FORMA_ENTREGA, ID_TIPO_VENDA, P.VL_PRODUTO, P.VL_PRODUTO_ORIGINAL, ID_STATUS_PUBLICADO, ID_STATUS_VENDA, P.ID_USUARIO ";
		
		$sql = $sql . "FROM tb_produto P LEFT OUTER JOIN (tb_subcategoria_produto SP) ON (P.ID_SUBCATEGORIA_PRODUTO = SP.ID_SUBCATEGORIA_PRODUTO), ";

		$sql = $sql . "tb_categoria_produto CP, tb_genero_produto GP, tb_faixa_etaria FE ";
		
		$sql = $sql . "WHERE ID_PRODUTO = ". $idProduto ." AND P.ID_CATEGORIA_PRODUTO = CP.ID_CATEGORIA_PRODUTO AND P.ID_GENERO_PRODUTO = GP.ID_GENERO_PRODUTO AND P.ID_FAIXA_ETARIA = FE.ID_FAIXA_ETARIA";

//		print "SQL: ". $sql ."<br>";
		
		$rs = mysql_query($sql) or die (mysql_error());
			
		return $rs;		
		
	}	
	
}