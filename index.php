<?php include 'base.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="inc/jquery-1.8.3.min.js"></script>
        <script src="inc/valida.js"></script>
        <script src="inc/mask.min.js"></script>
        <script src="inc/base.js"></script>
        <script src="inc/maskMoney.js"></script>
        <title></title>
    </head>
    <body>
        <?php
        if (!empty($_GET['pg'])) {
            if (file_exists('pg/'.$_GET['pg'].'.php')) {
                include 'pg/'.$_GET['pg'].'.php';
            } else {
                include 'pg/erro.php';
            }
        } else {
            include 'pg/main.php';
        }
        ?>
    </body>
</html>
