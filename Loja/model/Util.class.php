<?php

include_once('RsCorreios.class.php');

class Util {

	public function getEstados() {
		
		$sql = "SELECT ID_ESTADO, NM_ESTADO FROM tb_estados ORDER BY ID_ESTADO ASC";

		$rs = mysql_query($sql) or die (mysql_error());
			
		return $rs;			
		
	}
	
	public function getNomeEstado($idEstado) {
		
		$sql = "SELECT NM_ESTADO FROM tb_estados WHERE ID_ESTADO = " . $idEstado;

		$rs = mysql_query($sql) or die (mysql_error());
					
		$reg = mysql_fetch_assoc($rs);
		
		return $reg["NM_ESTADO"];		
		
	}
	

	function validaEmail($email){ 

		$mail_valido = 0; 
		
		//verifico umas coisas 
	   	if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 
	    
	   		if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 
	        
	   			//vejo se tem caracter . (ponto)
	         	if (substr_count($email,".")>= 1){ 
	            
	         		//obtenho a termina��o do dominio 
	            	$term_dom = substr(strrchr ($email, '.'),1); 
	            
	            	//verifico que a termina��o do dominio seja correcta 
	         		if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 
	            
	         			//verifico que o de antes do dominio seja correcto 
	            		$antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
	            		$caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
	            
	            		if ($caracter_ult != "@" && $caracter_ult != "."){ 
	               
	            			$mail_valido = 1; 
	            
	            		} 
	         
	         		} 
	      
	         	} 
	   
	   		} 
	
	   	} 
	
	
	   	if ($mail_valido) 
	   		return true; 
		else 
		   return false; 
	
	}	
	
	public function removeCaracteres ($string) {
		
 		$palavra = eregi_replace('\.', '', $string);
 		$palavra = eregi_replace('-', '', $palavra);			
 		$palavra = eregi_replace('\(', '', $palavra);
 		$palavra = eregi_replace('\)', '', $palavra);
 		$palavra = eregi_replace('/', '', $palavra);
 		$palavra = eregi_replace(' ', '', $palavra);
 		
 		
 		return $palavra; 
		
	}
	
	public function geraNovaSenha($tamanho, $maiusculas, $numeros, $simbolos) {
		
		// Caracteres de cada tipo
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-';

		// Vari�veis internas
		$retorno = '';
		$caracteres = '';

		// Agrupamos todos os caracteres que poder�o ser utilizados
		$caracteres .= $lmin;
		
		if ($maiusculas) $caracteres .= $lmai;
		if ($numeros) $caracteres .= $num;
		if ($simbolos) $caracteres .= $simb;
 
		// Calculamos o total de caracteres poss�veis
		$len = strlen($caracteres);

		for ($n = 1; $n <= $tamanho; $n++) {

			// Criamos um n�mero aleat�rio de 1 at� $len para pegar um dos caracteres
			$rand = mt_rand(1, $len);
	
			// Concatenamos um dos caracteres na vari�vel $retorno
			$retorno .= $caracteres[$rand-1];

		}

		return $retorno;
		
	}
	
	
	/**
	 * validaCPF
	 *
	 * Esta fun��o testa se um cpf � valido ou n�o. 
	 *
	 * @param	string		$cpf			Guarda o cpf como ele foi digitado pelo cliente
	 * @param	array		$num			Guarda apenas os n�meros do cpf
	 * @param	boolean		$isCpfValid		Guarda o retorno da fun��o
	 * @param	int			$multiplica 	Auxilia no Calculo dos D�gitos verificadores
	 * @param	int			$soma			Auxilia no Calculo dos D�gitos verificadores
	 * @param	int			$resto			Auxilia no Calculo dos D�gitos verificadores
	 * @param	int			$dg				D�gito verificador
	 * @return	boolean						"true" se o cpf � v�lido ou "false" caso o contr�rio
	 *
	 */
	 

	 public function validaCPF($cpf)
	 	{
			//Etapa 1: Cria um array com apenas os digitos num�ricos, isso permite receber o cpf em diferentes formatos como "000.000.000-00", "00000000000", "000 000 000 00" etc...
			$j=0;
			for($i=0; $i<(strlen($cpf)); $i++)
				{
					if(is_numeric($cpf[$i]))
						{
							$num[$j]=$cpf[$i];
							$j++;
						}
				}
			//Etapa 2: Conta os d�gitos, um cpf v�lido possui 11 d�gitos num�ricos.
			if(count($num)!=11)
				{
					$isCpfValid=false;
				}
			//Etapa 3: Combina��es como 00000000000 e 22222222222 embora n�o sejam cpfs reais resultariam em cpfs v�lidos ap�s o calculo dos d�gitos verificares e por isso precisam ser filtradas nesta parte.
			else
				{
					for($i=0; $i<10; $i++)
						{
							if ($num[0]==$i && $num[1]==$i && $num[2]==$i && $num[3]==$i && $num[4]==$i && $num[5]==$i && $num[6]==$i && $num[7]==$i && $num[8]==$i)
								{
									$isCpfValid=false;
									break;
								}
						}
				}
			//Etapa 4: Calcula e compara o primeiro d�gito verificador.
			if(!isset($isCpfValid))
				{
					$j=10;
					for($i=0; $i<9; $i++)
						{
							$multiplica[$i]=$num[$i]*$j;
							$j--;
						}
					$soma = array_sum($multiplica);	
					$resto = $soma%11;			
					if($resto<2)
						{
							$dg=0;
						}
					else
						{
							$dg=11-$resto;
						}
					if($dg!=$num[9])
						{
							$isCpfValid=false;
						}
				}
			//Etapa 5: Calcula e compara o segundo d�gito verificador.
			if(!isset($isCpfValid))
				{
					$j=11;
					for($i=0; $i<10; $i++)
						{
							$multiplica[$i]=$num[$i]*$j;
							$j--;
						}
					$soma = array_sum($multiplica);
					$resto = $soma%11;
					if($resto<2)
						{
							$dg=0;
						}
					else
						{
							$dg=11-$resto;
						}
					if($dg!=$num[10])
						{
							$isCpfValid=false;
						}
					else
						{
							$isCpfValid=true;
						}
				}
			//Trecho usado para depurar erros.
			/*
			if($isCpfValid==true)
				{
					echo "<font color=\"GREEN\">Cpf � V�lido</font>";
				}
			if($isCpfValid==false)
				{
					echo "<font color=\"RED\">Cpf Inv�lido</font>";
				}
			*/
			//Etapa 6: Retorna o Resultado em um valor booleano.
			return $isCpfValid;					
		}
	
	public function calculoPesoPedido($carrinho) {
		
		$pesoTotal = 0;
		
		foreach ($_SESSION['carrinho'] as $id => $quantidade) {

			$query = mysql_query("SELECT VL_PESO_PRODUTO FROM TB_PRODUTOS WHERE ID_PRODUTO =". mysql_real_escape_string((int) $id));

			while ($list = mysql_fetch_assoc($query)) {
		
//				print "Peso do Produto: " . $list["VL_PESO_PRODUTO"] . "<br/>";
				$pesoTotal += ($list["VL_PESO_PRODUTO"]*$quantidade);
				
			}
		
		}
		
		
		return $pesoTotal;
		
	}
		
	
	public function calculaFrete($codServico, $cepOrigem, $cepDestino, $peso, $comprimento, $altura, $largura) {
	
		// Instancia a classe
		$frete = new RsCorreios();

		// Percorre todos as vari�veis $_POST para setar os atributos necess�rios
		// Se voc� achar melhor pode fazer 1 a 1.
		// Ex.: $frete->setValue(�sCepOrigem�, $_POST['sCepOrigem']);
		// Aqui estou usando um foreach para economizar c�digo
//		foreach ($_POST as $key => $value) {
//		    $frete->setValue($key, $value);
//		}

				
		$frete->setValue("nCdServico", $codServico);
		$frete->setValue("sCepOrigem", $cepOrigem);
		$frete->setValue("sCepDestino", $cepDestino);
		$frete->setValue("nVlPeso", $peso);
		$frete->setValue("nVlComprimento", $comprimento);
		$frete->setValue("nVlAltura", $altura);
		$frete->setValue("nVlLargura", $largura);
/*
		print "Produto: " . $codServico . "<br/>";
		print "Cep Origem: " . $CepOrigem . "<br/>";
		print "Cep Destino: " . $CepDestino . "<br/>";
		print "Peso: " . $peso . "<br/>";
		print "Comprimento: " . $comprimento . "<br/>";
		print "Altura: " . $altura . "<br/>";
		print "Largura: " . $largura . "<br/>";
*/
		// Di�metro
		$frete->getDiametro();


		// Chamado ao m�todo getFrete, que ir� se comunicar com os correios
		// e nos trazer o resultado
		$result = $frete->getFrete();
		
		// Retornamos a mensagem de erro caso haja alguma falha
		if ($result['erro'] != 0) {
		    $resultadoFrete = $result['msg_erro'];
		}
		// Caso n�o haja erros mostramos o resultado de cada vari�vel retornada pelos correios.
		// Use apenas as que forem de seu interesse
		else {
		        
		        $resultadoFrete = "C�digo do Servi�o: " . $result['servico_codigo'] . "<br />";
		        $resultadoFrete .= "Valor do Frete: R$ " . $result['valor'] . "<br />";
		        $resultadoFrete .= "Prazo de Entrega: " . $result['prazo_entrega'] . " dias <br />";
		        $resultadoFrete .= "Valor p/ M�o Pr�pria: R$ " . $result['mao_propria'] . "<br />";
		        $resultadoFrete .= "Valor Aviso de Recebimento: R$ " . $result['aviso_recebimento'] . "<br />";
		        $resultadoFrete .= "Valor Declarado: R$ " . $result['valor_declarado'] . "<br />";
		        $resultadoFrete .= "Entrega Domiciliar: " . $result['en_domiciliar'] . "<br />";
		        $resultadoFrete .= "Entrega S�bado: " . $result['en_sabado'] . "<br />";
		}
	
		return $result['valor'];

	}
	
	
	public function formataDataHoraPayPal($texto) {

		// caso queira utilizar a virgula como separador decimal coloque nesta vari�vel
		
		$numeros = "0123456789";
		$dataHora = "";
		
	   for ($i=0; $i<strlen($texto) ; $i++) {
	   	
	   		for ($j=0; $j<strlen($numeros); $j++) {

	   			if ( $texto[$i] == $numeros[$j] ) {
	   				
	   				$dataHora .= $texto[$i];
	   				
	   			}
	   			
	   		}
	   	
	   }

	   $dataHora = substr($dataHora,0,4) . "-" . substr($dataHora,4,2) . "-" . substr($dataHora,6,2) . " " . substr($dataHora,8,2) . ":" . substr($dataHora,10,2) . ":" . substr($dataHora,12,4);
	   
	   return $dataHora;
	
	}	
	
	public function formataCPF ($cpf) {
		
		$cpf = substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "-" . substr($cpf, 9, 2); 

		return $cpf;
		
	}

	public function formataDataNascimento ($data) {
		
		$data = substr($data, 0, 2) . "/" . substr($data, 2, 2) . "/" . substr($data, 4, 4); 

		return $data;
		
	}

	public function formataCEP ($cep) {
		
		$cep = substr($cep, 0, 5) . "-" . substr($cep, 5, 3); 

		return $cep;
		
	}

	public function formataTelefone ($telefone) {
		
		if ( strlen($telefone) == 10 ) {

			$telefone = "(" . substr($telefone, 0, 2) . ") " . substr($telefone, 2, 4) . "-" . substr($telefone, 6, 4) ; 
			
		}
		
		if ( strlen($telefone) == 11 ) {

			$telefone = "(" . substr($telefone, 0, 2) . ") " . substr($telefone, 2, 5) . "-" . substr($telefone, 7, 4) ; 
			
		}
		
		return $telefone;
		
	}
	
	
}

?>