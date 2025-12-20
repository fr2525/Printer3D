<?php
session_start();
include_once 'conexao.php';
 
/*
    $marca
    $tipo
    $cor
    $qtde_estoque 
    $valor 
  
*/

$id = $_SESSION['id'];

$marca  = filter_input(INPUT_POST, 'marca', FILTER_SANITIZE_SPECIAL_CHARS);
$tipo    = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
$cor   = filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_SPECIAL_CHARS);
$qtde_estoque  = filter_input(INPUT_POST, 'qtde_estoque', FILTER_SANITIZE_SPECIAL_CHARS);
$valor = filter_input(INPUT_POST, 'valor',  FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

$sql = "update tb_filamentos SET marca = '$marca' ,tipo ='$tipo',cor = '$cor'
                                                    ,qtde_estoque = '$qtde_estoque'
                                                    ,valor = '$valor'
                                                    WHERE id = '$id'";


$queryUpdate = $link->query($sql);
$affected_rows = mysqli_affected_rows($link);

if ($affected_rows > 0 ):
    header("Location: ../public/lista_filamentos.php");
endif;    

?>

