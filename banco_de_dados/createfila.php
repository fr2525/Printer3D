<?php
session_start();
include_once 'conexao.php';
include_once '../valida.php';

$marca  = filter_input(INPUT_POST, 'marca', FILTER_SANITIZE_SPECIAL_CHARS);
$tipo    = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
$cor   = filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_SPECIAL_CHARS);
$qtde_estoque  = filter_input(INPUT_POST, 'qtde_estoque', FILTER_SANITIZE_NUMBER_INT);
$valor  = number_format(filter_input(INPUT_POST, 'valor'), 2, '.', ',');

$_SESSION['marca'] = $marca;
$_SESSION['tipo'] = $tipo;
$_SESSION['cor'] = $cor;
$_SESSION['qtde_estoque'] = $qtde_estoque;
$_SESSION['valor'] = $valor;

    $str_sql = "insert into tb_filamentos (marca,tipo,cor,qtde_estoque, valor) 
                                 values ( '$marca','$tipo', '$cor','$qtde_estoque', '$valor')";
  
    $queryInsert = $link->query($str_sql);
    $affected_rows = mysqli_affected_rows($link);

    if ($affected_rows > 0) :
        $_SESSION['msg'] = "<h5><p class='center green-text'>" . "Cadastro efetuado com sucesso" . "</p></h5>";
        header("Location:../public/lista_filamentos.php");
        session_unset();
    endif;

