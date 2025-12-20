<?php
session_start();
include_once 'conexao.php';

// $operador = $_SESSION['operador'];

if (!isset($_SESSION['operador'])) {
    $operador = '1';
}
else {
    $operador = $_SESSION['operador'];
    }

$id = $_SESSION['id'];

$nome    = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$login  = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
$senha   = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
$confsenha   = filter_input(INPUT_POST, 'confsenha', FILTER_SANITIZE_SPECIAL_CHARS);
$email   = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$celular  = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS);
$id_nivel = filter_input(INPUT_POST, 'nivel');
$ativo = filter_input(INPUT_POST, 'ativo');

$_SESSION['nome'] = $nome;
$_SESSION['login'] = $login;
$_SESSION['email'] = $email;
$_SESSION['celular'] = $celular;
$_SESSION['senha'] = $senha;
$_SESSION['confsenha'] = $confsenha;
$_SESSION['nivel'] = $id_nivel;
$_SESSION['ativo'] = $ativo;

$datatual = date("Y-m-d H:i:s");

$str_sql = "update tb_usuarios SET nome ='$nome', login = '$login', senha = '$senha', email = '$email'
                                                    , celular = '$celular', nivel = '$id_nivel', ativo = '$ativo'
                                                    , operador = '$operador', datatual = ' $datatual' 
                                                    WHERE id = '$id'";
//echo "str_sql =>" . $str_sql;
//exit();
$queryUpdate = $link->query($str_sql);
$affected_rows = mysqli_affected_rows($link);


if ($affected_rows > 0):
    header("Location: ../public/admin.php");
endif;
