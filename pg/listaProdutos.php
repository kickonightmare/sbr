<a class="botao" href="./">Voltar</a>

<br>
<br>

<?php


mysql_select_db($base, $con);
$s = mysql_query("SELECT * FROM produto ORDER BY prod_id DESC", $con) or die(mysql_error());
while($f = mysql_fetch_assoc($s)) {
    echo '<div class="item">';
    echo $f['prod_nome'];
    echo ' - ';
    echo '<a href="?pg=produto&id='.$f['prod_id'].'">Editar</a>';
    echo ' - ';
    echo '<a href="?pg=excluirProduto&id='.$f['prod_id'].'">Excluir</a>';
    echo '</div>';
//    echo '<br>';
}