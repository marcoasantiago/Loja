<?php

// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
include_once("../phpMailer/class.phpmailer.php");
include_once("PedidoDAO.class.php");
include_once("DBConexao.class.php");
include_once("ClienteDAO.class.php");
include_once("Util.class.php");


class Email {

	public function enviaEmailNovaSenha( $email, $senha, $nomeCliente ) {
		
		// Inicia a classe PHPMailer
		$mail = new PHPMailer();
 
		// Define os dados do servidor e tipo de conexão
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsSMTP(); // Define que a mensagem será SMTP
		$mail->Host = "smtp.guaianas.com"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
		$mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
		$mail->Username = 'atendimento@guaianas.com'; // Usuário do servidor SMTP (endereço de email)
		$mail->Password = 'cunha2015'; // Senha do servidor SMTP (senha do email usado)
		 
		// Define o remetente
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->From = "atendimento@guaianas.com"; // Seu e-mail
		$mail->Sender = "atendimento@guaianas.com"; // Seu e-mail
		$mail->FromName = "Atendimento Guaian�s"; // Seu nome
		
		
		// Define os destinatário(s)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->AddAddress($email);
		//$mail->AddAddress('e-mail@destino2.com.br');
		//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
		//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
 
		// Define os dados técnicos da Mensagem
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
		$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
		
		// Define a mensagem (Texto e Assunto)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->Subject  = "Envio de Nova Senha"; // Assunto da mensagem
		$mail->Body = Email::textoHTMLEmailNovaSenha($senha,$nomeCliente);
		
		// Define os anexos (opcional)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		//$mail->AddAttachment("/home/login/documento.pdf", "novo_nome.pdf");  // Insere um anexo
		 
		// Envia o e-mail
		$enviado = $mail->Send();
 
		// Limpa os destinatários e os anexos
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();

		return $enviado;
		
	}
	
	public function enviaEmailNovoUsuario( $email, $senha, $nomeCliente ) {

		// Inicia a classe PHPMailer
		$mail = new PHPMailer();
 
		// Define os dados do servidor e tipo de conexão
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsSMTP(); // Define que a mensagem será SMTP
		$mail->Host = "smtp.guaianas.com"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
		$mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
		$mail->Username = 'atendimento@guaianas.com'; // Usuário do servidor SMTP (endereço de email)
		$mail->Password = 'cunha2015'; // Senha do servidor SMTP (senha do email usado)
		 
		// Define o remetente
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->From = "atendimento@guaianas.com"; // Seu e-mail
		$mail->Sender = "atendimento@guaianas.com"; // Seu e-mail
		$mail->FromName = "Atendimento Guaian�s"; // Seu nome
		
		
		// Define os destinatário(s)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->AddAddress($email);
		//$mail->AddAddress('e-mail@destino2.com.br');
		//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
		//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
 
		// Define os dados técnicos da Mensagem
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
		$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
 
		// Define a mensagem (Texto e Assunto)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->Subject  = "Cadastro de Novo Usu�rio na Guaian�s.com"; // Assunto da mensagem
//		$mail->Body = "Obrigado por realizar o cadastro em nossa loja. O seu usu�rio � " . $email . " e sua senha �: ". $senha;
 
		$mail->Body = Email::textoHTMLEmailCadastro($email,$senha,$nomeCliente);
		
		// Define os anexos (opcional)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		//$mail->AddAttachment("/home/login/documento.pdf", "novo_nome.pdf");  // Insere um anexo
		 
		// Envia o e-mail
		$enviado = $mail->Send();
 
		// Limpa os destinatários e os anexos
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();

		return $enviado;
		
	}
	
	public function enviaEmailConfirmacaoPedido( $email, $idPedido ) {	

		// Inicia a classe PHPMailer
		$mail = new PHPMailer();
		
		// Inicia a Classe de Conex�o com o Banco de Dados
		$dbConexao = new DBConexao();
		$dbConexao->conecta();
 
		// Define os dados do servidor e tipo de conexão
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsSMTP(); // Define que a mensagem será SMTP
		$mail->Host = "smtp.guaianas.com"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
		$mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
		$mail->Username = 'atendimento@guaianas.com'; // Usuário do servidor SMTP (endereço de email)
		$mail->Password = 'cunha2015'; // Senha do servidor SMTP (senha do email usado)
		 
		// Define o remetente
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->From = "atendimento@guaianas.com"; // Seu e-mail
		$mail->Sender = "atendimento@guaianas.com"; // Seu e-mail
		$mail->FromName = "Atendimento Guaian�s"; // Seu nome
		
		
		// Define os destinatário(s)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->AddAddress($email);
		//$mail->AddAddress('e-mail@destino2.com.br');
		//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
		//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
 
		// Define os dados técnicos da Mensagem
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
		$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
 
		// Define a mensagem (Texto e Assunto)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->Subject  = utf8_encode("Confirma��o"). " de Pedido"; // Assunto da mensagem
		$mail->Body = Email::textoHTMLEmailPedido($email, $idPedido);
 
		// Define os anexos (opcional)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		//$mail->AddAttachment("/home/login/documento.pdf", "novo_nome.pdf");  // Insere um anexo
		 
		// Envia o e-mail
		$enviado = $mail->Send();
 
		// Limpa os destinatários e os anexos
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();

		return $enviado;
				
	}
	
