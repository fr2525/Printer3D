<?php
session_start();
include_once 'conexao.php';

// $operador = $_SESSION['operador'];

if (!isset($_SESSION['operador'])) {
    $operador = '1';
} else {
    $operador = $_SESSION['operador'];
}

$id_venda = $_SESSION['id'];

$id_cliente    = filter_input(INPUT_POST, 'id-cliente', FILTER_SANITIZE_SPECIAL_CHARS);
$descricao  = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
$preco   = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT);
$quantidade   = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT);
$total_venda   = filter_input(INPUT_POST, 'total_venda', FILTER_SANITIZE_NUMBER_FLOAT);
$situacao  = filter_input(INPUT_POST, 'situacao');
$datacompra  = filter_input(INPUT_POST, 'datacompra', FILTER_SANITIZE_SPECIAL_CHARS);
$dataprevisao  = filter_input(INPUT_POST, 'dataprevisao', FILTER_SANITIZE_SPECIAL_CHARS);

$datatual = date("Y-m-d H:i:s");

$str_sql = "update tb_pedidos SET descricao ='$descricao',preco = '$preco ', quantidade = '$quantidade', total_venda = '$total_venda'
                                                    , status = '$situacao', datacompra = '$datacompra', dataprevisao = '$dataprevisao'
                                                    , operador = '$operador', datatual = ' $datatual' 
                                                    WHERE id_venda = '$id_venda'";
//echo "str_sql =>" . $str_sql;
//exit();
$queryUpdate = $link->query($str_sql);
$affected_rows = mysqli_affected_rows($link);

// Verifica se a variável 'impres' foi enviada e se o usuário selecionou algum item
if (isset($_POST['impres'])) {
    // echo "As impressoras selecionadas são:<br>";
    // apaga os registros de impressora X pedido da tabela pois pode ser que o usuario escolheu outra impressora
    $str_sql = "delete tb_pedximpres WHERE id_pedido = '$id_venda'";
    //echo "str_sql =>" . $str_sql;
    //exit();
    $queryDelete = $link->query($str_sql);
    $affected_rows = mysqli_affected_rows($link);
    // Loop para percorrer cada item selecionado
    foreach ($_POST['impres'] as $impres) {
        $str_sql = "update tb_impressoras SET ocupada ='S', operador = '$operador', datatual = ' $datatual' 
                                                    WHERE id = '$impres'";
        //echo "str_sql =>" . $str_sql;
        //exit();
        $queryUpdate = $link->query($str_sql);
        $affected_rows = mysqli_affected_rows($link);
        // Agora vai atualizar as tabelas pedXimpres 
        $str_sql = "insert into tb_pedximpres (id_pedido,id_impressora) values ( $id_venda,$id_impres)";
        //    echo "sql = " . $str_sql;
        //    exit();
        $queryInsert = $link->query($str_sql);
        $affected_rows = mysqli_affected_rows($link);
        //        echo "- " . $impres . "<br>";
    }
} else {
    //    echo "Você não escolheu nenhuma impressora!";
}
exit();

if ($affected_rows > 0):
    header("Location: ../public/admin.php");
endif;
