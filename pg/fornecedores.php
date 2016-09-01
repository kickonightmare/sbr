<?php
if (!empty($_POST['formFornecedores'])) {

    include '../base.php';

    //insere se for novo cadastro
    if (empty($_POST['forn_id'])) {

        //insere
        mysql_select_db($base, $con);
        mysql_query("INSERT INTO fornecedores (forn_id) VALUES (NULL)", $con) or die(mysql_error());

        //seleciona o ultimo usuario
        mysql_select_db($base, $con);
        $s = mysql_query("SELECT forn_id FROM fornecedores ORDER BY forn_id DESC LIMIT 1", $con) or die(mysql_error());
        $f = mysql_fetch_assoc($s);

        $id = $f['forn_id'];
    } else {

        $id = $_POST['forn_id'];
    }

    //atualiza
    $sql = "
        UPDATE fornecedores SET 
        forn_cnpj='" . somenteNumeros($_POST['cnpj']) . "',
        forn_razaosoc='" . $_POST['razaosoc'] . "',
        forn_rua='" . $_POST['rua'] . "',
        forn_numero='" . $_POST['numero'] . "',
        forn_complemento='" . $_POST['complemento'] . "',
        forn_cep='" . somenteNumeros($_POST['cep']) . "',
        forn_bairro='" . $_POST['bairro'] . "',
        forn_cidade='" . $_POST['cidade'] . "',
        forn_uf='" . $_POST['uf'] . "',
        forn_pais='" . $_POST['pais'] . "',
        forn_fone='" . somenteNumeros($_POST['fone']) . "',
        forn_email='" . $_POST['email'] . "'
        WHERE forn_id=" . $id . "
    ";

    mysql_select_db($base, $con);
    $s = mysql_query($sql, $con) or die(mysql_error());
    $f = mysql_fetch_assoc($s);

    header('Location: ../?pg=listaFornecedores');
} else {

    if (!empty($_GET['id'])) {
        mysql_select_db($base, $con);
        $s = mysql_query("SELECT * FROM fornecedores WHERE forn_id=" . $_GET['id'], $con) or die(mysql_error());
        $forn = mysql_fetch_assoc($s);
    }
    ?>

    <!--<a href="./">Voltar</a><a href="./pg=listaProdutos">Voltar</a>-->

    <form id="formFornecedores" action="pg/fornecedores.php" method="post">
        <a class="botao" href="./?pg=listaFornecedores">Voltar</a>
        <br>
        <br>

        <input type="hidden" name="formFornecedores" value="ok">
    <?php if (!empty($_GET['id'])) { ?>
            <input type="hidden" name="forn_id" value="<?php echo $_GET['id']; ?>">
    <?php } ?>

        <div id="div1">

            <div class="form-group">
                <label>Cnpj</label>
                <input type="text" name="cnpj" value="<?php echo (!empty($forn['forn_cnpj']) ? $forn['forn_cnpj'] : ''); ?>">
            </div>

            <div class="form-group">
                <label>Razão Social</label>
                <input type="text" name="razaosoc" value="<?php echo (!empty($forn['forn_razaosoc']) ? $forn['forn_razaosoc'] : ''); ?>">
            </div>

            <div class="form-group">
                <label>Endereço</label>
                <input type="text" name="rua" value="<?php echo (!empty($forn['forn_rua']) ? $forn['forn_rua'] : ''); ?>">
            </div>
            <div class="form-group">
                <label>Número</label>
                <input type="text" name="numero" value="<?php echo (!empty($forn['forn_numero']) ? $forn['forn_numero'] : ''); ?>">
            </div>
            <div class="form-group">
                <label>Complemento</label>
                <input type="text" name="complemento" value="<?php echo (!empty($forn['forn_complemento']) ? $forn['forn_complemento'] : ''); ?>">
            </div>
            <div class="form-group">
                <label>Bairro</label>
                <input type="text" name="bairro" value="<?php echo (!empty($forn['forn_bairro']) ? $forn['forn_bairro'] : ''); ?>">
            </div>
        </div>
        <div id="div2">
            <div class="form-group">
                <label>Cidade</label>
                <input type="text" name="cidade" value="<?php echo (!empty($forn['forn_cidade']) ? $forn['forn_cidade'] : ''); ?>">
            </div>
            <div class="form-group">
                <label>UF</label>
                <input type="text" name="uf" value="<?php echo (!empty($forn['forn_uf']) ? $forn['forn_uf'] : ''); ?>">
            </div>
            <div class="form-group">
                <label>País</label>
                <input type="text" name="pais" value="<?php echo (!empty($forn['forn_pais']) ? $forn['forn_pais'] : ''); ?>">
            </div>
            <div class="form-group">
                <label>Fone</label>
                <input type="text" name="fone" value="<?php echo (!empty($forn['forn_fone']) ? $forn['forn_fone'] : ''); ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo (!empty($forn['forn_email']) ? $forn['forn_email'] : ''); ?>">
            </div>
            <input type="submit" value="Cadastrar">
        </div>
    </form>
    <script>

        $(document).ready(function () {
            $('[name=cnpj]').mask('00.000.000/0000-00');
            $('[name=cep]').mask('00000-000');
            $('[name=fone]').mask('(00) 0000-0000');
        });

        $('#formFornecedores').submit(function (e) {

            var erro = false;

            if ($('#formFornecedores [name=cnpj]').val() === '') {
                $('#formFornecedores [name=cnpj]').focus();
                alert('Preencha seu cnpj');
                erro = true;
            } else if (!isCnpj($('#formFornecedores [name=cnpj]').val())) {
                $('#formFornecedores [name=cnpj]').focus();
                alert('Cnpj incorreto');
                erro = true;
            } else if ($('#formFornecedores [name=razaosoc]').val() === '') {
                alert('Preencha sua razão social');
                $('#formFornecedores [name=razaosoc]').focus();
                erro = true;
            } else if ($('#formFornecedores [name=rua]').val() === '') {
                alert('Preencha seu endereço');
                $('#formFornecedores [name=rua]').focus();
                erro = true;
            } else if ($('#formFornecedores [name=numero]').val() === '') {
                alert('Preencha seu número');
                $('#formFornecedores [name=numero]').focus();
                erro = true;
            } else if ($('#formFornecedores [name=bairro]').val() === '') {
                alert('Preencha seu bairro');
                $('#formFornecedores [name=bairro]').focus();
                erro = true;
            } else if ($('#formFornecedores [name=cidade]').val() === '') {
                alert('Preencha sua cidade');
                $('#formFornecedores [name=cidade]').focus();
                erro = true;
            } else if ($('#formFornecedores [name=uf]').val() === '') {
                alert('Preencha o UF do estado');
                $('#formFornecedores [name=uf]').focus();
                erro = true;
            } else if ($('#formFornecedores [name=pais]').val() === '') {
                alert('Preencha seu país');
                $('#formFornecedores [name=pais]').focus();
                erro = true;
            } else if ($('#formFornecedores [name=fone]').val() === '') {
                alert('Preencha seu telefone');
                $('#formFornecedores [name=fone]').focus();
                erro = true;
            } else if ($('#formFornecedores [name=email]').val() === '') {
                alert('Preencha seu email');
                $('#formFornecedores [name=email]').focus();
                erro = true;
            } else if (!isEmail($('#formFornecedores [name=email]').val())) {
                alert('Email incorreto');
                $('#formFornecedores [name=email]').focus();
                erro = true;
            }

            if (erro) {
                e.preventDefault();
            }
        });
    </script>
    <?php
}