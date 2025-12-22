<?php
include_once 'conexao.php';
include_once "../valida.php";

$sql = " SELECT id_venda,a.id_cliente, b.nome, id_usuario,a.descricao,quantidade,preco,total_venda
        ,status,c.descricao as situacao,datacompra,dataprevisao,datafinaliza,dataentrega  FROM tb_pedidos a , tb_clientes b, tb_status c
        where a.id_cliente = b.id 
        and a.status = c.id_status";

$querySelect = $link->query($sql);

while ($registros = $querySelect->fetch_assoc()):
    $id_venda  = $registros['id_venda'];
    $id_cliente  = $registros['id_cliente'];
    $nome  = $registros['nome'];
    $id_usuario  = $registros['id_usuario'];
    $descricao  = $registros['descricao'];
    $quantidade  = $registros['quantidade'];
    $preco  = $registros['preco'];
    $total_venda = $registros['total_venda'];
    $status  = $registros['status'];
    $situacao  = $registros['situacao'];
    $datacompra   = data_mysql_para_user($registros['datacompra']);
    $dataprevisao  = data_mysql_para_user($registros['dataprevisao']);
    //   $data_finaliza  = $registros['data_finaliza'];
    //   $data_entrega   = $registros['data_entrega'];

    echo "<tr>";
    echo "<td>$nome</td>";
    echo "<td>$descricao</td>";
    echo "<td style='text-align: right'>$quantidade</td>";
    echo "<td style='text-align: right'>$preco</td>";
    echo "<td style='text-align: right'>$total_venda</td>";
    echo "<td style='text-align: center'>$datacompra</td>";
    echo "<td style='text-align: center'>$dataprevisao</td>";
    echo '<td><select name="situacao" id="situacao" onchange="changeFunc(this.value)">';
    echo '<option disabled>Situação </option>';
        $queryS = $link->query("select id_status, descricao from tb_status");
        while ($situacoes = $queryS->fetch_assoc()) :
               $id_status = $situacoes['id_status'];
               $descricao = $situacoes['descricao'];
               if ($id_status == $status) {
                    echo '<option selected value=' . $id_status . '>' . $descricao . '</option>'; 
               } else {
                    echo '<option value=' . $id_status . '>' . $descricao . '</option>';
               }
                
        endwhile;
    echo '</select>';
    echo '<label for="situacao">Situação</label>';
    echo '</td>';
      
    echo "<td><a href='editarpedido.php?id=$id_venda'><i class='material-icons'>&nbsp&nbspedit</i></td>";
    echo "<td><a href='banco_de_dados/deleteped.php?id=";
    echo $id_venda . "&tabela=tb_pedidos&retorno=lista_pedidos.php' ";
    echo ' OnClick="javascript:return confirm(\'Deseja mesmo excluir o pedido \n no.: ' . $id_venda . '?\');">';
    echo "<i class='material-icons'>&nbsp&nbspdelete</i>";
      
endwhile;
?>
<script language="javascript">
function changeFunc(selectedValue) {
    alert("The selected value is: " + selectedValue);
    // You can add more code here to perform other actions
}
</script>