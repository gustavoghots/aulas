<?php
    include_once 'pessoa.php';
    class juridica extends Pessoa {

        private $cnpj;

        public function __construct($nome,$idade,$cnpj,){
            parent::SetNome($nome);
            parent::SetIdade($idade);
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