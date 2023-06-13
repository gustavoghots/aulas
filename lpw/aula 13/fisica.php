<?php
    include_once 'pessoa.php';
    class fisica extends Pessoa {

        private $cpf;

        public function GetCpf(){
            return $this->cpf;
        }

        public function SetCpf($cpf){
            $this->cpf=$cpf;
        }

        public function GetNome(){
            return 'DR.'.parent::GetNome();
        }

        public function GetIdade(){
            return parent::GetIdade().' de nascimento';
        }
    }
?>