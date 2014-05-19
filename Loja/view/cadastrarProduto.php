<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>

<script type="text/javascript" src="../../js/jquery-1.11.0.min.js"></script>

<script language="javascript">

function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';

    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}
</script>


<body>

<?php 

session_start();

include_once('../model/DBConexao.class.php');
include_once('../model/Util.class.php');
include_once('../control/controleSessao.php');
include_once('../dao/ProdutoDAO.class.php');

validaSessao();

$dbConexao = new DBConexao();
$dbConexao->conecta();



// 1 - Cadastrar Novo Produto
// 2 - Alterar Produto
// 3 - Excluir Produto
$acao = 1;

// Resgatando as Informações de Erro na Validação do Login
$erro = explode(',', $_GET[erro]);
$dados = explode(',', $_GET[dados]);

$produtoDAO = new ProdutoDAO();

?>

<?php include '../include/menu.php'; ?>

	<table border="1" align="center">
	
		<tr>
		
			<td>
			
				<form action="../control/controleUsuario.php" method="post">
			
				<table>
					<tr>
					
						<td colspan="3" rowspan="1">Cadastrar Novo Produto</td>
					
					</tr>
					
					<tr>
					
						<td colspan="3">
							<br/>Detalhes do Produto<br/>
							
								<?php if ($_GET[sucesso] != "") { ?> <b><br/> <?php print urldecode($_GET[sucesso]); ?> </b><br/> <?php } ?>
								<?php if ($_GET[erro] != "") { ?>  <b><br/> <?php print urldecode($erro[0]); ?> </b><br/> <?php } ?>
						
							<br/>
						</td>
					
					</tr>
				
					<tr>
						<td><label>Nome do Produto</label><em>*</em></td>
						<td><input type="text" id="txtnome" maxlength="80" name="txtnome" value="" title="Nome Completo"/></td>
						<td><?php if ($erro[1] <> "") { print $erro[1]; } ?></td>
					</tr>
					
					<tr>
						<td><label>Descrição do Produto</label></td>
						<td><textarea rows="5" cols="40" id="txtdescricao" maxlength="20" name="txtdescricao"></textarea></td>
						<td><?php if ($erro[2] <> "") { print $erro[2]; } ?></td>
					</tr>
													
					<tr>
						<td><label>Marca do Produto</label><em>*</em></td>
						<td><input type="text" name="txtcpf" id="txtcpf" title="CPF" value="<?PHP if ($erro[3] == "") { print $usuario["NO_CPF"]; } else { print $dados[3]; } ?>" /></td>
						<td><?php if ($erro[3] <> "") { print $erro[3]; } ?></td>
					</tr>
					
					<tr>
						<td><label>Categoria do Produto</label><em>*</em></td>
						<td>
							<select id="idcategoria" name="idcategoria" title="Categoria Produto">
								<option value="" >Selecione uma Opção</option>
                            	<?php  
                                                       
                                	// Recebe o ResultSet com as Informações das Categorias de Produtos Cadastradas
                                    $rs = $produtoDAO->getCategorias();
                                                       
                                    while ( $reg = mysql_fetch_array($rs)) { ?>
                                                       
                                    	<option id="ïdEstado" <?php if ($reg["ID_CATEGORIA_PRODUTO"] == $dados[4]) { ?> selected="selected" <?php } ?>  value="<?php print $reg["ID_CATEGORIA_PRODUTO"]; ?>" ><?php print $reg["NM_CATEGORIA_PRODUTO"]; ?></option>
                                                       
                                    <?php } ?>
							</select>
						</td>
						<td><?php if ($erro[4] <> "") { print $erro[4]; } ?></td>
					</tr>
					
					<tr>
						<td>Sub-Categoria do Produto<em>*</em></td>
						<td>
							<select name="idsubcategoria" id="idsubcategoria" title="Sub-Categoria do Produto">
							
								<option value=" " >Selecione uma Opção</option>

				        	</select>
						</td>
						<td><?php if ($erro[5] <> "") { print $erro[5]; } ?></td>
					</tr>
					
					<tr>
						<td>Genero do Produto<em>*</em></td>
						<td>
							<select id="idcategoria" name="idcategoria" title="Categoria Produto">
								<option value="" >Selecione uma Opção</option>
                            	<?php  
                                                       
                                	// Recebe o ResultSet com as Informações das Categorias de Produtos Cadastradas
                                    $rs = $produtoDAO->getGeneros();
                                                       
                                    while ( $reg = mysql_fetch_array($rs)) { ?>
                                                       
                                    	<option id="ïdEstado" <?php if ($reg["ID_GENERO_PRODUTO"] == $dados[4]) { ?> selected="selected" <?php } ?>  value="<?php print $reg["ID_GENERO_PRODUTO"]; ?>" ><?php print $reg["NM_GENERO_PRODUTO"]; ?></option>
                                                       
                                    <?php } ?>
							</select>						
						</td>
						<td><?php if ($erro[6] <> "") { print $erro[6]; } ?></td>
					</tr>										

					<tr>
						<td>Faixa Etária</td>
						<td>
							<select name="idsubcategoria" id="idsubcategoria" title="Sub-Categoria do Produto">
							
								<option value=" " >Selecione uma Opção</option>

				        	</select>
						</td>
						<td><?php if ($erro[7] <> "") { print $erro[7]; } ?></td>
					</tr>	
					
					<tr>
						<td>Tipo de Venda<em>*</em></td>
						<td></td>
						<td><?php if ($erro[8] <> "") { print $erro[8]; } ?></td>
					</tr>					
					

					<tr>
						<td>Valor do Produto<em>*</em></td>
						<td><input type="text" name="txtemail2" id="txtemail2" maxlength="80" title="Repita o E-mail" value="<?PHP if ($erro[9] <> "") { print $dados[9]; } ?>" onKeyPress="return(MascaraMoeda(this,'.',',',event))" /></td>
						<td><?php if ($erro[9] <> "") { print $erro[9]; } ?></td>
					</tr>						

					<tr>
						<td>Valor do Produto Original<em>*</em></td>
						<td><input type="text" name="txtemail2" id="txtemail2" maxlength="80" title="Repita o E-mail" value="<?PHP if ($erro[9] <> "") { print $dados[9]; } ?>" onKeyPress="return(MascaraMoeda(this,'.',',',event))" /></td>
						<td><?php if ($erro[9] <> "") { print $erro[9]; } ?></td>
					</tr>
					
					<tr>
					
						<td colspan="3"><br/>Imagens<br/><br/></td>
					
					</tr>
					
				


					<tr>
						<td colspan="3"><br/>Informações para Envio<br/><br/></td>
					
					</tr>
					
					<tr>
						<td>Dimensoões do Produto<em>*</em></td>
						<td>
							<table>
								<tr>
									<td>Altura</td>
									<td><input type="text" name="txtendereco" value="<?PHP if ($erro[12] == "") { print $usuario["NM_ENDERECO"]; } else { print $dados[12]; } ?>" maxlength="80" title="Endereço" id="txtendereco" /></td></td>
								</tr>
								<tr>
									<td>Comprimento</td>
									<td><input type="text" name="txtendereco" value="<?PHP if ($erro[12] == "") { print $usuario["NM_ENDERECO"]; } else { print $dados[12]; } ?>" maxlength="80" title="Endereço" id="txtendereco" /></td></td>
								</tr>
								<tr>
									<td>Largura</td>
									<td><input type="text" name="txtendereco" value="<?PHP if ($erro[12] == "") { print $usuario["NM_ENDERECO"]; } else { print $dados[12]; } ?>" maxlength="80" title="Endereço" id="txtendereco" /></td></td>
								</tr>
							</table>
						</td>
						<td><?php if ($erro[12] <> "") { print $erro[12]; } ?></td>

					</tr>

					<tr>
						<td>Peso do Produto<em>*</em></td>
						<td><input type="text" name="txtnumero" value="<?PHP if ($erro[13] == "") { print $usuario["NO_ENDERECO"]; } else { print $dados[13]; } ?>" maxlength="11" title="Número" id="txtnumero" /></td>
						<td><?php if ($erro[13] <> "") { print $erro[13]; } ?></td>
					</tr>

					<tr>
						<td>Forma de Envio</td>
						<td>
							<input type="checkbox" name="tipoenvio" value="1">Correios<br>
							<input type="checkbox" name="tipoenvio" value="2">Retirar Pessoalmente 
						</td>
						<td><?php if ($erro[14] <> "") { print $erro[14]; } ?></td>
					</tr>


					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
			

					<tr>
						<td><button type="submit" title="Alterar Usuário" class="button"><span><span>Alterar Usuário</span></span></button></td>
					</tr>

				
				</table>
				
				<input type="hidden" id="acao" value="<?php print $acao ?>" name="acao"/>
			
				</form>			
			
			</td>
		
		</tr>
		

	
	</table>


</body>
</html>