<?php
/*
 * Created on 09/06/2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 // 1 - Função que retorna a data atual no padrão Português Brasileiro (dd/MM/YYYY):
function data_atual()
{

// leitura das datas
$dia = date('d');
$mes = date('m');
$ano = date('Y');

// definindo padrão pt (dd/MM/YYYY)
$data = "$dia/$mes/$ano";

return $data;
}
/*
Utilização:
data_atual();
*/
// 2- Função que retorna a data atual no padrão Inglês (YYYY-MM-DD):
function data_atual_en() {

// leitura das datas
$dia = date('d');
$mes = date('m');
$ano = date('Y');

// definindo padrão en (YYYY-MM-DD)
$data_en = "$ano-$mes-$dia";

return $data_en;
}
/*
 Utilização:
data_atual_en();
*/

// 3- FUNÇÃO QUE RETORNA A HORA ATUAL (Hora e Minuto)
function hora_atual() {
 $hora = date("H:i");
 return $hora;
}
/*
Utilização:
hora_atual();
*/
// 4- FUNÇÃO HORA ATUAL COMPLETA (Hora / Minuto / Segundo)
function hora_atual_completa() {
 $hora = date("H:i:s");
 return $hora;
}
/*
Utilização:
hora_atual_completa();
*/
// 5- FUNÇÃO QUE VALIDA A DATA
/*Esta função faz todas a verificações necessárias como verificar se
 o mês está entre 1 e 12, verificar se o dia está dentro dos dias permitidos
 para aquele mês (leva em consideração os anos bissextos) e
 verificar se o ano é válido.
OBS.: As datas enviadas podem estar no formato inglês (en) ou brasileiro (pt).
*/
function valida_data($data, $tipo = "pt")
{

	if ($tipo == 'pt')
	{
		$d = explode("/", $data);
		$dia = $d[0];
		$mes = $d[1];
		$ano = $d[2];
	}
	else if ($tipo == 'en')
	{
		$d = explode("-",$data);
		$dia = $d[2];
		$mes = $d[1];
		$ano = $d[0];
	}

	//usando função checkdate para validar a data
	if (checkdate($mes, $dia, $ano))
	{
		$data = $ano.'/'.$mes.'/'.$dia;

		if (
			//verificando se o ano tem 4 dígitos
			(strlen($ano) != '4') ||
			//verificando se o mês é menor que zero
			($mes <= '0') ||
                        //verificando se o mês é maior que 12
                        ($mes > '12') ||
			//verificando se o dia é menor que zero
			($dia <= '0') ||
                        //verificando se o dia é maior que 31
                        ($dia > '31')
		    )
		{
			return false;
		}

		if (strlen($data) == 10)
			return true;
	}
	else
	{
		return false;
	}
}
/*
Utilização:
Validar data no formato brasileiro (dd/mm/yyyy):
valida_data('27/07/2009', 'pt');
Validar data no formato inglês (yyyy-mm-dd):
valida_data('2009-07-27', 'en');
*/
// 6- CONVERTER DATA BRASILEIRA (dd/mm/YYY) PARA PADRAO DO BANCO DE DADOS
function data_user_para_mysql($y){
    $data_inverter = explode("/",$y);
    $x = $data_inverter[2].'-'. $data_inverter[1].'-'. $data_inverter[0];
    return $x;
}
/*
Utilização:
data_user_para_mysql('11/02/1992')

Resultado: 1992-02-11
*/
// 7- CONVERTER DATA DO BANCO DE DADOS PARA DATA BRASILEIRA
function data_mysql_para_user($y)
{
	if ($y != '')
	{
		$x = substr($y,8,2)."/".substr($y,5,2)."/".substr($y,0,4);

		return $x;
	}
	else
	{
		return '';
	}

}
/*
Utilização:
data_mysql_para_user('1992-02-11')

Resultado: 11/02/1992
*/
/* Para criar os selects na pagina HTML
 */

function saca_menu_dinamico($ssql,$valor,$nome){
   echo "<select name='$nome'>";
   echo "<option value=' '>";
   $resultado=mysql_query($ssql);
   while ($fila=mysql_fetch_row($resultado))
   {
     if ($fila[0]==$valor){
       echo "<option selected value='$fila[0]'>$fila[1]";
     }
     else{
       echo "<option value='$fila[0]'>$fila[1]";
     }
   }
   echo "</select>";
}
/*
validar_data.php

Script que contém a função validar(), usada para verificar se uma
data é válida ou não. Por exemplo, se o usuário informar 31/02,
o programa irá acusar que a data não é válida.

Programado por:
Fábio Berbert de Paula <fabio@vivaolinux.com.br>

Rio de Janeiro, 15 de Agosto de 2003
*/
// função usada para validar o ano
function validar($dia , $mes, $ano) {
if ( (($ano % 4) == 0) && ($mes == 2) && ($dia > 29) )
  // se o mês for fevereiro e o ano for bissexto, dia não pode
  // ser maior que 29
  return 0;
else if ( (($ano % 4) > 0) && ($mes == 2) && ($dia > 28) )
  // se o mês for fevereiro e o ano não for bissexto, dia não pode
  // ser maior que 28
  return 0;
else if( (($mes == 4) || ($mes == 6) || ($mes == 9) || ($mes == 11) ) && ($dia == 31))
  // se o mês for Abril, Junho, Setembro ou Novembro, dia não pode ser 31
  return 0;
else
  return 1;
}

