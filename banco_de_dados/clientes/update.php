<?php
session_start();
include_once 'conexao.php';

$id = $_SESSION['id'];

$cpf  = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_NUMBER_INT);
$nome    = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email   = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
$celular  = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS);

$queryUpdate = $link->query("update tb_clientes SET cpf = '$cpf'
                                                    ,nome ='$nome'
                                                    ,email = '$email'
                                                    ,celular = '$celular'
                                                    WHERE id = '$id'");
$affected_rows = mysqli_affected_rows($link);
if ($affected_rows > 0 ):
    header("Location: ../consultas.php");
endif;    

?>

