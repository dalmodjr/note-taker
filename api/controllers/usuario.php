<?php
    class Usuario extends Controller {
        public $nome = '';
        public $sobrenome = '';
        public $email = '';
        public $ativo = 0;

        function Login($email, $senha) {
            $sql  = 'SELECT `id`, `nome`, `sobrenome` ';
            $sql .= 'FROM `usuario` ';
            $sql .= 'WHERE `email` = :email AND `senha` = "'.$this->Senha($senha).'" AND `ativo` = 1 ';
            $sql .= 'LIMIT 1;';

            $login = Query($sql, array('email' => $email));

            if (count($login) == 0) {
                return false;
            } else {
                $this->id = $login[0]['id'];
                $this->nome = $login[0]['nome'];
                $this->sobrenome = $login[0]['sobrenome'];
                $this->email = $email;
                $this->ativo = 1;

                return true;
            }
        }

        function Senha($senha) {
            return md5('senha'.$senha.'salt');
        }
    }
?>