	public function enviaEmailIndiqueAmigo($nome, $email, $nomeAmigo, $emailAmigo, $nomeProduto, $mensagem, $idProduto) {	

		// Inicia a classe PHPMailer
		$mail = new PHPMailer();
 
		// Define os dados do servidor e tipo de conexão
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsSMTP(); // Define que a mensagem será SMTP
		$mail->Host = "smtp.guaianas.com"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
		$mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
		$mail->Username = 'atendimento@guaianas.com'; // Usuário do servidor SMTP (endereço de email)
		$mail->Password = 'cunha2015'; // Senha do servidor SMTP (senha do email usado)
		 
		// Define o remetente
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->From = "atendimento@guaianas.com"; // Seu e-mail
		$mail->Sender = "atendimento@guaianas.com"; // Seu e-mail
		$mail->FromName = "Atendimento Guaian�s"; // Seu nome
		
		
		// Define os destinatário(s)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->AddAddress($emailAmigo);
		//$mail->AddAddress('e-mail@destino2.com.br');
		//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
		//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
 
		// Define os dados técnicos da Mensagem
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
		$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
 
		// Define a mensagem (Texto e Assunto)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->Subject  = "Indique a um Amigo"; // Assunto da mensagem
		$mail->Body = Email::textoHTMLEmailIndiqueAmigo($nome, $email, $nomeAmigo, $emailAmigo, $nomeProduto, $mensagem, $idProduto);
 
		// Define os anexos (opcional)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		//$mail->AddAttachment("/home/login/documento.pdf", "novo_nome.pdf");  // Insere um anexo
		 
		// Envia o e-mail
		$enviado = $mail->Send();
 
		// Limpa os destinatários e os anexos
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();

		return $enviado;		
	
	}	
	
