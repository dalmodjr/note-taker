<?php
    /*
        Msg - Retorna uma mensagem para a API com o estilo e formatação correta
    */
    function Msg($msg) {
        return json_encode(array('msg' => $msg));
    }

    function getConn() {
        include_once 'taker-conn.class.php';

        return new Conn;
    }

    function Executar($sql, $params = array()) {
        return getConn()->Executar($sql, $params);
    }

    function Query($sql, $params = array()) {
        return getConn()->Query($sql, $params);
    }

    function importControllers() {
        include_once 'taker-controller.class.php';
    }
?>