<?php
    class Controller {
        public $id = 0;

        private $sqlInsert;
        private $sqlUpdate;
        private $sqlDelete;
        private $sqlSelect;

        function __construct() {

        }

        function Alterar() {
            $params = $this->getParams();
            $params['id'] = $this->id;

            return Executar($this->sqlUpdate, $params);
        }

        function Incluir() {
            $params = $this->getParams();

            return Executar($this->sqlInsert, $params);
        }

        function Excluir() {
            return Executar($this->sqlDelete, array('id' => $this->id));
        }

        function Pesquisa($where = '', $params = array()) {
            if ($where != '') {
                $where = ' WHERE '.$where;
            }

            return Query($this->sqlSelect.$where, $params);
        }

        function getParams() {

        }

        function setSQLInsert($sql) {
            $this->sqlInsert = $sql;
        }

        function setSQLUpdate($sql) {
            $this->sqlUpdate = $sql;
        }

        function setSQLDelete($sql) {
            $this->sqlDelete = $sql;
        }

        function setSQLSelect($sql) {
            $this->sqlSelect = $sql;
        }
    }
?>