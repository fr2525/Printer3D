<?php
session_start();
include_once 'conexao.php';
include_once '../valida.php';

$marca  = filter_input(INPUT_POST, 'marca', FILTER_SANITIZE_SPECIAL_CHARS);
$modelo    = filter_input(INPUT_POST, 'modelo', FILTER_SANITIZE_SPECIAL_CHARS);
$qtrolos  = filter_input(INPUT_POST, 'rolos', FILTER_SANITIZE_NUMBER_INT);

$_SESSION['marca'] = $marca;
$_SESSION['modelo'] = $modelo;
$_SESSION['qtrolos'] = $qtrolos;

$str_sql = "insert into tb_impressoras (marca,modelo,qtrolos, ocupada) 
                                 values ( '$marca','$modelo', '$qtrolos','NÃO')";
//echo ($str_sql);
//exit();
$queryInsert = $link->query($str_sql);
$affected_rows = mysqli_affected_rows($link);

if ($affected_rows > 0) :
    $_SESSION['msg'] = "<h5><p class='center green-text'>" . "Cadastro efetuado com sucesso" . "</p></h5>";
    header("Location:../public/lista_impressoras.php");
    session_unset();
endif;

