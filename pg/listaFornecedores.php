<a class="botao" href="./">Voltar</a>

<br>
<br>

<?php


mysql_select_db($base, $con);
$s = mysql_query("SELECT * FROM fornecedores ORDER BY forn_id DESC", $con) or die(mysql_error());
while($f = mysql_fetch_assoc($s)) {
    echo '<div class="item">';
    echo $f['forn_razaosoc'];
    echo ' - ';
    echo '<a href="?pg=fornecedores&id='.$f['forn_id'].'">Editar</a>';
    echo ' - ';
    echo '<a href="?pg=excluirFornecedor&id='.$f['forn_id'].'">Excluir</a>';
    echo '</div>';
}