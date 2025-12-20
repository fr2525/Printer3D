<?php include_once('../includes/header.inc.php')
?>

<?php include_once('../includes/menu.inc.php')

    // 038.934.691/0001-73  - CNPJ
    // 570.341.928-04 - CPF
?>

<div class="row container">
    <div class="col s12">
        <div class="col s9" style="text-align: left;">
            <h5 class="light">Lista de Clientes</h5>
        </div>
        <div class="col s3" style="padding: 15px 0px 0px 0px;">
            <a href="novocli.php" class="waves-effect waves-light btn-large right">Novo</a>
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
                    <th>CPF/CNPJ</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Ações</th>

                </tr>
            </thead>
            <tbody>
                <?php include_once('../banco_de_dados/readcli.php'); ?>
            </tbody>
        </table>
    </div>

</div>

<?php include_once('../includes/footer.inc.php')
?>