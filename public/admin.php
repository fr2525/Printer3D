<?php include_once('../includes/header.inc.php')
?>

<?php include_once('../includes/menu.inc.php')

// id,nome,usuario,senha,celular,nivel,comissao,salario
?>

<div class="row container">
    <div class="col s12">
        <div class="col s9" style="text-align: left;">
            <h5 class="light">Lista de Usuários</h5>    
        </div>
        <div class="col s3" style="padding: 15px 0px 0px 0px;">
            <a href="novousu.php" class="waves-effect waves-light btn-large right">Novo</a>
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
                    <th>Nome</th>
                    <th>Usuario</th>
                    <th>e-mail</th>
                    <th>Celular</th>
                    <th>Nível</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php include_once('../banco_de_dados/readUsu.php'); ?>
            </tbody>
        </table>
    </div>

</div>

<?php include_once('../includes/footer.inc.php')
?>