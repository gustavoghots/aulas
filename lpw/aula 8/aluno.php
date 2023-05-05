<?php
    include_once 'fisica.php';
    class Aluno extends Fisica {

        private $nota;

        public function __construct($nome,$idade,$cpf,$nota){
            parent::SetNome($nome);
            parent::SetIdade($idade);
            parent::SetCpf($cpf);
            $this->nota=$nota;
        }
        
        public function GetNota(){
            return $this->nota;
        }

        public function SetNota($nota){
            $this->nota=$nota;
        }
    }
?>