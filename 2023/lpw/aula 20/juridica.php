<?php
    include_once 'pessoa.php';
    class juridica extends Pessoa {

        private $cnpj;

        function __construct($nome,$idade,$altura,$cnpj){
            parent::setNome($nome);
            parent::setIdade($idade);
            parent::setAltura($altura);
            $this->cnpj=$cnpj;
        }

        public function GetCnpj(){
            return $this->cnpj;
        }

        public function SetCnpj($cnpj){
            $this->cnpj=$cnpj;
        }
    }
?>