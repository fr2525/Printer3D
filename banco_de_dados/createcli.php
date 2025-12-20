<?php
session_start();
include_once 'conexao.php';
include_once '../valida.php';

$cpf_cnpj  = filter_input(INPUT_POST, 'cpf_cnpj', FILTER_SANITIZE_NUMBER_INT);
$nome    = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email   = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$celular  = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS);

$_SESSION['nome'] = $nome;
$_SESSION['email'] = $email;
$_SESSION['celular'] = $celular;


$_SESSION['cpf_cnpj'] = $cpf_cnpj;

/*
if(validaCPF($cpf_cnpj) == false) :
    $_SESSION['msg'] = "<h5><p class='center red-text'>" . "CPF inválido" . "</p></h5>";
    header("Location: ../novocli.php");
    exit;
endif;
*/

if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    $_SESSION['msg'] = "<h5><p class='center red-text'>" . "e-mail é inválido." . "</p></h5>";
    header("Location: ../novocli.php");
    exit;
}

if(validaCelular($celular) == false) :
    $_SESSION['msg'] = "<h5><p class='center red-text'>" . "Número de telefone inválido" . "</p></h5>";
    header("Location: ../novocli.php");
    exit;
endif;

$querySelect = $link->query("SELECT cpf_cnpj from tb_clientes where cpf_cnpj = '$cpf_cnpj'");

$affected_rows = mysqli_affected_rows($link);

if ($affected_rows > 0 ):
    $_SESSION['msg'] = "<h5><p class='center red-text'>" . "Cliente já cadastrado com esse CPF" . "</p></h5>";
    header("Location: ../novocli.php");
else :
    //$affected_rows = 0;
    $str_sql = "insert into tb_clientes (cpf_cnpj,nome,email,celular) 
                                 values ( $cpf_cnpj,'$nome', '$email','$celular')";
    
    $queryInsert = $link->query($str_sql);
    $affected_rows = mysqli_affected_rows($link);
    if ($affected_rows > 0) :
        $_SESSION['msg'] = "<h5><p class='center green-text'>" . "Cadastro efetuado com sucesso" . "</p></h5>";
        header("Location:../public/lista_clientes.php");
        session_unset();
    endif;
endif;