# Autor: Marcello R. Gonçalves 
# E-mail: marcellorg@yahoo.com.br 
# Site: http://www.gracaamorevida.com.br 
# Data: 24/11/2004 
# MS VALIDATE 
# Versão: 1.0 
# Licença: GNU 
# "DEUS NÃO ESCOLHE OS CAPACITADOS, E SIM CAPACITA OS ESCOLHIDOS" 
#===============================================================================

function valData($Data) 
{ 
list($Dia,$Mes,$Ano)= split ('[/.-]', $Data, 3); 
return @checkdate ( $Mes, $Dia, $Ano); 
} 

function valNumero($Numero) 
{ 
return preg_match ("/^([0-9]+)$/", $Numero); 
} 

function valEmail($email) 
{ 
eregi("^([0-9a-zA-Z]+)([.,_]([0-9a-zA-Z]+))*[@]([0-9a-zA-Z]+)([.]([0-9a-zA-Z]+))*[.]([0-9a-zA-Z]){2}([0-9a-zA-Z])?$",$email,$match);
//Divide os valores dos casamentos da ER e separa em variáveis, $email_comp é o email completo para você verificar, portanto se a variável $email_comp for igual a $email o e-mail será válido 
list($email_comp,$login,$domain,$sufixies) = $match; 
//Inicia a verificação do email, conforme dito, se $email_comp for igual a $email, o email será válido 

if ($email_comp == $email) 
{ 
return TRUE; 
/** Instruções caso o e-mail seja válido aqui **/ 
}else{ 
return FALSE; 
/** Instruções caso o e-mail seja INválido aqui **/ 
} 
} 

#--------------------------------------------------------------------------------------------------------------------------------------------- 

//Validar CPF 
function valCpf($Cpf) 
{ 
$RecebeCPF=$Cpf; 
//Retirar todos os caracteres que não sejam 0-9 
$s=""; 
for ($x=1; $x<=strlen($RecebeCPF); $x=$x+1) 
{ 
$ch=substr($RecebeCPF,$x-1,1); 
if (ord($ch)>=48 && ord($ch)<=57) 
{ 
$s=$s.$ch; 
} 
} 

$RecebeCPF=$s; 
if ($RecebeCPF=="00000000000") 
{ 
$then; 
return FALSE; 
}else{ 
$Numero[1]=intval(substr($RecebeCPF,1-1,1)); 
$Numero[2]=intval(substr($RecebeCPF,2-1,1)); 
$Numero[3]=intval(substr($RecebeCPF,3-1,1)); 
$Numero[4]=intval(substr($RecebeCPF,4-1,1)); 
$Numero[5]=intval(substr($RecebeCPF,5-1,1)); 
$Numero[6]=intval(substr($RecebeCPF,6-1,1)); 
$Numero[7]=intval(substr($RecebeCPF,7-1,1)); 
$Numero[8]=intval(substr($RecebeCPF,8-1,1)); 
$Numero[9]=intval(substr($RecebeCPF,9-1,1)); 
$Numero[10]=intval(substr($RecebeCPF,10-1,1)); 
$Numero[11]=intval(substr($RecebeCPF,11-1,1)); 

$soma=10*$Numero[1]+9*$Numero[2]+8*$Numero[3]+7*$Numero[4]+6*$Numero[5]+5* 
$Numero[6]+4*$Numero[7]+3*$Numero[8]+2*$Numero[9]; 
$soma=$soma-(11*(intval($soma/11))); 

if ($soma==0 || $soma==1) 
{ 
$resultado1=0; 
} 
else 
{ 
$resultado1=11-$soma; 
} 

if ($resultado1==$Numero[10]) 
{ 
$soma=$Numero[1]*11+$Numero[2]*10+$Numero[3]*9+$Numero[4]*8+$Numero[5]*7+$Numero[6]*6+$Numero[7]*5+ 
$Numero[8]*4+$Numero[9]*3+$Numero[10]*2; 
$soma=$soma-(11*(intval($soma/11))); 

if ($soma==0 || $soma==1) 
{ 
$resultado2=0; 
}else{ 
$resultado2=11-$soma; 
} 

if ($resultado2==$Numero[11]) 
{ 
return TRUE; 
}else{ 
return FALSE; 
} 
}else{ 
return FALSE; 
} 
} 
}// Fim do validar CPF 

