<?php
    // Importa as configurações básicas para o Taker API
    include 'config.php';
    // Importa o Taker API
    include './framework/taker-back/taker-api.php';

    // Verifica se não existe uma ação passada como GET na API
    if (!isset($_GET['ac'])) {
        // Sai exibindo a mensagem
        exit(Msg('Parâmetros incorretos.'));
    }

    // Obtém o JSON para análise
    $requisicao = json_decode(file_get_contents('php://input'), true);

    // Verifica qual ação a API precisa realizar
    switch ($_GET['ac']) {
        // Login no sistema
        case 'login':
            // Importa a base de controllers
            importControllers();

            // Importa o controller de usuário
            include_once './controllers/usuario.php';

            // Cria uma instancia da classe de usuário para realizar o login
            $usuario = new Usuario;

            // Realiza o login
            if (!$usuario->login($requisicao['usuario'], $requisicao['senha'])) {
                exit(Msg('Usuário e/ou senha incorreto(s).'));
            }

            // Obtém os principais dados do usuário
            $dadosUsuario = array('id' => $usuario->id,
                                  'nome' => $usuario->nome,
                                  'sobrenome' => $usuario->sobrenome);

            // Retorna os principais dados do usuários
            exit(json_encode($dadosUsuario));
        break;

        case 'notas':
            if (!isset($requisicao['usuarioid']) or !isset($requisicao['operacao'])) {
                // Sai exibindo a mensagem
                exit(Msg('Parâmetros incorretos.'));
            }

            // Importa a base de controllers
            importControllers();

            // Importa o controller de nota
            include_once './controllers/nota.php';

            // Cria uma instancia da classe de nota
            $nota = new Nota;

            switch ($requisicao['operacao']) {
                case 'excluir':
                    if (!isset($requisicao['id']) or !isset($requisicao['usuarioid'])) {
                        // Sai exibindo a mensagem
                        exit(Msg('Parâmetros incorretos.'));
                    }

                    $nota->id = $requisicao['id'];
                    $nota->usuarioid = $requisicao['usuarioid'];

                    $nota->Excluir();
                break;

                case 'pesquisa':
                    if (isset($requisicao['id'])) {
                        $where = '`id` = :id';
                        $params = array('id' => $requisicao['id']);
                    } else if (isset($requisicao['usuarioid'])) {
                        $where = '`usuarioid` = :usuarioid';
                        $params = array('usuarioid' => $requisicao['usuarioid']);
                    }

                    $pesquisa = $nota->Pesquisa($where, $params);

                    if (isset($requisicao['id']) and count($pesquisa) > 0 and $pesquisa[0]['usuarioid'] != $requisicao['usuarioid']) {
                        // Exibe a mensagem que essa nota não pertence a este usuário
                        exit(Msg('Nota não pertence a este usuário.'));
                    }

                    exit(json_encode($pesquisa));
                break;

                case 'salvar':
                    if (!isset($requisicao['id']) or !isset($requisicao['usuarioid']) or !isset($requisicao['titulo']) or !isset($requisicao['texto'])) {
                        // Sai exibindo a mensagem
                        exit(Msg('Parâmetros incorretos.'));
                    }

                    $nota->id = $requisicao['id'];
                    $nota->usuarioid = $requisicao['usuarioid'];
                    $nota->titulo = $requisicao['titulo'];
                    $nota->texto = $requisicao['texto'];

                    if ($requisicao['id'] != 0) {
                        $nota->Alterar();
                    } else {
                        $nota->Incluir();
                    }
                break;

                default:
                    // Sai exibindo a mensagem
                    exit(Msg('Parâmetros incorretos.'));
                break;
            }
        break;

        default:
            // Sai exibindo a mensagem
            exit(Msg('Parâmetros incorretos.'));
        break;
    }
?>