	public function textoHTMLEmailCadastro($email,$senha,$nomeCliente) {
		
		return "
		
		<html>
			<head>  
    			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">  
    			<title>Guaian&aacute;s Importa&ccedil;&atilde;o e Com&eacute;rcio</title>  
			</head>

			<body>

				<table width=\"60%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"FFFFFF\" bordercolor=\"\">
					<tr>
						<td> 

							<table width=\"720\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#ffffff\">
								<tbody>
									<tr>
										<td valign=\"top\" align=\"left\" style=\"font-family:Arial;font-size:10px;font-weight:normal;text-align:left;\">&nbsp;</td>
										<td valign=\"top\" align=\"right\" style=\"font-family:Arial;font-size:10px;font-weight:normal;text-align:right;\">
											<a href=\"\" target=\"_blank\" style=\"color:#0078d2;text-decoration:none;\">Veja no Browser</a> 
										</td>
									</tr>
					
									<tr>
										<td valign=\"top\" colspan=\"2\">
											<img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/linha_cabecalho.png\" border=\"0\">
										</td>
									</tr>
								</tbody>
							</table>

							<table width=\"720\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#ffffff\">
          						<tbody>
          							<tr>
            							<td valign=\"top\" align=\"left\" colspan=\"11\">
            								<img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/separador.gif\" alt=\"\" width=\"1\" height=\"9\">
            							</td>
          							</tr>
          			
				         			<tr>
            							<td align=\"left\" valign=\"bottom\">
              								<a href=\"./index.php\" target=\"_blank\">
              									<img style=\"display:inline\" src=\"www.guaianas.com/imagens/email/guaianas_logo_email.png\"  border=\"0\" alt=\"Guaian&aacute;s\">
              								</a>
            							</td>
            						</tr>
         			
          							<tr>
            							<td valign=\"top\" align=\"left\" colspan=\"11\"><img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/separador.gif\" alt=\"\" width=\"1\" height=\"9\"></td>
         							</tr>
     							</tbody>
     						</table>

							<br/>

							<table width=\"720\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" border=\"0\">
								<tbody>
									<tr>
										<td>
											<font size=\"5px\" color=\"#0298d5\" face=\"Helvetica, Arial, sans-serif; Neue\">
												Ol&aacute; ". $nomeCliente .", parab&eacute;ns.
											</font>
											<br>
										</td>
									</tr>
					
									<tr>
										<td>
											<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica, Arial, sans-serif;\">
												Obrigado por se cadastrar na Guaian&aacute;s.com! A sua loja para Games e Eletr&ocirc;nicos Importados.
											</font><br/><br/>
										</td>
									</tr>

									<tr>
										<td>
											<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica, Arial, sans-serif;\">
												O seu cadastro foi criado com sucesso em nosso sistema. Segue abaixo as informa&ccedil;&otilde;es para acesso a sua nova conta.
												<br/><br/>
							
												Usu&aacute;rio: ". $email ."  <br/>
												Senha: 123456 <br/>
							
												<br/>
							
												Entre em nosso site e procure por seus produtos preferidos e exclusivos dos Estados Unidos e fa&ccedil;a j&aacute; o seu pedido!. <br/><br/>
												A entrega ser&aacute; realizada em at&eacute; 15 dias &uacute;teis, dependendo da mercadoria e forma de envio. <br/><br/>
							
												Abaixo uma demonstra&ccedil;&atilde;o de como funciona o nosso servi&ccedil;o. <br/><br/> 

												<img align=\"middle\" alt=\"\" src=\"www.guaianas.com/imagens/email/fluxo.png\">

												<br/><br/>
														
												A Guaian&aacute; trabalha rigorosamente de acordo com a legisla&ccedil;&atilde;o brasileira, realizando o pagamento de impostos devidos de cada importa&ccedil;&atilde;o realizada. <br/></br>

											</font>
										</td>
									</tr>

									<tr>
										<td><br/</td>
									</tr>						

									<tr>
										<td>
											<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica, Arial, sans-serif;\">
											Caso voc&ecirc; tenha alguma d&uacute;vida, ou sugest&atilde;o, entre em contato atrav&eacute;s do e-mail atendimento@guaianas.com.
											</font>
											<br/><br/>
										</td>					
									</tr>					

									<tr>
										<td>
											<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica Neue, Helvetica, Arial, sans-serif;\">
											Boas Compras!
											</font>
											<br/><br/>
										</td>					
									</tr>
					
									<tr>
										<td>
										<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; font-family:Helvetica Neue, Arial, sans-serif;\">
									
											Atenciosamente, <br/>
											Equipe Guaian&aacute;s Importados </br/><br/>
											<a href=\"./index.php\">http://www.guaianas.com</a> <br/><br/><br/>
											</font>
										</td>					
									</tr>
					
		    
			    					<tr>
										<td valign=\"top\" colspan=\"2\">
											<img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/linha_cabecalho.png\" border=\"0\">
										</td>
									</tr>
					
								</tbody>
							</table>
    
							<table width=\"720\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\" align=\"center\" style=\"font-family:Arial\">
								<tbody>
									<tr>
										<td valign=\"top\" style=\"FONT-WEIGHT: normal; FONT-SIZE: 10px; COLOR: #999999; font-family:Arial;valign:top;\">
											&copy; 2013 Guaian&aacute;s Importados. Todos os Direitos Reservados.<br><br>
										</td>
									</tr>
								</tbody>
							</table>


						</td>
					</tr>
				</table> 

			</body>
		</html>";		

	}
	
