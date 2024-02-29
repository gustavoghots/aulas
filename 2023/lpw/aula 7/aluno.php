<?php
    include_once 'pessoa.php';
    class Aluno extends Pessoa {

        private $nota;

        public function GetNota(){
            return $this->nota;
        }

        public function SetNota($nota){
            $this->nota=$nota;
        }
    }
?>