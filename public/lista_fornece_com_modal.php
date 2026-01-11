<?php include_once('../includes/header.inc.php')
?>

<?php include_once('../includes/menu.inc.php')
?>

<!-- Begin of Modal Structure -->
<div id="modal1" class="modal">
  <div class="modal-content">
    <h4>Modal Header</h4>
    <p>A bunch of text</p>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Gravar</a>
  </div>
</div>
<!-- End of Modal Structure -->

<div class="row container">
  <div class="col s12">
    <div class="col s9" style="text-align: left;">
      <h5 class="light">Lista de Fornecedores</h5>
    </div>
    <div class="col s3" style="padding: 15px 0px 0px 0px;">
      <!-- Modal Trigger -->
      <!--
        Source - https://stackoverflow.com/a/42086644
        Posted by Andreas Moldskred
        Retrieved 2025-12-22, License - CC BY-SA 3.0
      -->
      <!-- Modal Trigger -->
      <button data-target="modal1" class="btn modal-trigger right">Novo</button>
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
