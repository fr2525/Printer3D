<?php session_start()  ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include_once('../includes/header.inc.php');
include_once('../includes/menu.inc.php');

if (isset($_SESSION['cpf_cnpj'])) :
    $cpf_cnpj = $_SESSION['cpf_cnpj'];
else :
    $cpf_cnpj = "";    
endif;

if (isset($_SESSION['nome'])) :
    $nome = $_SESSION['nome'];
else :
    $nome = "";    
endif;
if (isset($_SESSION['endereco'])) :
    $endereco = $_SESSION['endereco'];
else :
    $endereco = "";    
endif;
if (isset($_SESSION['email'])) :
    $email = $_SESSION['email'];
else :
    $email = "";    
endif;
if (isset($_SESSION['celular'])) :
    $celular = $_SESSION['celular'];
else :
    $celular = "";    
endif;

?>

<div class="row container">
    <form action="../banco_de_dados/createfor.php" id="formFornece" method="post" class="col s12">
        <fieldset class="formulario" style="padding: 15px">
           <!-- <legend><img src="imagens/avatar-1.png" width="50"></legend>  -->
            <h5 class="light center">Cadastro de Fornecedores</h5>

            <?php
            if (isset($_SESSION['msg'])) :
                echo $_SESSION['msg'];
                session_unset();
            endif;
            ?>

            <div class="row">
                <!-- Campo CPF -->
                <div class="input-field col s3">
                    <i class="material-icons prefix">fingerprint</i>
                    <input type="text" name="cpf_cnpj" value="<?php echo $cpf_cnpj ?>" id="cpf_cnpj" maxlength="20" required="" autofocus>
                    <label for="cpf_cnpj">CPF/CNPJ</label>
                </div>

                <!-- Campo Nome -->
                <div class="input-field col s9">
                    <i class="material-icons prefix">account_circle</i>
                    <input type="text" name="nome" value="<?php echo $nome ?>" id="nome" maxlength="40" required="" autofocus>
                    <label for="nome">Nome do fornecedor</label>
                </div>
                
            </div>

            <div class="row">
                <!-- Campo email -->
                <div class="input-field col s12">
                    <i class="material-icons prefix">email</i>
                    <input type="text" name="email" value="<?php echo $email ?>" id="email" maxlength="100" required="">
                    <label for="email">E-mail</label>
                </div>
            </div>

            <div class="row">
                <!-- Campo endereço -->
                <div class="input-field col s12">
                    <i class="material-icons prefix">email</i>
                    <input type="text" name="endereco" value="<?php echo $endereco ?>" id="endereco" maxlength="100" >
                    <label for="endereco">Endereco</label>
                </div>
            </div>

            <div class="row">
                <!-- Campo Celular -->
                <div class="input-field col s6">
                    <i class="material-icons prefix"></i>
                    <input type="text" name="celular" value="<?php echo $celular ?>" id="celular" maxlength="20">
                    <label for="celular">Tel.Celular</label>
                </div>
            </div>    

            <!-- Botões -->
            <div class="input-field col s12">
                <input type="submit" value="Cadastrar" class="btn blue">&nbsp&nbsp
                <input type="button" value="Limpar" onclick="resetar()" class="btn red">&nbsp&nbsp
                <a href="lista_fornece.php" class="btn purple">Voltar</a>
            </div>

        </fieldset>
    </form>
</div>

<script>

function resetar() {
   var form   = document.getElementById("formFornece");
   var cpf_cnpj   = form.cpf_cnpj.value;

   var set = confirm("Deseja apagar os dados do formulário?");
   if (set) {
      //alert('Os campos do formulário foram resetados!');
      form.reset();
      form.cpf_cnpj.focus();
   }
}
</script>

<?php include_once('../includes/footer.inc.php');
?>
