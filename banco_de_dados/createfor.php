<?php
session_start();
include_once 'conexao.php';
include_once '../valida.php';

$cpf_cnpj  = filter_input(INPUT_POST, 'cpf_cnpj',  FILTER_SANITIZE_SPECIAL_CHARS);
$nome    = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$endereco    = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS);
$email   = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$celular  = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS);

$_SESSION['cpf_cnpj'] = $cpf_cnpj;

$_SESSION['nome'] = $nome;
$_SESSION['endereco'] = $email;
$_SESSION['email'] = $email;
$_SESSION['celular'] = $celular;

/*
if(validaCPF($cpf) == false) :
    $_SESSION['msg'] = "<h5><p class='center red-text'>" . "CPF inválido" . "</p></h5>";
    header("Location: ../novocli.php");
    exit;
endif;
*/
if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    $_SESSION['msg'] = "<h5><p class='center red-text'>" . "e-mail é inválido." . "</p></h5>";
    header("Location: ../novofor.php");
    exit;
}
/*
if(validaCelular($celular) == false) :
    $_SESSION['msg'] = "<h5><p class='center red-text'>" . "Número de telefone inválido" . "</p></h5>";
    header("Location: ../novocli.php");
    exit;
endif;
*/
$querySelect = $link->query("SELECT cpf_cnpj from tb_fornecedores where cpf_cnpj = '$cpf_cnpj'");

$affected_rows = mysqli_affected_rows($link);

if ($affected_rows > 0 ):
    $_SESSION['msg'] = "<h5><p class='center red-text'>" . "Fornecedor já cadastrado com esse CPF/CNPJ" . "</p></h5>";
    header("Location: ../novofor.php");
else :
    //$affected_rows = 0;
    $str_sql = "insert into tb_fornecedores (cpf_cnpj,nome,endereco,email,celular) 
                                 values ( '$cpf_cnpj','$nome','$endereco', '$email','$celular')";
    
    $queryInsert = $link->query($str_sql);
    $affected_rows = mysqli_affected_rows($link);
    if ($affected_rows > 0) :
        $_SESSION['msg'] = "<h5><p class='center green-text'>" . "Cadastro efetuado com sucesso" . "</p></h5>";
        header("Location:../lista_fornece.php");
        session_unset();
    endif;
endif;