	public function textoHTMLEmailNovaSenha($senha,$nomeCliente) {

		return "
		
		<html>
			<head>  
    			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">  
    			<title>Guaian&aacute;s Importa&ccedil;&atilde;o e Com&eacute;rcio</title>  
			</head>

			<body>

				<table width=\"60%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"FFFFFF\" bordercolor=\"\">
					<tr>
						<td> 

							<table width=\"720\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#ffffff\">
								<tbody>
									<tr>
										<td valign=\"top\" align=\"left\" style=\"font-family:Arial;font-size:10px;font-weight:normal;text-align:left;\">&nbsp;</td>
										<td valign=\"top\" align=\"right\" style=\"font-family:Arial;font-size:10px;font-weight:normal;text-align:right;\">
											<a href=\"\" target=\"_blank\" style=\"color:#0078d2;text-decoration:none;\">Veja no Browser</a> 
										</td>
									</tr>
					
									<tr>
										<td valign=\"top\" colspan=\"2\">
											<img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/linha_cabecalho.png\" border=\"0\">
										</td>
									</tr>
								</tbody>
							</table>

							<table width=\"720\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#ffffff\">
          						<tbody>
          							<tr>
            							<td valign=\"top\" align=\"left\" colspan=\"11\">
            								<img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/separador.gif\" alt=\"\" width=\"1\" height=\"9\">
            							</td>
          							</tr>
          			
				         			<tr>
            							<td align=\"left\" valign=\"bottom\">
              								<a href=\"./index.php\" target=\"_blank\">
              									<img style=\"display:inline\" src=\"www.guaianas.com/imagens/email/guaianas_logo_email.png\"  border=\"0\" alt=\"Guaian&aacute;s\">
              								</a>
            							</td>
            						</tr>
         			
          							<tr>
            							<td valign=\"top\" align=\"left\" colspan=\"11\"><img style=\"display:block;\" src=\"http://www.guaianas.com/imagens/email/separador.gif\" alt=\"\" width=\"1\" height=\"9\"></td>
         							</tr>
     							</tbody>
     						
							</table>
							
							
							<table width=\"720\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" border=\"0\">


								<tbody>
									<tr>
										<td>
											<br/>
											<font size=\"5px\" color=\"#0298d5\" face=\"Helvetica, Arial, sans-serif; Neue\">
												<img alt=\"\" src=\"www.guaianas.com/imagens/email/check.png\"> &nbsp; Senha reenviada com sucesso!
											</font>
											<br>
										</td>
									</tr>
					
									<tr>
										<td>
											<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica, Arial, sans-serif;\">
												<br/>Ol&aacute; ". $nomeCliente .", <br/><br/>
												 	
												A sua nova senha de acesso da Guaian&aacute; &eacute; a seguinte: <strong>". $senha ."</strong> <br/><br/>
	
												Para a sua seguran&ccedil;a, n&atilde;o revele sua senha a ningu&eacute;m. <br/><br/>

												Se voc&ecirc; n&atilde;o solicitou sua senha, n&atilde;o se preocupe. 
												Essa mensagem foi enviada somente para o seu e-mail 
												e s&oacute; voc&ecirc; tem acesso a ela. <br/><br/>

												Continue suas compras a aproveite nossas grandes promo&ccedil;&otilde;es. <br/><br/>
											</font>
										</td>
									</tr>

									<tr>
										<td>
											<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica, Arial, sans-serif;\">
											Caso voc&ecirc; tenha alguma d&uacute;vida, ou sugest&atilde;o, entre em contato atrav&eacute;s do e-mail atendimento@guaianas.com.
											</font>
											<br/><br/>
										</td>					
									</tr>					

									<tr>
										<td>
											<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica Neue, Helvetica, Arial, sans-serif;\">
											Boas Compras!
											</font>
											<br/><br/>
										</td>					
									</tr>
					
									<tr>
										<td>
										<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; font-family:Helvetica Neue, Arial, sans-serif;\">
									
											Atenciosamente, <br/>
											Equipe Guaian&aacute;s Importados </br/><br/>
											<a href=\"./index.php\">http://www.guaianas.com</a> <br/><br/>
											</font>
										</td>					
									</tr>
					
		    
			    					<tr>
										<td valign=\"top\" colspan=\"2\">
											<img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/linha_cabecalho.png\" border=\"0\">
										</td>
									</tr>
					
								</tbody>
							</table>
							
							
							<table width=\"720\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\" align=\"center\" style=\"font-family:Arial\">
								<tbody>
									<tr>
										<td valign=\"top\" style=\"FONT-WEIGHT: normal; FONT-SIZE: 10px; COLOR: #999999; font-family:Arial;valign:top;\">
											&copy; 2013 Guaian&aacute;s Importados. Todos os Direitos Reservados.<br><br>
										</td>
									</tr>
								</tbody>
							</table>


						</td>
					</tr>
				</table> 

			</body>
		</html>";		
			
	}	
		

