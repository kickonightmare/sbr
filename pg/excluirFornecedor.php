<?php if (!empty($_GET['exc'])) {
    include '../base.php';
    
    mysql_select_db($base, $con);
    mysql_query("DELETE FROM fornecedores WHERE forn_id=".$_GET['id'], $con) or die(mysql_error());
    
    header('Location: ../?pg=listaFornecedores');
    
    exit;
    
} else {
    ?>
    Tem certeza que deseja excluir?
    <br>
    <br>
    <a href="?pg=listaFornecedores">Voltar</a>
    <a href="pg/excluirFornecedor.php?id=<?php echo $_GET['id']; ?>&exc=ok">Excluir</a>
<?php
}