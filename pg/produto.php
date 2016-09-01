<?php
if (!empty($_POST['formProduto'])) {

    include '../base.php';

    //insere se for novo cadastro
    if (empty($_POST['prod_id'])) {

        //insere
        mysql_select_db($base, $con);
        mysql_query("INSERT INTO produto (prod_id) VALUES (NULL)", $con) or die(mysql_error());

        //seleciona o ultimo usuario
        mysql_select_db($base, $con);
        $s = mysql_query("SELECT prod_id FROM produto ORDER BY prod_id DESC LIMIT 1", $con) or die(mysql_error());
        $f = mysql_fetch_assoc($s);

        $id = $f['prod_id'];
        
    } else {
        
        $id = $_POST['prod_id'];
        
    }

    //atualiza
    $sql = "
        UPDATE produto SET 
        forn_id='" . $_POST['fornecedor'] . "',
        prod_nome='" . $_POST['nome'] . "',
        prod_tipo='" . $_POST['tipo'] . "',
        prod_desc='" . $_POST['descricao'] . "',
        prod_valorunit='" . $_POST['valorunit'] . "',
        prod_valorvenda='" . $_POST['valorvenda'] . "',
        prod_desconto='" . $_POST['desconto'] . "',
        prod_qtdestoque='" . $_POST['qtdestoque'] . "'
        WHERE prod_id=" . $id . "
    ";

    mysql_select_db($base, $con);
    $s = mysql_query($sql, $con) or die(mysql_error());
    $f = mysql_fetch_assoc($s);
    
    header('Location: ../?pg=listaProdutos');
    
} else {
    
    if (!empty($_GET['id'])) {
        mysql_select_db($base, $con);
        $s = mysql_query("SELECT * FROM produto WHERE prod_id=".$_GET['id'], $con) or die(mysql_error());
        $prod = mysql_fetch_assoc($s);
    }
    
    ?>

    <a href="./?pg=listaProdutos">Voltar</a>

    <form id="formProduto" action="pg/produto.php" method="post">

        <input type="hidden" name="formProduto" value="ok">
        <?php if (!empty($_GET['id'])) { ?>
        <input type="hidden" name="prod_id" value="<?php echo $_GET['id']; ?>">
        <?php } ?>

        <div class="form-group">
            <label>Produto</label>
            <input type="text" name="nome" value="<?php echo (!empty($prod['prod_nome'])?$prod['prod_nome']:''); ?>">
        </div>
        <div class="form-group">
            <label>Fornecedor</label>
            <select name="fornecedor">
                <?php
                mysql_select_db($base, $con);
                $s = mysql_query("SELECT * FROM fornecedores ORDER BY forn_razaosoc ASC", $con) or die(mysql_error());
                while($forn=mysql_fetch_assoc($s)) {
                    $sel='';
                    if ($forn['forn_id']==$prod['forn_id']) {
                        $sel=' SELECTED';
                    }
                    echo '<option value="'.$forn['forn_id'].'"'.$sel.'>'.$forn['forn_razaosoc'].'</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Tipo</label>
            <select name="tipo">
                <option value="1" <?php echo(!empty($prod['prod_tipo']) and $prod['prod_tipo']=='perecivel')?' SELECTED':''; ?>>perecivel</option>
                <option value="2" <?php echo(!empty($prod['prod_tipo']) and $prod['prod_tipo']=='nao perecivel')?' SELECTED':''; ?>>nao perecivel</option>
            </select>
        </div>
        
        <?php // echo $prod['prod_tipo']; ?>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="descricao" value="<?php echo (!empty($prod['prod_desc'])?$prod['prod_desc']:''); ?>">
        </div>
        <div class="form-group">
            <label>Valor unitário</label>
            <input class="moeda" type="text" name="valorunit" value="<?php echo (!empty($prod['prod_valorunit'])?$prod['prod_valorunit']:''); ?>">
        </div>
        <div class="form-group">
            <label>Valor de venda</label>
            <input class="moeda" type="text" name="valorvenda" value="<?php echo (!empty($prod['prod_valorvenda'])?$prod['prod_valorvenda']:''); ?>">
        </div>
        <div class="form-group">
            <label>Desconto</label>
            <input type="text" name="desconto" value="<?php echo (!empty($prod['prod_desconto'])?$prod['prod_desconto']:''); ?>">
        </div>
        <script>
            $('[name=valorunit],[name=valorvenda]').keyup(function(){
                calcula();
            });
            $(document).ready(function(){
                calcula();
            });
            function calcula(){
                var dc=d($('[name=valorunit]').val());
                $('[name=valorvenda]').val(m(dc+((dc*30)/100)));
                calculaProdutos();
            }
            $('[name=desconto]').keyup(function(){
                if ($(this).val()>12) {
                    alert('O máximo de desconto é 12%');
                    $(this).val(12);
                }
            });
        </script>
        <div class="form-group">
            <label>Quantidade em estoque</label>
            <input type="text" name="qtdestoque" value="<?php echo (!empty($prod['prod_qtdestoque'])?$prod['prod_qtdestoque']:''); ?>">
        </div>
        <br>
        Total do valor de compra x estoque: <span id="totalCompra"></span><br>
        Total do valor de venda x estoque: <span id="totalVenda"></span>
        <script>
            $(document).ready(function(){
                calculaProdutos();
                $('[name=qtdestoque]').keyup(function(){
                    calculaProdutos();
                });
            });
            function calculaProdutos() {
                $('#totalCompra').html(m(d($('[name=valorunit]').val())*$('[name=qtdestoque]').val()));
                $('#totalVenda').html(m(d($('[name=valorvenda]').val())*$('[name=qtdestoque]').val()));
            }
        </script>
        <br>
        <br>
        <input type="submit" value="Cadastrar">
    </form>
    <script>

        $(document).ready(function () {
            $(".moeda").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: ".", allowZero: true, allowNegative: true});
        });

        $('#formProduto').submit(function (e) {

            var erro = false;

            if ($('#formProduto [name=nome]').val() === '') {
                $('#formProduto [name=nome]').focus();
                alert('Preencha seu nome');
                erro = true;
            } else if ($('#formProduto [name=descricao]').val() === '') {
                $('#formProduto [name=descricao]').focus();
                alert('Preencha a descrição');
                erro = true;
            } else if ($('#formProduto [name=valorunit]').val() === '') {
                $('#formProduto [name=valorunit]').focus();
                alert('Preencha o valor unitário');
                erro = true;
            } else if ($('#formProduto [name=qtdestoque]').val() === '') {
                $('#formProduto [name=qtdestoque]').focus();
                alert('Preencha a quantidade no estoque');
                erro = true;
            }

            if (erro) {
                e.preventDefault();
            }
        });
    </script>
<?php
}