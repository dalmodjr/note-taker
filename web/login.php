<?php
    include_once 'functions.php';

    if (usuarioLogado()) {
        exit('<script type="text/javascript">location.href="./";</script>');
    }

    if (isset($_POST['logar'])) {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        $loginParams = array('usuario' => $_POST['usuario'],
                             'senha' => $_POST['senha']);

        $login = RequestAPI('ac=login', $loginParams);

        if ((!is_null($login)) and ($login != false) and (!isset($_login['msg']))) {
            $_SESSION['login'] = $login;

            exit('<script type="text/javascript">location.href="./";</script>');
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <title>Note Taker - Login</title>
        <link rel="stylesheet" type="text/css" media="screen" href="frameworks/taker-front/taker-front.css"/>
        <link rel="stylesheet" type="text/css" media="screen" href="css/note-taker.css"/>
    </head>

    <body>
        <form class="login" action="./login.php" method="post" enctype="multipart/form-data">
            <div class="logo">
                Note Taker
            </div>

            <label>Usuário:</label><br>
            <input type="text" name="usuario"/><br>

            <label>Senha:</label><br>
            <input type="password" name="senha"/><br>

            <?php
                if (isset($_POST['logar'])) {
                    echo '<div class="msg-erro">Usuário e/ou senha icorreto(s).</div>';
                }
            ?>

            <input type="submit" name="logar" value="Enviar"/>

            <div class="rodape">
                2022 - Desenvolvido por Dalmo Jr
            </div>
        </form>
    </body>

    <script type="text/javascript" src="frameworks/taker-front/taker-front.js"></script>
    <script type="text/javascript" src="js/note-taker.js"></script>
</html>