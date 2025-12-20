<?php
session_start();
include_once 'conexao.php';

$cpf  = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_NUMBER_INT);
$nome    = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email   = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
$celular  = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS);

$querySelect = $link->query("SELECT cpf from tb_clientes where cpf = '$cpf'");

$affected_rows = mysqli_affected_rows($link);

if ($affected_rows > 0 ):
    $_SESSION['msg'] = "<p class='center red-text'>" . "Cliente j? cadastrado com esse CPF" . "</p>";
    header("Location: ../consultas.php");
else :
    //$affected_rows = 0;
    $str_sql = "insert into tb_clientes (cpf,nome,email,celular) 
                                 values ( $cpf,'$nome', '$email','$celular')";
    
    $queryInsert = $link->query($str_sql);
    $affected_rows = mysqli_affected_rows($link);
    if ($affected_rows > 0) :
        $_SESSION['msg'] = "<p class='center green-text'>" . "Cadastro efetuado com sucesso" . "</p>";
        header("Location:../");
    endif;
endif;
