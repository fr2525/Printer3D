<?php
// Inclui o arquivo com o sistema de seguranca

//require_once "seguranca.php";
/*
function veSenha()
{
	// Verifica se um formulário foi enviado
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// Salva duas variaveis com o que foi digitado no formulario
		// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
		$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
		$senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
		// Utiliza uma função criada no seguranca.php pra validar os dados digitados
		if (validaUsuario($usuario, $senha) == true) {
			// O usuario e a senha digitados foram validados, manda pra p�gina interna
			header("Location: ./public/index.php");
		} else {
			// O usuario e/ou a senha sao invalidos, manda de volta pro form de login
			// Para alterar o endereço da pagina de login, verifique o arquivo seguranca.php
			expulsaVisitante();
		}
	}
}

*/
function ValidaCelular($telefone)
{
	$telefone = trim(str_replace('/', '', str_replace(' ', '', str_replace('-', '', str_replace(')', '', str_replace('(', '', $telefone))))));
	if (preg_match("/\(?\d{2}\)?\s?\d{5}\-?\d{4}/", $telefone)) {
		// o telefone é válido
		return true;
	} else {
		return false;
	}
}

function validaCPF($cpf_cnpj)
{

	// Extrai somente os números
	$cpf = preg_replace('/[^0-9]/is', '', $cpf_cnpj);

	// Verifica se tem 11 dígitos
	if (strlen($cpf) != 11) {
		return false;
	}

	// Verifica se todos os dígitos são iguais (ex: 111.111.111-11)
	if (preg_match('/(\d)\1{10}/', $cpf)) {
		return false;
	}

	// Calcula e verifica o primeiro dígito verificador
	for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--) {
		$soma += $cpf[$i] * $j;
	}
	$resto = $soma % 11;
	if ($cpf[9] != ($resto < 2 ? 0 : 11 - $resto)) {
		return false;
	}

	// Calcula e verifica o segundo dígito verificador
	for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--) {
		$soma += $cpf[$i] * $j;
	}
	$resto = $soma % 11;
	if ($cpf[10] != ($resto < 2 ? 0 : 11 - $resto)) {
		return false;
	}

	return true;
}

/*
Utilização:
Validar data no formato brasileiro (dd/mm/yyyy):
valida_data('27/07/2009', 'pt');
Validar data no formato inglês (yyyy-mm-dd):
valida_data('2009-07-27', 'en');
*/
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


// 6- CONVERTER DATA BRASILEIRA (dd/mm/YYY) PARA PADRAO DO BANCO DE DADOS
function data_user_para_mysql($y)
{

	if (isset($y) && !empty($y)) {
	} else {
		$y = date("d/m/Y");

	}
	$data_inverter = explode("/", $y);
	$x = $data_inverter[2] . '-' . $data_inverter[1] . '-' . $data_inverter[0];
	return $x;
}
/*
Utiliza��o:
data_user_para_mysql('11/02/1992')

Resultado: 1992-02-11
*/
// 7- CONVERTER DATA DO BANCO DE DADOS PARA DATA BRASILEIRA
/*
Utilização:
data_mysql_para_user('1992-02-11')

Resultado: 11/02/1992
*/
/* Para criar os selects na pagina HTML
 */
function data_mysql_para_user($y)
{
	if ($y != '') {
		$x = substr($y, 8, 2) . "/" . substr($y, 5, 2) . "/" . substr($y, 0, 4);

		return $x;
	} else {
		return '';
	}
}
