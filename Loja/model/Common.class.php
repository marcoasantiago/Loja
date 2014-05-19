<?php

class Common {

//retirar acentuação
function removerCaracteresEspeciais($a){
$a = eregi_replace("[àáâäã]","a",$a);
$a = eregi_replace("[èéêë]","e",$a);
$a = eregi_replace("[ìíîï]","i",$a);
$a = eregi_replace("[òóôöõ]","o",$a);
$a = eregi_replace("[ùúûü]","u",$a);
$a = eregi_replace("[ÀÁÂÄÃ]","A",$a);
$a = eregi_replace("[ÈÉÊË]","E",$a);
$a = eregi_replace("[ÌÍÎÏ]","I",$a);
$a = eregi_replace("[ÒÓÔÖÕ]","O",$a);
$a = eregi_replace("[ÙÚÛÜ]","U",$a);
$a = eregi_replace("ç","c",$a);
$a = eregi_replace("Ç","C",$a);
$a = eregi_replace("ñ","n",$a);
$a = eregi_replace("Ñ","N",$a);
$a = str_replace("´","",$a);
$a = str_replace("`","",$a);
$a = str_replace("¨","",$a);
$a = str_replace("^","",$a);
$a = str_replace("~","",$a);
$a = str_replace(".","",$a);
$a = str_replace("-","",$a);
$a = str_replace("/","",$a);
return $a;

}

function calculaFrete($cod_servico, $cep_origem, $cep_destino, $peso, $altura='2', $largura='11', $comprimento='16', $valor_declarado='0.50')
{
    #OFICINADANET###############################
    # Código dos Serviços dos Correios
    # 41106 PAC sem contrato
    # 40010 SEDEX sem contrato
    # 40045 SEDEX a Cobrar, sem contrato
    # 40215 SEDEX 10, sem contrato
    ############################################

    $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cep_origem."&sCepDestino=".$cep_destino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&nVlValorDeclarado=".$valor_declarado."&sCdAvisoRecebimento=n&nCdServico=".$cod_servico."&nVlDiametro=0&StrRetorno=xml";
    $xml = simplexml_load_file($correios);
    if($xml->cServico->Erro == '0')
        return $xml->cServico->Valor;
    else
        return false;

//echo "<br><Br>Cálculo de FRETE PAC: ". 
//calculaFrete('41106','26255170','96825150','0.1')."<br>";

//echo "<br><Br>Cálculo de FRETE SEDEX: ". 
//calculaFrete('40010','26255170','96825150','0.1')."<br>";

//echo "<br><Br>Cálculo de FRETE SEDEX a cobrar: ". 
//calculaFrete('40045','26255170','96825150','0.1')."<br>";

//echo "<br><Br>Cálculo de FRETE SEDEX 10: ". 
//calculaFrete('40215','26255170','96825150','0.1')."<br>";
     
}

   
}


?>
