<?php session_start()  ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include_once('../includes/header.inc.php');
include_once('../includes/menu.inc.php');


if (isset($_SESSION['marca'])) :
    $marca = $_SESSION['marca'];
else :
    $marca = "";
endif;
if (isset($_SESSION['tipo'])) :
    $tipo = $_SESSION['tipo'];
else :
    $tipo = "";
endif;
if (isset($_SESSION['cor'])) :
    $cor = $_SESSION['cor'];
else :
    $cor = "";
endif;
if (isset($_SESSION['qtde_estoque'])) :
    $qtde_estoque = $_SESSION['qtde_estoque'];
else :
    $qtde_estoque = "";
endif;

if (isset($_SESSION['valor'])) :
    $valor = floatval($_SESSION['valor']);
else :
    $valor = floatval(0);
endif;
?>

<div class="row container">
    <form action="../banco_de_dados/createfila.php" id="formFilamentos" method="post" class="col s12">
        <fieldset class="formulario" style="padding: 15px">
            <!--  <legend><img src="imagens/avatar-1.png" width="50"></legend>  -->
            <h5 class="light center">Cadastro de Filamentos</h5>

            <?php
            if (isset($_SESSION['msg'])) :
                echo $_SESSION['msg'];
                session_unset();
            endif;
            ?>

            <div class="row">
                <!-- Campo marca -->
                <div class="input-field col s12">
                    <input type="text" name="marca" value="<?php echo $marca ?>" id="marca" maxlength="100" required="" autofocus>
                    <label for="marca">Marca</label>
                </div>
            </div>

            <div class="row">
                <!-- Campo tipo -->
                <div class="input-field col s12">
                    <input type="text" name="tipo" value="<?php echo $tipo ?>" id="tipo" maxlength="100" required="" autofocus>
                    <label for="tipo">Tipo do filamento</label>
                </div>

            </div>

            <div class="row">
                <!-- Campo cor -->
                <div class="input-field col s4">
                    <input type="text" name="cor" value="<?php echo $cor ?>" id="cor" maxlength="50" required="">
                    <label for="cor">Cor</label>
                </div>

                <!-- Campo qtde -->
                <div class="input-field col s4">
                    <input type="text" name="qtde_estoque" value="<?php echo $qtde_estoque ?>" id="qtde_estoque" maxlength="10" required="">
                    <label for="qtde_estoque">Estoque</label>
                </div>
                <!-- Campo Preço -->
                <div class="input-field col s4">
                    <input type="text" name="valor" id="valor" maxlength="20" required=""
                        value="<?php echo number_format($valor, 2, ',', '.'); ?>" onblur="javascript:this.value=formataValor(this.value);">

                </div>
            </div>
            <!-- Botões -->
            <div class="input-field col s12">
                <input type="submit" value="Cadastrar" class="btn blue">&nbsp&nbsp
                <input type="button" value="Limpar" onclick="resetar()" class="btn red">&nbsp&nbsp
                <a href="lista_filamentos.php" class="btn purple">Voltar</a>
            </div>

        </fieldset>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>

            </div>
        </div>
    </div>
</div>

<script>
    function resetar() {
        var form = document.getElementById("formFilamentos");
        var marca = form.marca.value;

        var set = confirm("Deseja apagar os dados do formulário?");
        if (set) {
            //alert('Os campos do formulário foram resetados!');
            form.reset();
            form.marca.focus();
        }
    }
</script>

<?php include_once('../includes/footer.inc.php');
?>