<?php
    include_once 'pessoa.php';
    class juridica extends Pessoa {

        private $cnpj;

        public function GetCnpj(){
            return $this->cnpj;
        }

        public function SetCnpj($cnpj){
            $this->cnpj=$cnpj;
        }

        public function GetIdade(){
            return parent::GetIdade()+100;
        }
    }
?>