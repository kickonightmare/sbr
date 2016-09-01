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
        <title>Suporte BR</title>
        <style>
            body {
                display: block;
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
                font-family: sans-serif;
                font-size: 12px;
            }
            body, * {
                color: #555;
            }
            form {
                display: table;
                margin: 0 auto;
                background-color: #f3f3f3;
                border: 3px #ccc solid;
                padding: 8px;
                box-sizing: border-box;
            }
            form input {
            }
            form input[type=submit] {
                float: right;
            }
            form input[type=submit],
            form input[type=text],
            form input[type=email],
            form select {
                display: block;
                box-sizing: border-box;
                padding: 6px;
            }
            form input[type=text],
            form input[type=email],
            form select {
                width: 100%;
            }
            form label {
                display: block;
                margin-bottom: 5px;
            }
            .form-group {
                margin-bottom: 15px;
            }
            #div1,
            #div2 {
                display: block;
                width: 48%;
                float: left;

            }
            #div1 {
                margin-right: 1%;
                float: left;
            }
            #div2 {
                float: right;
                margin-left: 1%;
            }
            #container {
                width: 900px;
                margin: 0 auto;
                margin-top: 20px;
            }
            .botao {
                padding: 8px;
                display: table;
                background-color: #eee;
                border: 1px #ccc solid;
                text-decoration: none;
            }
            .botao:hover {
                text-decoration: none;
            }
            .item {
                padding: 8px;
                background-color: #eee;
                border: 1px #ccc solid;
                margin-bottom: 2px;
            }
        </style>
    </head>
    <body>
        <div id="container">
            <?php
            if (!empty($_GET['pg'])) {
                if (file_exists('pg/' . $_GET['pg'] . '.php')) {
                    include 'pg/' . $_GET['pg'] . '.php';
                } else {
                    include 'pg/erro.php';
                }
            } else {
                include 'pg/main.php';
            }
            ?>
        </div>
    </body>
</html>
