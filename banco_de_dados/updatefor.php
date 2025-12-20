<?php
session_start();
include_once 'conexao.php';

$id = $_SESSION['id'];

$cpf_cnpj  = filter_input(INPUT_POST, 'cpf_cnpj', FILTER_SANITIZE_SPECIAL_CHARS);
$nome    = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$endereco    = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS);
$email   = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
$celular  = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS);

$queryUpdate = $link->query("update tb_fornecedores SET cpf_cnpj = '$cpf_cnpj'
                                                    ,nome ='$nome'
                                                    ,endereco = '$endereco'
                                                    ,email = '$email'
                                                    ,celular = '$celular'
                                                    WHERE id = '$id'");
$affected_rows = mysqli_affected_rows($link);

if ($affected_rows > 0 ):
    header("Location: ../public/lista_fornece.php");
endif;    

?>

