<?php
/**
* Sistema de segurança com acesso restrito
*
* Usado para restringir o acesso de certas páginas do seu site
*
* @author Thiago Belem <contato@thiagobelem.net>
* @link http://thiagobelem.net/
*
* @version 1.0
* @package SistemaSeguranca
*/
require_once 'config/conexao.class.php';
require_once 'config/funcoes.php';

//  Configurações do Script
// ==============================
$_SG['conectaServidor'] = false;    // Abre uma conex�o com o servidor MySQL?
$_SG['abreSessao'] = true;         // Inicia a sess�o com um session_start()?

$_SG['caseSensitive'] = false;     // Usar case-sensitive? Onde 'thiago' � diferente de 'THIAGO'

$_SG['validaSempre'] = true;       // Deseja validar o usu�rio e a senha a cada carregamento de p�gina?
// Evita que, ao mudar os dados do usu�rio no banco de dado o mesmo contiue logado.

$_SG['servidor'] = 'localhost';    // Servidor MySQL
$_SG['usuario'] = 'root';          // Usuario MySQL
$_SG['senha'] = 'oyster';                // Senha MySQL
$_SG['banco'] = 'db_printer3d';            // Banco de dados MySQL

$_SG['paginaLogin'] = 'login.php'; // Pagina de login

$_SG['tabela'] = 'tb_usuarios';       // Nome da tabela onde os usuarios sao salvos
// ==============================

// ======================================
//   ~ N�o edite a partir deste ponto ~
// ======================================

// Verifica se precisa fazer a conex�o com o MySQL
if ($_SG['conectaServidor'] == true)
{
	$_SG['link'] = mysql_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha']) or die("MySQL: N�o foi poss�vel conectar-se ao servidor [".$_SG['servidor']."].");
	mysql_select_db($_SG['banco'], $_SG['link']) or die("MySQL: N�o foi poss�vel conectar-se ao banco de dados [".$_SG['banco']."].");
}
// Verifica se precisa iniciar a sess�o
if ($_SG['abreSessao'] == true)
{
	session_start();
}

/**
* Fun��o que valida um usu�rio e senha
*
* @param string $usuario - O usu�rio a ser validado
* @param string $senha - A senha a ser validada
*
* @return bool - Se o usu�rio foi validado ou n�o (true/false)
*/
function validaUsuario($usuario, $senha)
{
	global $_SG;

	$cS = ($_SG['caseSensitive']) ? 'BINARY' : '';

	// Usa a fun��o addslashes para escapar as aspas
	$nusuario = addslashes($usuario);
	$nsenha = trim(addslashes($senha));
    $con = new conexao(); // instancia classe de conexao
    $con->connect(); // abre conexao com o banco

	// Monta uma consulta SQL (query) para procurar um usu�rio
	$sql = "SELECT id, name,userassembly,userkey FROM ".$_SG['tabela']."" .
			" WHERE ".$cS." userassembly = '".$nusuario."' LIMIT 1";
	//		"AND ".$cS." userkey = '".$nsenha."' LIMIT 1";

	$query = mysql_query($sql);

	if (mysql_num_rows($query) == 0)
	{
		// Nenhum registro foi encontrado => o usu�rio � inv�lido
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
		// O registro foi encontrado => o usu�rio � valido

		// Definimos dois valores na sess�o com os dados do usu�rio
		$_SESSION['usuarioID'] = $resultado['id']; // Pega o valor da coluna 'id do registro encontrado no MySQL
		$_SESSION['usuarioNome'] = $resultado['userassembly']; // Pega o valor da coluna 'username' do registro encontrado no MySQL

		// Verifica a op��o se sempre validar o login
		if ($_SG['validaSempre'] == true)
		{
			// Definimos dois valores na sess�o com os dados do login
			$_SESSION['usuarioLogin'] = $usuario;
			$_SESSION['usuarioSenha'] = $senha;
		}

		   return true;
	}
    return false;
}

/**
* Fun��o que protege uma p�gina
*/
function protegePagina()
{
	global $_SG;
	echo($_SESSION['usuarioID']);

	if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome']))
	{
		// N�o h� usu�rio logado, manda pra p�gina de login
		expulsaVisitante();
	}
	else if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome']))
	{
		// H� usu�rio logado, verifica se precisa validar o login novamente
		echo("ELSE IF");

		if ($_SG['validaSempre'] == true)
		{
			echo("Validasempre = true");
			// Verifica se os dados salvos na sess�o batem com os dados do banco de dados
			if (!validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']))
			{
				// Os dados n�o batem, manda pra tela de login
				expulsaVisitante();
			}
		}
	}
}

/**
* Fun��o para expulsar um visitante
*/
function expulsaVisitante()
{
	global $_SG;

	// Remove as vari�veis da sess�o (caso elas existam)
	unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);

	// Manda pra tela de login
	header("Location: ".$_SG['paginaLogin']);
}
?>