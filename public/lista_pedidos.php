<?php include_once('../includes/header.inc.php')
?>

<?php include_once('../includes/menu.inc.php')


/* SELECT id_venda
        ,id_cliente
        ,id_usuario
        ,descricao
        ,qtde
        ,preco
        ,total_venda
        ,status
        ,data_Compra
        ,data_prevista
        ,data_Finaliza
        ,data_entrega 
    FROM `tb_pedidos`
*/

?>

<div class="row container">
    <div class="col s12">
        <div class="col s9" style="text-align: left;">
            <h5 class="light">Pedidos</h5>
        </div>
        <div class="col s3" style="padding: 15px 0px 0px 0px;">
            <a href="novoPedido.php" class="waves-effect waves-light btn-large right">Novo</a>
        </div>

    </div>
    <div class="col s12">
        <br>
        <hr>
    </div>
    <div class="col s12">
        <table class="striped">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Projeto</th>
                    <th  style='text-align: right'>Quantidade</th>
                    <th  style='text-align: right'>Preço Unit.</th>
                    <th  style='text-align: right'>Valor Total</th>
                    <th>Dta.Compra</th>
                    <th>Dta.Prevista</th>
                    <th>Status</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php include_once('../banco_de_dados/readpedido.php'); ?>
            </tbody>
        </table>
    </div>
</div>

</div>

<?php include_once('../includes/footer.inc.php')
?>