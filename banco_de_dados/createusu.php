<?php
session_start();
include_once 'conexao.php';
include_once '../valida.php';

$nome    = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$login   = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
$email   = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS);
$senha   = filter_input(INPUT_POST,'senha');
$confsenha = filter_input(INPUT_POST,'confsenha');
$nivel   = filter_input(INPUT_POST,'nivel');
$ativo   = filter_input(INPUT_POST,'ativo');

$_SESSION['nome'] = $nome;
$_SESSION['login'] = $login;
$_SESSION['email'] = $email;
$_SESSION['celular'] = $celular;
$_SESSION['senha'] = $senha;
$_SESSION['confsenha'] = $confsenha;
$_SESSION['nivel'] = $nivel;
$_SESSION['ativo'] = $ativo;

if( $senha != $confsenha) {
    $_SESSION['msg'] = "<h5><p class='center red-text'>" . "As senhas não conferem. favor verificar" . "</p></h5>";
    header("Location: ../novousu.php");
    exit;
} 

if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    $_SESSION['msg'] = "<h5><p class='center red-text'>" . "e-mail é inválido." . "</p></h5>";
    header("Location: ../novousu.php");
    exit;
}

if(validaCelular($celular) == false) :
    $_SESSION['msg'] = "<h5><p class='center red-text'>" . "Número de telefone inválido" . "</p></h5>";
    header("Location: ../novousu.php");
    exit;
endif;

$querySelect = $link->query("SELECT login from tb_usuarios where login = '$login'");
$affected_rows = mysqli_affected_rows($link);
if ($affected_rows > 0 ):
    $_SESSION['msg'] = "<h5><p class='center red-text'>" . "Já cadastrado com esse login" . "</p></h5>";
    header("Location: ../novousu.php");
    exit();
endif;

$querySelect = $link->query("SELECT email from tb_usuarios where email = '$email'");
$affected_rows = mysqli_affected_rows($link);
if ($affected_rows > 0 ):
    $_SESSION['msg'] = "<h5><p class='center red-text'>" . "Usuário já cadastrado com esse email" . "</p></h5>";
    header("Location: ../novousu.php");
    exit();
endif;
    //$affected_rows = 0;
    $datatual = date("Y-m-d H:i:s");
    $str_sql = "insert into tb_usuarios (nome,login,email,senha,celular, nivel, ativo, operador, datatual) 
                 values ( '$nome', '$login','$email','$senha','$celular','$nivel',$ativo,'1','$datatual')";
   // echo $str_sql;
    //exit();
    $queryInsert = $link->query($str_sql);

    $affected_rows = mysqli_affected_rows($link);

    if ($affected_rows > 0) :
        $_SESSION['msg'] = "<h5><p class='center green-text'>" . "Cadastro efetuado com sucesso" . "</p></h5>";
        header("Location:../admin.php");
        session_unset();
    else:
        $_SESSION['msg'] = "<h5><p class='center green-text'>" . "Cadastro não efetuado" . "</p></h5>";
        header("Location:../admin.php");
        session_unset(); 
    endif;

