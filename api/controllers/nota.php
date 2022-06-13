<?php
    class Nota extends Controller {
        public $usuarioid = 0;
        public $titulo = '';
        public $texto = '';

        function __construct() {
            parent::__construct();

            $this->setSQLSelect('SELECT `id`, `usuarioid`, `titulo`, `texto` '.
                                'FROM `nota`');
            $this->setSQLInsert('INSERT INTO `nota` (`usuarioid`, `titulo`, `texto`) VALUES (:usuarioid, :titulo, :texto);');
            $this->setSQLUpdate('UPDATE `nota` SET `usuarioid` = :usuarioid, `titulo` = :titulo, `texto` = :texto WHERE `id` = :id;');
            $this->setSQLDelete('DELETE FROM `nota` WHERE `id` = :id;');
        }

        function getParams() {
            return array('usuarioid' => $this->usuarioid,
                         'titulo' => $this->titulo,
                         'texto' => $this->texto);
        }
    }
?>