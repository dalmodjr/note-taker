<?php
    // Inclui o arquivo de configuração
    include_once 'config.php';

    function RequestAPI($url, $content) {
        $url = '?'.$url;

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($content)
            )
        );

        $context  = stream_context_create($options);
        $result = file_get_contents(API.$url, false, $context);

        if ($result === FALSE) {
            return false;
        }

        return json_decode($result, true);
    }

    function logOut() {
        if (!isset($_SESSION)) {
            session_start();
        }

        unset($_SESSION['login']);
    }

    function usuarioLogado() {
        if (!isset($_SESSION)) {
            session_start();
        }

        return isset($_SESSION['login']) and isset($_SESSION['login']['id']) and isset($_SESSION['login']['nome']) and isset($_SESSION['login']['sobrenome']);
    }

    function usuarioId() {
        if (!isset($_SESSION)) {
            session_start();
        }

        return $_SESSION['login']['id'];
    }
?>