		public function textoHTMLEmailPedido($email, $idPedido) {		

			
		$pedidoDAO = new PedidoDAO();
		
		$detalhePedido = $pedidoDAO->getDetalhesPedido($idPedido);
			
		$infoPedido = $pedidoDAO->getInfoPedido($idPedido);
		
		$clienteDAO = new ClienteDAO();
		
		$infoCliente = $clienteDAO->getInfoCliente($email);
		
		$pagina = "
		
		<html>
			<head>  
    			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">  
    			<title>Guaian&aacute;s Importa&ccedil;&atilde;o e Com&eacute;rcio</title>  
			</head>

			<body>

				<table width=\"60%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"FFFFFF\" bordercolor=\"\">
					<tr>
						<td> 

							<table width=\"720\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#ffffff\">
								<tbody>
									<tr>
										<td valign=\"top\" align=\"left\" style=\"font-family:Arial;font-size:10px;font-weight:normal;text-align:left;\">&nbsp;</td>
										<td valign=\"top\" align=\"right\" style=\"font-family:Arial;font-size:10px;font-weight:normal;text-align:right;\">
											<a href=\"\" target=\"_blank\" style=\"color:#0078d2;text-decoration:none;\">Veja no Browser</a> 
										</td>
									</tr>
					
									<tr>
										<td valign=\"top\" colspan=\"2\">
											<img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/linha_cabecalho.png\" border=\"0\">
										</td>
									</tr>
								</tbody>
							</table>

							<table width=\"720\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#ffffff\">
          						<tbody>
          							<tr>
            							<td valign=\"top\" align=\"left\" colspan=\"11\">
            								<img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/separador.gif\" alt=\"\" width=\"1\" height=\"9\">
            							</td>
          							</tr>
          			
				         			<tr>
            							<td align=\"left\" valign=\"bottom\">
              								<a href=\"./index.php\" target=\"_blank\">
              									<img style=\"display:inline\" src=\"www.guaianas.com/imagens/email/guaianas_logo_email.png\"  border=\"0\" alt=\"Guaian&aacute;s\">
              								</a>
            							</td>
            						</tr>
         			
          							<tr>
            							<td valign=\"top\" align=\"left\" colspan=\"11\"><img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/separador.gif\" alt=\"\" width=\"1\" height=\"9\"></td>
         							</tr>
     							</tbody>
     						
							</table>
							
							
							<table width=\"720\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" border=\"0\">


								<tbody>
									<tr>
										<td>
											<br/>
											<font size=\"5px\" color=\"#0298d5\" face=\"Helvetica, Arial, sans-serif; Neue\">
												<img alt=\"\" src=\"www.guaianas.com/imagens/email/check.png\"> Recebemos o seu Pedido!
											</font>
											<br>
										</td>
									</tr>
					
									<tr>
										<td>
											<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica, Arial, sans-serif;\">
												<br/>Ol&aacute; ". $infoCliente["NM_CLIENTE"] .".<br/><br/>

												Voc&ecirc; ser&aacute; informado(a) por e-mail sobre o andamento do pedido at&eacute; a chegada ao endere&ccedil;o escolhido.<br/><br/>	
											</font>
										</td>	
																								
									</tr>	
									
									<tr>	
										<td>	
												
												<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"720\">
              										<tbody>
              											<tr>
                											<td width=\"30\"><img src=\"www.guaianas.com/imagens/email/barra_esquerda.png\" alt=\"N�mero do seu pedido �:\" style=\"border:0;display:block\" > </td>
                											<td bgcolor=\"#ededed\"><font face=\"Arial, Helvetica, sans-serif\" color=\"#00adef\" style=\"font-size:20px\">N&uacute;mero do Seu Pedido:<b> ". str_pad($idPedido,10,"0",STR_PAD_LEFT) ."</b></font> </td>
                											<td width=\"30\"><img src=\"www.guaianas.com/imagens/email/barra_direita.png\" alt=\"endere�o de entrega\" style=\"border:0;display:block\" width=\"30\" height=\"59\"> </td>
              											</tr>
            										</tbody>
            									</table>
            							</td>
            						</tr>
            							
            						<tr>
            							<td>		
            									<br/><br/>

												<img alt=\"\" src=\"www.guaianas.com/imagens/email/pedido.png\">
												<font size=\"5px\" color=\"#0298d5\" face=\"Helvetica, Arial, sans-serif; Neue\">Detalhes do Seu Pedido:</font>
												
												<img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/linha_cabecalho.png\" border=\"0\">
										</td>
									</tr>
									
									<tr>
										<td>
												
												<br/>

												

                							<table align=\"center\" style=\"width: 100%; border-collapse: collapse; border-spacing: 0; empty-cells: show; font-size: 100%;\" border=\"0\">
	                			
	                							
                								<thead style=\"display: table-header-group; vertical-align: middle; border-color: inherit; margin: 0; padding: 0;\">
	                								
                									<tr style=\"vertical-align: inherit; border-color: inherit; display: table-row;\">
	                									
	                									<th style=\"text-align: center !important; font-weight: bold; color: #383838; white-space: nowrap;\" rowspan=\"1\"><div style=\"background: url(./imagens/template/title_bg1.gif) no-repeat;\" ><div style=\"background: url(./imagens/template/title_bg1.gif) no-repeat;\"><span style=\"height: 33px; line-height: 33px; padding: 0 10px; font-size: 12px;\">#</span></div></div></th>
	                									<th style=\"text-align: center !important; font-weight: bold; color: #383838; white-space: nowrap;\" rowspan=\"1\"><div style=\"background: url(./imagens/template/title_bg1.gif) no-repeat;\" ><div style=\"background: url(./imagens/template/title_bg1.gif) no-repeat;\"><span style=\"height: 33px; line-height: 33px; padding: 0 10px; font-size: 12px;\">Produto</span></div></div></th>
	                									<th style=\"text-align: center !important; font-weight: bold; color: #383838; white-space: nowrap;\" rowspan=\"1\"><div style=\"background: url(./imagens/template/title_bg1.gif) no-repeat;\" ><div style=\"background: url(./imagens/template/title_bg1.gif) no-repeat;\"><span style=\"height: 33px; line-height: 33px; padding: 0 10px; font-size: 12px;\">Quantidade</span></div></div></th>
	                									<th style=\"text-align: center !important; font-weight: bold; color: #383838; white-space: nowrap;\" rowspan=\"1\"><div style=\"background: url(./imagens/template/title_bg1.gif) no-repeat;\" ><div style=\"background: url(./imagens/template/title_bg1.gif) no-repeat;\"><span style=\"height: 33px; line-height: 33px; padding: 0 10px; font-size: 12px; \">Valor Unit&aacute;rio</span></div></div></th>
	                									<th style=\"text-align: center !important; font-weight: bold; color: #383838; white-space: nowrap;\" rowspan=\"1\"><div style=\"background: url(./imagens/template/title_bg1.gif) no-repeat;\" ><div style=\"background: url(./imagens/template/title_bg1.gif) no-repeat;\"><span style=\"height: 33px; line-height: 33px; padding: 0 10px; font-size: 12px;\">SubTotal</span></div></div></th>

	            									</tr>
	                								
                								</thead>";
	                							
												while ( $listDetalhe = mysql_fetch_assoc($detalhePedido) ) {
													
													$pagina = $pagina .		
												
												"
               									<tbody>
                                   					<tr>    
               											<td style=\"padding: 15px 10px; border: 0; border-bottom: solid 1px #EBEBEB; text-align: center !important;\">
               												<span class=\"cart-price\">
               													<span style=\"font-size: 12px; font-weight: bold; color: #1654A4;\">". $listDetalhe["ROWNUM"] ."</span>
               												</span>
               											</td>

   														<td style=\"padding: 15px 10px; border: 0; border-bottom: solid 1px #EBEBEB; text-align: center !important;\">
     														
                   												<a style=\"color: #9D9D9D; text-decoration: none; font-family: Arial, Helvetica, sans-serif; font-size: 12px;\" href=\"./detalheProduto.php?idproduto=". $listDetalhe["ID_PRODUTO"] ."\">". $listDetalhe["NM_PRODUTO"] ."</a>
               												
                                               			</td>

   														<td style=\"padding: 15px 10px; border: 0; border-bottom: solid 1px #EBEBEB; text-align: center !important;\">
     														
                   												<a style=\"color: #9D9D9D; text-decoration: none; font-family: Arial, Helvetica, sans-serif; font-size: 12px;\" href=\"./detalheProduto.php?idproduto=\">". $listDetalhe["QTD_PRODUTO"] ."</a>
               												
                                               			</td>


               											<td style=\"padding: 15px 10px; border: 0; border-bottom: solid 1px #EBEBEB; text-align: center !important;\">
               												<span class=\"cart-price\">
               													<span style=\"font-size: 12px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #1654A4;\">". number_format($listDetalhe["VL_PRODUTO"]/100,2,",",".") ."</span>
               												</span>
               											</td>

               											<td style=\"padding: 15px 10px; border: 0; border-bottom: solid 1px #EBEBEB; text-align: center !important;\">
               												<span class=\"cart-price\">
               													<span style=\"font-size: 12px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #1654A4;\">". number_format($listDetalhe["VL_TOTAL_PRODUTO"]/100,2,",",".") ."</span>
               												</span>
               											</td>       													
       													
													</tr>
												</tbody>

												";

												}

												
												$pagina = $pagina .
												
												"
               									<tbody style=\"color: #787878; line-height: 1.5em; font-family: Arial, Helvetica, sans-serif; font-size: 12px;\">

                                   					<tr style=\"vertical-align: inherit; border-color: inherit;\">   

                                   					 
														<td style=\"padding: 15px 10px; border: 0; border-bottom: solid 1px #EBEBEB; text-align: center !important;\"></td>
               											<td style=\"padding: 15px 10px; border: 0; border-bottom: solid 1px #EBEBEB; text-align: center !important;\"></td>
               											<td style=\"padding: 15px 10px; border: 0; border-bottom: solid 1px #EBEBEB; text-align: center !important;\"></td>

               											<td style=\"padding: 15px 10px; border: 0; border-bottom: solid 1px #EBEBEB; text-align: center !important;\">
               												<stong style=\"font-weight: bold;\">Frete</stong>
               											</td>

               											<td style=\"padding: 15px 10px; border: 0; border-bottom: solid 1px #EBEBEB; text-align: center !important;\">
               												<span><span style=\"font-size: 12px; font-weight: bold; color: #1654A4;\">". number_format($infoPedido["VL_FRETE"]/100,2,",",".") ."</span></span>
               											</td>

													</tr>
														
												</tbody>	
												
               									<tbody style=\"color: #787878; line-height: 1.5em; font-family: Arial, Helvetica, sans-serif; font-size: 12px;\">

                                   					<tr style=\"vertical-align: inherit; border-color: inherit;\">   

                                   					 
														<td style=\"padding: 15px 10px; border: 0; border-bottom: solid 1px #EBEBEB; text-align: center !important;\"></td>
               											<td style=\"padding: 15px 10px; border: 0; border-bottom: solid 1px #EBEBEB; text-align: center !important;\"></td>
               											<td style=\"padding: 15px 10px; border: 0; border-bottom: solid 1px #EBEBEB; text-align: center !important;\"></td>

               											<td style=\"padding: 15px 10px; border: 0; border-bottom: solid 1px #EBEBEB; text-align: center !important;\">
               												<stong style=\"font-weight: bold;\">Total</stong>
               											</td>

               											<td style=\"padding: 15px 10px; border: 0; border-bottom: solid 1px #EBEBEB; text-align: center !important;\">
               												<span><span style=\"font-size: 12px; font-weight: bold; color: #1654A4;\">". number_format($infoPedido["VL_PEDIDO"]/100,2,",",".") ."</span></span>
               											</td>

													</tr>
														
												</tbody>						

	               							</table>

										</td>
									</tr>
									
									<tr>
										<td>
												 	
												<br/><br/>
												
												<img alt=\"\" src=\"www.guaianas.com/imagens/email/cifrao.png\">
												<font size=\"5px\" color=\"#0298d5\" face=\"Helvetica, Arial, sans-serif; Neue\">Forma de Pagamento: </font>
												
												<img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/linha_cabecalho.png\" border=\"0\">
												
												
												<br/><br/>
												
												<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica, Arial, sans-serif;\">
												<strong>". $infoPedido["NM_OPCAO_PAGAMENTO"] ."</strong><br/>
												Data do Pagamento: ". $infoPedido["DT_COMPRA"] ."<br/>
												ID da Transa&ccedil;&atilde;o: ". $infoPedido["ID_TRANSACAO"] ."<br/>
												</font>
				
												<br/><br/>
												
												<img alt=\"\" src=\"www.guaianas.com/imagens/email/entrega.png\">
												<font size=\"5px\" color=\"#0298d5\" face=\"Helvetica, Arial, sans-serif; Neue\">Endere&ccedil;o de Entrega:</font> 
												
												<img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/linha_cabecalho.png\" border=\"0\">
												
												<br/>
												
												<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica, Arial, sans-serif;\">
												". $infoCliente["NM_ENDERECO"] .", ". $infoCliente["NO_ENDERECO"] ." - ". $infoCliente["NM_COMPLEMENTO"] . "<br/>
												". $infoCliente["NM_BAIRRO"] ." - ". $infoCliente["NM_CIDADE"] ." - ". $infoCliente["NM_ESTADO"] ."<br/>
												CEP: ". Util::formataCEP($infoCliente["NO_CEP"]) ."<br/>
												</font>
												
												 
												<br/><br/>
												
												<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica, Arial, sans-serif;\">
												Continue suas compras a aproveite nossas grandes promo&ccedil;&otilde;es. <br/><br/>
												</font>
										</td>
									</tr>

									
					

									<tr>
										<td>
											<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica, Arial, sans-serif;\">
											Caso voc&ecirc; tenha alguma d&uacute;vida, ou sugest&atilde;o, entre em contato atrav&eacute;s do e-mail atendimento@guaianas.com.
											</font>
											<br/><br/>
										</td>					
									</tr>					

									<tr>
										<td>
											<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica Neue, Helvetica, Arial, sans-serif;\">
											Boas Compras!
											</font>
											<br/><br/>
										</td>					
									</tr>
					
									<tr>
										<td>
										<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; font-family:Helvetica Neue, Arial, sans-serif;\">
									
											Atenciosamente, <br/>
											Equipe Guaian&aacute;s Importados </br/><br/>
											<a href=\"./index.php\">http://www.guaianas.com</a> <br/><br/>
											</font>
										</td>					
									</tr>
					
		    
			    					<tr>
										<td valign=\"top\" colspan=\"2\">
											<img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/linha_cabecalho.png\" border=\"0\">
										</td>
									</tr>
					
								</tbody>
							</table>
							
							
							<table width=\"720\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\" align=\"center\" style=\"font-family:Arial\">
								<tbody>
									<tr>
										<td valign=\"top\" style=\"FONT-WEIGHT: normal; FONT-SIZE: 10px; COLOR: #999999; font-family:Arial;valign:top;\">
											&copy; 2013 Guaian&aacute;s Importados. Todos os Direitos Reservados.<br><br>
										</td>
									</tr>
								</tbody>
							</table>


						</td>
					</tr>
				</table> 

			</body>
		</html>
		";

		return $pagina;
			
		}
		
