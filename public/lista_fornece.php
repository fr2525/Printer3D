<?php include_once('../includes/header.inc.php')
?>

<?php include_once('../includes/menu.inc.php')
?>

<div class="row container">
  <div class="col s12">
    <div class="col s9" style="text-align: left;">
      <h5 class="light">Lista de Fornecedores</h5>
    </div>
    <div class="col s3" style="padding: 15px 0px 0px 0px;">
      <a href="novofor.php" class="waves-effect waves-light btn-large right">Novo</a>
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
          <th>Endereço</th>
          <th>Email</th>
          <th>Celular</th>
          <th>Ações</th>


        </tr>
      </thead>
      <tbody>
        <?php include_once('../banco_de_dados/readfor.php'); ?>
      </tbody>
    </table>
  </div>
</div>

<?php include_once('../includes/footer.inc.php')
?>