<?php
    class Cidade{

        private $id;
        private $nome;
        private $estado;

        function __construct($id,$nome,$estado){
            $this->id=$id;
            $this->nome=$nome;
            $this->estado=$estado;
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome=$nome;
        }
        public function getEstado(){
            return $this->estado;
        }

        public function setEstado($estado){
            $this->estado=$estado;
        }
    }
?>