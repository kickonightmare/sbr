<a href="?pg=listaFornecedores">Fornecedores</a>
<a href="?pg=listaProdutos">Produtos</a>
<br>
<br>

Escolha uma tabela:
<br>
<?php
$sql = "SHOW TABLES";
mysql_select_db($base, $con);
$s = mysql_query($sql, $con) or die(mysql_error());
while ($f = mysql_fetch_assoc($s)) {
    echo '<a href="?pg=' . $f['Tables_in_'.$base] . '">';
    echo 'Cadastrar '.$f['Tables_in_'.$base];
    echo '</a>';
    echo '<br>';
}