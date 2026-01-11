<?php session_start()  ?>
<!DOCTYPE html>

<?php include_once('../includes/header.inc.php');
include_once('../includes/menu.inc.php');
include_once '../banco_de_dados/conexao.php';

/* SELECT id_venda,id_cliente,id_usuario,descricao,qtde,preco,total_venda,status
        ,data_Compra,data_Finaliza,data_entrega FROM `tb_pedidos`
*/

$id_cli = "";
$nome_cli = "";
$projeto = "";
$preco = floatval(0);
$quantidade = 0;
$total_venda = floatval(0);
$timestamp = time(); // Pega o timestamp atual
$datacompra = date("d/m/Y", $timestamp);
$dataprevisao = "";
$datafinaliza = "";
$dataentrega = "";
$status = "";

$impressoras = []; // Array para armazenar os dados
$querySelect = $link->query("select id, marca from tb_impressoras where ocupada = 'N'");
while ($registros = $querySelect->fetch_assoc()) :
    $impressoras[] = $registros; // Adiciona a linha ao array principal
endwhile;

$ocupadas = []; // Array para armazenar os dados
$querySelect = $link->query("select id, marca from tb_impressoras where ocupada = 'S'");
while ($registros = $querySelect->fetch_assoc()) :
    $ocupadas[] = $registros; // Adiciona a linha ao array principal
endwhile;
//$output = json_encode($impressoras);
//echo $output;
//exit();
?>

<!-- Begin of Modal Structure -->

<!-- O Modal em si -->
<div id="modal1" class="modal">
  <div class="modal-content">
    <h4>Cabeçalho do Modal</h4>
    <p>Este é o conteúdo da janela modal.</p>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Concordar</a>
  </div>
</div>
<!-- End of Modal Structure -->


<div class="row container">

    <form action="../banco_de_dados/createped.php" id="formPedido" method="post" class="col s12">
        <fieldset class="formulario" style="padding: 5px">
            <!-- <legend><img src="imagens/avatar-1.png" width="50"></legend>  -->
            <h5 class="light center">Cadastro de Pedidos</h5>
            <?php
            if (isset($_SESSION['msg'])) :
                echo $_SESSION['msg'];
                session_unset();
            endif;
            ?>
            <div class="row">
                <!-- Campo Nome -->
                <div class="input-field col s4">
                    <!--   <i class="material-icons prefix"></i>  -->
                    <select name="nomecli" id="nomecli">
                        <option disabled selected>Escolha o Cliente</option>
                        <?php
                        $querySelect = $link->query("select id, nome from tb_clientes order by nome");
                        while ($registros = $querySelect->fetch_assoc()) :
                            $id_cli = $registros['id'];
                            $nomecli = $registros['nome'];
                            echo '<option value=' . $id_cli . '>' . $nomecli . '</option>';

                        endwhile;
                        echo '</select>';
                        echo '<label for="nomecli">Nome</label>';
                        ?>
                </div>

                <!-- Campo Descrição do projeto -->
                <div class="input-field col s8">
                    <!-- <i class="material-icons prefix"></i> -->
                    <input type="text" name="projeto" value="<?php echo $projeto ?>" id="projeto" maxlength="100" required="">
                    <label for="projeto">Descrição do projeto</label>
                </div>
            </div>
            <div class="row">
                <!-- Campo Preço -->
                <div class="input-field col s2">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="number" name="preco" step=".01"
                        value="<?php echo number_format($preco, 2, ',', '.'); ?>" onblur="javascript:this.value=formataValor(this.value);">
                    <label for="preco">Valor unitário</label>
                </div>
                <!-- Campo Qtde -->
                <div class="input-field col s2">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="number" name="quantidade"
                        value="<?php echo number_format($quantidade, 0, ',', '.'); ?>" id="quantidade" maxlength="10">
                    <label for="quantidade">Qtde.</label>
                </div>
                <!-- Campo Total -->
                <div class="input-field col s2">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="number" name="total_venda" step=".01"
                        value="<?php echo number_format($total_venda, 2, ',', '.'); ?>" onblur="javascript:this.value=formataValor(this.value);">
                    <label for="total_venda">Valor total</label>
                </div>
                <!-- Campo Data da Compra -->
                <div class="input-field col s3">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="date" name="datacompra" value="<?php echo $datacompra ?>" id="datacompra" maxlength="10">
                    <label for="datacompra">Dta.Compra</label>
                </div>
                <!-- Campo Data de previsão de entrega -->
                <div class="input-field col s3">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="date" name="dataprevisao" value="<?php echo $dataprevisao ?>" id="dataprevisao" maxlength="10">
                    <label for="dataprevisao">Dta.Prevista</label>
                </div>
            </div>
            <div class="row">

                <div class="input-field col s6">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <select name="selimpres" id="selimpres" data-toggle="modal1" onchange="teste(this);" data-target="#modal1">
                        <option disabled>Escolha a Impressora disponivel</option>
                        <?php
                        foreach ($impressoras as $registro) {
                            echo '<option value=' . $registro['id'] . '>' . $registro['marca'] . '</option>';
                        }
                        echo '</select>';
                        ?>
                </div>
                <!-- Campo Impressoras ocupadas -->
                <div class="input-field col s6">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <select multiple name="impresoc" id="impresoc">
                        <option disabled>Clique para desocupar</option>
                        <?php
                        foreach ($ocupadas as $regocupada) {
                            //                          echo '<option disabled value=' . $regocupada['id'] . '>' . $regocupada['marca'] . '</option>';
                        }
                        echo '</select>';
                        echo '<label for="impresoc">Impressoras ocupadas</label>';
                        ?>
                </div>
            </div>

            <!-- Botões -->
            <div class="input-field col s12">
                <input type="submit" value="Cadastrar" class="btn blue">&nbsp&nbsp
                <input type="button" value="Limpar" onclick="resetar()" class="btn red">&nbsp&nbsp
                <a href="lista_pedidos.php" class="btn purple">Voltar</a>
            </div>
        </fieldset>
    </form>
    <!---  Fim do form -->

</div>

<!-- Arquivos Jquery e Materialize -->
<script type="text/javascript" src="../libs/materialize/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../libs/materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="../libs/materialize/js/funcoes.js"></script>

<script>

function teste(select) {
  //  alert("REntrou no test");
  $("#modal1").modal();
  $("#modal1").show().focus;
}

    function resetar() {
        var form = document.getElementById("formPedido");
        var nome = form.nome.value;

        var set = confirm("Deseja apagar os dados do formulário?");
        if (set) {
            //alert('Os campos do formulário foram resetados!');
            form.reset();
            form.nome.focus();
        }
    }

    function changeFunc(valor) {
        alert("The selected value is: " + valor);

        // You can add more code here to perform other actions
    }
</script>
<!-- Inicialização Jquery -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".dropdown-trigger").dropdown();
        $('select').formSelect();
        $('select').on('change', function() {
            if ($(this).val() == "volvo") {
                $('#cria-recinto').modal('show');
            } else {

                $('#modal1').modal('show');
            }


        });
    });
</script>
</body>

</html>