		public function textoHTMLEmailIndiqueAmigo($nome, $email, $nomeAmigo, $emailAmigo, $nomeProduto, $mensagem, $idProduto) {	
			
			if ($mensagem == "") {
			
				$mensagem = "Sem mensagem.";
				
			}
			
			return "

		<html>
			<head>  
    			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">  
    			<title>Guaian&aacute;s Importa&ccedil;&atilde;o e Com&eacute;rcio</title>  
			</head>

			<body>

				<table width=\"60%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"FFFFFF\" bordercolor=\"\">
					<tr>
						<td> 

							<table width=\"720\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#ffffff\">
								<tbody>
									<tr>
										<td valign=\"top\" align=\"left\" style=\"font-family:Arial;font-size:10px;font-weight:normal;text-align:left;\">&nbsp;</td>
										<td valign=\"top\" align=\"right\" style=\"font-family:Arial;font-size:10px;font-weight:normal;text-align:right;\">
											<a href=\"\" target=\"_blank\" style=\"color:#0078d2;text-decoration:none;\">Veja no Browser</a> 
										</td>
									</tr>
					
									<tr>
										<td valign=\"top\" colspan=\"2\">
											<img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/linha_cabecalho.png\" border=\"0\">
										</td>
									</tr>
								</tbody>
							</table>

							<table width=\"720\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#ffffff\">
          						<tbody>
          							<tr>
            							<td valign=\"top\" align=\"left\" colspan=\"11\">
            								<img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/separador.gif\" alt=\"\" width=\"1\" height=\"9\">
            							</td>
          							</tr>
          			
				         			<tr>
            							<td align=\"left\" valign=\"bottom\">
              								<a href=\"./index.php\" target=\"_blank\">
              									<img style=\"display:inline\" src=\"www.guaianas.com/imagens/email/guaianas_logo_email.png\"  border=\"0\" alt=\"Guaian&aacute;s\">
              								</a>
            							</td>
            						</tr>
         			
          							<tr>
            							<td valign=\"top\" align=\"left\" colspan=\"11\"><img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/separador.gif\" alt=\"\" width=\"1\" height=\"9\"></td>
         							</tr>
     							</tbody>
     						
							</table>
							
							
							<table width=\"720\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" border=\"0\">


								<tbody>
									<tr>
										<td>
											<br/>
											<font size=\"5px\" color=\"#0298d5\" face=\"Helvetica, Arial, sans-serif; Neue\">
												<img alt=\"\" src=\"www.guaianas.com/imagens/email/favorito.png\"> &nbsp; Indica&ccedil;&atilde;o de Produto!
											</font>
											<br>
										</td>
									</tr>
					
									<tr>
										<td>
											<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica, Arial, sans-serif;\">
												<br/>Ol&aacute; ". $nomeAmigo .", o seu Amigo ". $nome ." indicou o seguinte produto para voce: <strong>". $nomeProduto ."!</strong><br/><br/>

												Mensagem: <br/><br/>

												". $mensagem ." <br/><br/>
												
												Clique <a href=\"www.guaianas.com/detalheProduto.php?idproduto=".$idProduto."\">aqui</a> para ver a oferta. <br/><br/>
												
												Continue suas compras e aproveite nossas grandes promo&ccedil;&otilde;es. <br/><br/>
											</font>
										</td>
									</tr>

									
					

									<tr>
										<td>
											<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica, Arial, sans-serif;\">
											Caso voc&ecirc; tenha alguma d&uacute;vida, ou sugest&atilde;o, entre em contato atrav&eacute;s do e-mail atendimento@guaianas.com.
											</font>
											<br/><br/>
										</td>					
									</tr>					

									<tr>
										<td>
											<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; FONT-FAMILY: Helvetica Neue, Helvetica, Arial, sans-serif;\">
											Boas Compras!
											</font>
											<br/><br/>
										</td>					
									</tr>
					
									<tr>
										<td>
										<font style=\"FONT-WEIGHT: regular; FONT-SIZE: 14px; COLOR: #607982; font-family:Helvetica Neue, Arial, sans-serif;\">
									
											Atenciosamente, <br/>
											Equipe Guaian&aacute;s Importados </br/><br/>
											<a href=\"./index.php\">http://www.guaianas.com</a> <br/><br/>
											</font>
										</td>					
									</tr>
					
		    
			    					<tr>
										<td valign=\"top\" colspan=\"2\">
											<img style=\"display:block;\" src=\"www.guaianas.com/imagens/email/linha_cabecalho.png\" border=\"0\">
										</td>
									</tr>
					
								</tbody>
							</table>
							
							
							<table width=\"720\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\" align=\"center\" style=\"font-family:Arial\">
								<tbody>
									<tr>
										<td valign=\"top\" style=\"FONT-WEIGHT: normal; FONT-SIZE: 10px; COLOR: #999999; font-family:Arial;valign:top;\">
											&copy; 2013 Guaian&aacute;s Importados. Todos os Direitos Reservados.<br><br>
										</td>
									</tr>
								</tbody>
							</table>


						</td>
					</tr>
				</table> 

			</body>
		</html>							
			";
			
			
		}	
		
	
}

?>