<?php
    class Categoria {
        private $idCategoria;
        private $descricao;

        // Métodos Get
        public function getIdCategoria() {
            return $this->idCategoria;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        // Métodos Set
        public function setIdCategoria($idCategoria) {
            $this->idCategoria = $idCategoria;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }
    }
?>