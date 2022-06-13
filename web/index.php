<?php
    include_once 'functions.php';

    if (!usuarioLogado()) {
        exit('<script type="text/javascript">location.href="./login.php";</script>');
    }

    if (isset($_GET['logout'])) {
        logOut();

        exit('<script type="text/javascript">location.href="./login.php";</script>');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <title>Note Taker</title>
        <link rel="stylesheet" type="text/css" media="screen" href="frameworks/taker-front/taker-front.css"/>
        <link rel="stylesheet" type="text/css" media="screen" href="css/note-taker.css"/>
    </head>

    <body>
        <div class="menu">
            <div class="logo">
                <a href="./">
                    Note Taker
                </a>
            </div>

            <ul class="categorias" id="categorias">
                <li class="ativo">
                    Principal
                </li>

                <li onclick="verOpcoes()">
                    Ver opções
                </li>
            </ul>

            <ul class="categorias" id="menu">
                <li onclick="verOpcoes()">
                    Ver categorias
                </li>

                <li onclick="location.href='./?logout';">
                    Logout
                </li>
            </ul>

            <div class="rodape">
                2022 - Desenvolvido por Dalmo Jr
            </div>
        </div>

        <main>
            <header>
                <div class="titulo">
                    Principal
                </div>

                <img class="nova-nota" onclick="novaNota()" src="img/add.png"/>
            </header>

            <div class="notas">
                <ul>
                    <?php
                        $parametrosNotas = array('usuarioid' => usuarioId(),
                                                 'operacao' => 'pesquisa');

                        $notas = RequestAPI('ac=notas', $parametrosNotas);

                        foreach ($notas as $nota) {
                            echo '<li onclick="mostrarNota('.$nota['id'].')">';
                                echo '<div class="nota-titulo">'.$nota['titulo'].'</div>';
                                echo '<div class="nota-conteudo">'.$nota['texto'].'</div>';
                            echo '</li>';
                        }
                    ?>
                </ul>
            </div>
        </main>
    </body>

    <script type="text/javascript">
        API = "<?php echo API ?>";
        usuarioId = "<?php echo usuarioId() ?>";
    </script>
    <script type="text/javascript" src="frameworks/taker-front/taker-front.js"></script>
    <script type="text/javascript" src="js/note-taker.js"></script>
</html>