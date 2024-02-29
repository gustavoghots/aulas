<?php
    class Estado{

        private $id;
        private $nome;
        private $pais;
        private $UF;

        function __construct($id,$nome,$pais,$UF){
            $this->id=$id;
            $this->nome=$nome;
            $this->pais=$pais;
            $this->UF=$UF;
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

        public function getUF(){
            return $this->UF;
        }

        public function setUF($UF){
            $this->UF=$UF;
        }

        public function getPais(){
            return $this->pais;
        }

        public function setPais($pais){
            $this->pais=$pais;
        }
    }
?>