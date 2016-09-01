<?php if (!empty($_GET['exc'])) {
    include '../base.php';
    
    mysql_select_db($base, $con);
    mysql_query("DELETE FROM produto WHERE prod_id=".$_GET['id'], $con) or die(mysql_error());
    
    header('Location: ../?pg=listaProdutos');
    
    exit;
    
} else {
    ?>
    Tem certeza que deseja excluir?
    <br>
    <br>
    <a href="?pg=listaProdutos">Voltar</a>
    <a href="pg/excluirProduto.php?id=<?php echo $_GET['id']; ?>&exc=ok">Excluir</a>
<?php
}