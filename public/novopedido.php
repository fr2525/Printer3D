<?php session_start()  ?>
<!DOCTYPE html>

<?php include_once('../includes/header.inc.php');
include_once('../includes/menu.inc.php');
include_once '../banco_de_dados/conexao.php';

/* SELECT id_venda,id_cliente,id_usuario,descricao,qtde,preco,total_venda,status
        ,data_Compra,data_Finaliza,data_entrega FROM `tb_pedidos`
*/
/*

id_cliente
descricao varchar(250) 
preco float 
quantidade int 
total_venda float 
status int 
dataCompra date 
dataPrevisao date 
dataFinaliza date 
dataEntrega date 
operador int 
datatual

if (isset($_SESSION['id_cli'])) :
    $id_cli = $_SESSION['id_cli'];
else :
    $id_cli = "";
endif;

if (isset($_SESSION['nome_cli'])) :
    $nome_cli = $_SESSION['nome_cli'];
else :
    $nome_cli = "";
endif;

if (isset($_SESSION['projeto'])) :
    $projeto = $_SESSION['projeto'];
else :
    $projeto = "";
endif;

if (isset($_SESSION['preco'])) :
    $preco = floatval($_SESSION['preco']);
else :
    $preco = floatval(0);
endif;

if (isset($_SESSION['quantidade'])) :
    $quantidade = $_SESSION['quantidade'];
else :
    $quantidade = "";
endif;

if (isset($_SESSION['total_venda'])) :
    $total_venda = floatval($_SESSION['total_venda']);
else :
    $total_venda = floatval(0);
endif;

if (isset($_SESSION['datacompra'])) :
    $datacompra = $_SESSION['datacompra'];
else :
    $timestamp = time(); // Pega o timestamp atual
    $datacompra = date("d/m/Y", $timestamp);

endif;

if (isset($_SESSION['dataprevisao'])) :
    $dataprevisao = $_SESSION['dataprevisao'];
else :
    $dataprevisao = "";
endif;

if (isset($_SESSION['datafinaliza'])) :
    $datafinaliza = $_SESSION['datafinaliza'];
else :
    $datafinaliza = "";
endif;

if (isset($_SESSION['dataentrega'])) :
    $dataentrega = $_SESSION['dataentrega'];
else :
    $dataentrega = "";
endif;

if (isset($_SESSION['status'])) :
    $status = $_SESSION['status'];
else :
    $status = "";
endif;
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

?>

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
                <div class="input-field col s12">
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
            </div>

            <div class="row">
                <!-- Campo Descrição do projeto -->
                <div class="input-field col s12">
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
                        value="<?php echo number_format($quantidade, 0, ',','.'); ?>" id="quantidade" maxlength="10">
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
                    <select multiple name="impres" id="impres">
                        <option disabled selected>Escolha a Impressora disponivel</option>
                        <?php
                        $querySelect = $link->query("select id, marca from tb_impressoras where ocupada = 'N'");
                        while ($registros = $querySelect->fetch_assoc()) :
                            $id_impres = $registros['id'];
                            $marca = $registros['marca'];
                            echo '<option value=' . $id_impres . '>' . $marca . '</option>';

                        endwhile;
                        echo '</select>';
                        echo '<label for="impres">Impressoras Disponiveis</label>';

                        ?>
                </div>
                <!-- Campo Impressoras ocupadas -->
                <div class="input-field col s6">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <select multiple name="impres" id="impres">
                        <option disabled >Clique para desocupar</option>
                        <?php
                        $querySelect = $link->query("select id, marca from tb_impressoras where ocupada = 'S'");
                        while ($registros = $querySelect->fetch_assoc()) :
                            $id_impres = $registros['id'];
                            $marca = $registros['marca'];
                            echo '<option disabled value=' . $id_impres . '>' . $marca . '</option>';

                        endwhile;
                        echo '</select>';
                        echo '<label for="impres">Impressoras ocupadas</label>';

                        ?>
                </div>
            </div>
            <!---  Fim do form -->

            <!-- Botões -->
            <div class="input-field col s12">
                <input type="submit" value="Cadastrar" class="btn blue">&nbsp&nbsp
                <input type="button" value="Limpar" onclick="resetar()" class="btn red">&nbsp&nbsp
                <a href="lista_pedidos.php" class="btn purple">Voltar</a>
            </div>

        </fieldset>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js" integrity="sha512-0qU9M9jfqPw6FKkPafM3gy2CBAvUWnYVOfNPDYKVuRTel1PrciTj+a9P3loJB+j0QmN2Y0JYQmkBBS8W+mbezg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/underscore@1.13.6/underscore-umd-min.js"></script>
<script src="../libs/materialize/js/index.js"></script>

<script>
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
</script>

<?php include_once('../includes/footer.inc.php');  ?>