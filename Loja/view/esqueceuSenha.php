<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Guaianas Importa&ccedil;&atilde;o e Com&eacute;rcio</title>

<link rel="stylesheet" type="text/css" href="./css/style.css"/>


</head>

<body class="">

<script type="text/javascript">

function action ( nomeFormulario, pagina ) {

	f = document.nomeFormulario;
	f.action = pagina;
	f.submit();
}

</script>

<?php 

session_start();


include_once('../control/controleSessao.php');
include_once('../model/DBConexao.class.php');

// Resgatando as Informações de Erro na Validação do Login
$erro = $_GET[erro];
$dados = $_GET[dados];

$dbConexao = new DBConexao();
$dbConexao->conecta();

?>

	<table border="1" align="center">
	
		<tr>
		
			<td>
			
				<form action="../control/controleSenha.php" method="post">
			
				<table>
					<tr>
					
						<td colspan="3" rowspan="1">Esque&ccedil;eu a Sua Senha <br><br></td>
					
					</tr>
					
					<tr>
					
						<td colspan="3">
								<b>
								<?php if ($_GET[sucesso] != "") { ?> <span> <?php print $_GET[sucesso]; ?> </span><br> <?php } ?>
								<?php if ($_GET[erro] != "") { ?>  <span><?php print $erro; ?></span><br> <?php } ?>
								</b>
						
							<br/>
						</td>
					
					</tr>

					
					<h2 class="legend"></h2>
        							
					<tr>
						<td>
							Recupere a sua senha aqui <br>
							Por favor entre com o seu e-mail cadastrado em nosso sistema abaixo e n&oacute;s iremos enviar para voc&ecirc; uma nova senha.
						</td>
						
					</tr>					


					<tr>

						<td>
							E-mail: <input type="text" name="txtemail" alt="E-mail" id="txtemail" class="input-text required-entry validate-email <?php if ($erro <> "") {  ?> validation-failed <?php } ?>" value="<?php print $dados; ?>"/>
                    	</td>
                    </tr>
					<tr>
						<td>
							<button type="submit" title="Alterar Dados Cadastrais" value="5" name="tipoAlteracao" class="button"><span><span>Recuperar Senha</span></span></button>
							<a href="./login.php"><small> < </small>Voltar para o Login</a>	
						</td>

					</tr>

				
				</table>
				
				</form>			
			
			</td>
		
		</tr>
		

	
	</table>


</body>

</html>

