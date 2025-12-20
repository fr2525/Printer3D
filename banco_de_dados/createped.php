<?php
session_start();
include_once 'conexao.php';
include_once '../valida.php';
/*
id_cliente
descricao varchar(250) 
preco float 
quantidade int 
total_venda float 
status int 
dataCompra date 
dataPrevisao date 
dataFinaliza date 
dataEntrega date 
operador int 
datatual
*/
// $id_cli  = filter_input(INPUT_POST, 'id_cli',FILTER_SANITIZE_NUMBER_INT);
$id_cli  = filter_input(INPUT_POST, 'nomecli', FILTER_SANITIZE_NUMBER_INT);
$descricao  = filter_input(INPUT_POST, 'projeto', FILTER_SANITIZE_SPECIAL_CHARS);
$preco    = filter_input(INPUT_POST, 'preco');
$quantidade  = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT);
$total_venda  = filter_input(INPUT_POST, 'total_venda');
$dataCompra  = filter_input(INPUT_POST, 'datacompra');
$dataprevisao  = filter_input(INPUT_POST, 'dataprevisao');
$id_impres = filter_input(INPUT_POST, 'id_impres', FILTER_SANITIZE_NUMBER_INT);
//data_user_para_mysql

echo "id_impres = " . $id_impres;
exit();

$_SESSION['descricao'] = $descricao;
$_SESSION['preco'] = $preco;
$_SESSION['quantidade'] = $quantidade;
$_SESSION['total_venda'] = $total_venda;
$_SESSION['datacompra'] = $dataCompra;
$_SESSION['dataprevisao'] = $dataPrevisao;
$_SESSION['id_impres'] = $id_impres;

    $str_sql = "insert into tb_pedidos (id_cliente,descricao,id_usuario,preco,quantidade,total_venda, status, datacompra,dataprevisao) 
                                 values ( $id_cli,'$descricao',1,$preco,$quantidade,$total_venda, 1,'$dataCompra','$dataPrevisao')";

//    echo "sql = " . $str_sql;
//    exit();

    $queryInsert = $link->query($str_sql);
    $affected_rows = mysqli_affected_rows($link);

    if ($affected_rows > 0) :
        $_SESSION['msg'] = "<h5><p class='center green-text'>" . "Cadastro efetuado com sucesso" . "</p></h5>";
        header("Location:../public/lista_pedidos.php");
        session_unset();
    endif;

