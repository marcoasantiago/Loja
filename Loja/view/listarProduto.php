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
include_once('../model/DBConexao.class.php');
include_once('../dao/UsuarioDAO.class.php');

validaSessao();

$email = $_SESSION["user"];

$db = new DBConexao();
$db->conecta();



?>

		<?php include '../include/menu.php'; ?>

	<table border="1" align="center">
	
		<tr>
		
			<td>
			
				<form action="../control/controleUsuario.php" method="post">
			
				<table>
					<tr>
					
						<td colspan="3" rowspan="1">Foram Encontrado <b>X</b> Produtos na sua Busca por "XPTO"</td>
					
					</tr>
					
					<tr>
					
						<table border="1" align="center">
							<tr>
								<td width="100px" height="100px">
									<a href="./detalheProduto.php?idProduto=1"><img src="../imagens/body_rosa.jpg" width="100px" height="100px"></img></a>
								</td>
								
								<td>
									<table>
										<tr>
											<td>Body Rosa</td>
											<td>[Tamanho M]</td>
										</tr>
										<tr>
											<td>Nunca Usado</td>
										</tr>
										<tr>
											<td>R$ 20,00</td>
										</tr>
									</table>
								
								</td>
							</tr>
						</table>
						
					
					</tr>



				
				</table>
				
				<input type="hidden" id="acao" value="<?php print $acao ?>" name="acao"/>
			
				</form>			
			
			</td>
		
		</tr>
		

	
	</table>

</body>
</html>    	