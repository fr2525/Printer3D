<?php
session_start();
include_once 'conexao.php';

$id = $_SESSION['id'];

$cpf_cnpj  = filter_input(INPUT_POST, 'cpf_cnpj', FILTER_SANITIZE_SPECIAL_CHARS);
$nome    = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email   = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
$celular  = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS);
$str_sql = "update tb_clientes SET cpf_cnpj = '$cpf_cnpj',nome ='$nome',email = '$email'
                                    ,celular = '$celular'
                                    WHERE id = '$id'";

$queryUpdate = $link->query($str_sql);
$affected_rows = mysqli_affected_rows($link);
//echo 'affected_rows = ' . $affected_rows;
//exit();
//if ($affected_rows > 0 ):
    header("Location: ../public/lista_clientes.php");
//endif;    

?>

