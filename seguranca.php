<?php
/**
* Sistema de seguranчa com acesso restrito
*
* Usado para restringir o acesso de certas pсginas do seu site
*
* @author Thiago Belem <contato@thiagobelem.net>
* @link http://thiagobelem.net/
*
* @version 1.0
* @package SistemaSeguranca
*/
require_once 'config/conexao.class.php';
require_once 'config/funcoes.php';

//  Configuraчѕes do Script
// ==============================
$_SG['conectaServidor'] = false;    // Abre uma conexуo com o servidor MySQL?
$_SG['abreSessao'] = true;         // Inicia a sessуo com um session_start()?

$_SG['caseSensitive'] = false;     // Usar case-sensitive? Onde 'thiago' щ diferente de 'THIAGO'

$_SG['validaSempre'] = true;       // Deseja validar o usuсrio e a senha a cada carregamento de pсgina?
// Evita que, ao mudar os dados do usuсrio no banco de dado o mesmo contiue logado.

$_SG['servidor'] = 'localhost';    // Servidor MySQL
$_SG['usuario'] = 'root';          // Usuсrio MySQL
$_SG['senha'] = 'info1990';                // Senha MySQL
$_SG['banco'] = 'bdfieis';            // Banco de dados MySQL

$_SG['paginaLogin'] = 'login.php'; // Pсgina de login

$_SG['tabela'] = 'tab_assembly';       // Nome da tabela onde os usuсrios sуo salvos
// ==============================

// ======================================
//   ~ Nуo edite a partir deste ponto ~
// ======================================

// Verifica se precisa fazer a conexуo com o MySQL
if ($_SG['conectaServidor'] == true)
{
	$_SG['link'] = mysql_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha']) 
		or die("MySQL: Nуo foi possэvel conectar-se ao servidor [".$_SG['servidor']."].");
	mysql_select_db($_SG['banco'], $_SG['link']) 
		or die("MySQL: Nуo foi possэvel conectar-se ao banco de dados [".$_SG['banco']."].");
}
// Verifica se precisa iniciar a sessуo
if ($_SG['abreSessao'] == true)
{
	session_start();
}

/**
* Funчуo que valida um usuсrio e senha
*
* @param string $usuario - O usuсrio a ser validado
* @param string $senha - A senha a ser validada
*
* @return bool - Se o usuсrio foi validado ou nуo (true/false)
*/
function validaUsuario($usuario, $senha)
{
	global $_SG;

	$cS = ($_SG['caseSensitive']) ? 'BINARY' : '';

	// Usa a funчуo addslashes para escapar as aspas
	$nusuario = addslashes($usuario);
	$nsenha = trim(addslashes($senha));
    $con = new conexao(); // instancia classe de coenxao
    $con->connect(); // abre conexao com o banco

	// Monta uma consulta SQL (query) para procurar um usuсrio
	$sql = "SELECT id, name,userassembly,userkey FROM ".$_SG['tabela']."" .
			" WHERE ".$cS." userassembly = '".$nusuario."' LIMIT 1";
	//		"AND ".$cS." userkey = '".$nsenha."' LIMIT 1";

	$query = mysql_query($sql);

	if (mysql_num_rows($query) == 0)
	{
		// Nenhum registro foi encontrado => o usuсrio щ invсlido
		return false;
	}
	if (mysql_num_rows($query) > 1)
	{
		// Tem mais de um usuario com o mesmo nome
		return false;
	}

	$con->disconnect();
	while($resultado = mysql_fetch_assoc($query))
	{
		if(Desencriptar($resultado['userkey'],'infosis') == $nsenha)
		// O registro foi encontrado => o usuсrio щ valido

		// Definimos dois valores na sessуo com os dados do usuсrio
		$_SESSION['usuarioID'] = $resultado['id']; // Pega o valor da coluna 'id do registro encontrado no MySQL
		$_SESSION['usuarioNome'] = $resultado['userassembly']; // Pega o valor da coluna 'username' do registro encontrado no MySQL

		// Verifica a opчуo se sempre validar o login
		if ($_SG['validaSempre'] == true)
		{
			// Definimos dois valores na sessуo com os dados do login
			$_SESSION['usuarioLogin'] = $usuario;
			$_SESSION['usuarioSenha'] = $senha;
		}

		   return true;
	}
    return false;
}

/**
* Funчуo que protege uma pсgina
*/
function protegePagina()
{
	global $_SG;
	echo($_SESSION['usuarioID']);

	if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome']))
	{
		// Nуo hс usuсrio logado, manda pra pсgina de login
		expulsaVisitante();
	}
	else if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome']))
	{
		// Hс usuсrio logado, verifica se precisa validar o login novamente
		echo("ELSE IF");

		if ($_SG['validaSempre'] == true)
		{
			echo("Validasempre = true");
			// Verifica se os dados salvos na sessуo batem com os dados do banco de dados
			if (!validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']))
			{
				// Os dados nуo batem, manda pra tela de login
				expulsaVisitante();
			}
		}
	}
}

/**
* Funчуo para expulsar um visitante
*/
function expulsaVisitante()
{
	global $_SG;

	// Remove as variсveis da sessуo (caso elas existam)
	unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);

	// Manda pra tela de login
	header("Location: ".$_SG['paginaLogin']);
}
?>