#--------------------------------------------------------------------------------------------------------------------------------------------- 

//Validar Cnpj 
function valCnpj($Cnpj) 
{ 
$RecebeCNPJ=${"Cnpj"}; 
$s=""; 
for ($x=1; $x<=strlen($RecebeCNPJ); $x=$x+1) 
{ 
$ch=substr($RecebeCNPJ,$x-1,1); 
if (ord($ch)>=48 && ord($ch)<=57) 
{ 
$s=$s.$ch; 
} 
} 

$RecebeCNPJ=$s; 
if ($RecebeCNPJ=="00000000000000") 
{ 
$then; 
return FALSE; 
}else{ 
$Numero[1]=intval(substr($RecebeCNPJ,1-1,1)); 
$Numero[2]=intval(substr($RecebeCNPJ,2-1,1)); 
$Numero[3]=intval(substr($RecebeCNPJ,3-1,1)); 
$Numero[4]=intval(substr($RecebeCNPJ,4-1,1)); 
$Numero[5]=intval(substr($RecebeCNPJ,5-1,1)); 
$Numero[6]=intval(substr($RecebeCNPJ,6-1,1)); 
$Numero[7]=intval(substr($RecebeCNPJ,7-1,1)); 
$Numero[8]=intval(substr($RecebeCNPJ,8-1,1)); 
$Numero[9]=intval(substr($RecebeCNPJ,9-1,1)); 
$Numero[10]=intval(substr($RecebeCNPJ,10-1,1)); 
$Numero[11]=intval(substr($RecebeCNPJ,11-1,1)); 
$Numero[12]=intval(substr($RecebeCNPJ,12-1,1)); 
$Numero[13]=intval(substr($RecebeCNPJ,13-1,1)); 
$Numero[14]=intval(substr($RecebeCNPJ,14-1,1)); 

$soma=$Numero[1]*5+$Numero[2]*4+$Numero[3]*3+$Numero[4]*2+$Numero[5]*9+$Numero[6]*8+$Numero[7]*7+ 
$Numero[8]*6+$Numero[9]*5+$Numero[10]*4+$Numero[11]*3+$Numero[12]*2; 

$soma=$soma-(11*(intval($soma/11))); 

if ($soma==0 || $soma==1) 
{ 
$resultado1=0; 
}else{ 
$resultado1=11-$soma; 
} 

if ($resultado1==$Numero[13]) 
{ 
$soma=$Numero[1]*6+$Numero[2]*5+$Numero[3]*4+$Numero[4]*3+$Numero[5]*2+$Numero[6]*9+ 
$Numero[7]*8+$Numero[8]*7+$Numero[9]*6+$Numero[10]*5+$Numero[11]*4+$Numero[12]*3+$Numero[13]*2; 
$soma=$soma-(11*(intval($soma/11))); 
if ($soma==0 || $soma==1) 
{ 
$resultado2=0; 
}else{ 
$resultado2=11-$soma; 
} 

if ($resultado2==$Numero[14]) 
{ 
return TRUE; 
}else{ 
return FALSE; 
} 
}else{ 
return FALSE; 
} 
} 
} 
//Fim do validar CNPJ 
//*
//*-----------------------------------------------------------------------------------*
//*   ROTINA DE ENCRIPTACAO 
//*

function Randomizar($iv_len)
{
    $iv = '';
    while ($iv_len-- > 0) {
        $iv .= chr(mt_rand() & 0xff);
    }
    return $iv;
}

function Encriptar($texto, $senha, $iv_len = 16)
{
    $texto .= "\x13";
    $n = strlen($texto);
    if ($n % 16) $texto .= str_repeat("\0", 16 - ($n % 16));
    $i = 0;
    $Enc_Texto = Randomizar($iv_len);
    $iv = substr($senha ^ $Enc_Texto, 0, 512);
    while ($i < $n) {
        $Bloco = substr($texto, $i, 16) ^ pack('H*', md5($iv));
        $Enc_Texto .= $Bloco;
        $iv = substr($Bloco . $iv, 0, 512) ^ $senha;
        $i += 16;
    }
    return base64_encode($Enc_Texto);
}

function Desencriptar($Enc_Texto, $senha, $iv_len = 16)
{
    $Enc_Texto = base64_decode($Enc_Texto);
    $n = strlen($Enc_Texto);
    $i = $iv_len;
    $texto = '';
    $iv = substr($senha ^ substr($Enc_Texto, 0, $iv_len), 0, 512);
    while ($i < $n) {
        $Bloco = substr($Enc_Texto, $i, 16);
        $texto .= $Bloco ^ pack('H*', md5($iv));
        $iv = substr($Bloco . $iv, 0, 512) ^ $senha;
        $i += 16;
    }
    return preg_replace('/\\x13\\x00*$/', '', $texto);
}

?>
