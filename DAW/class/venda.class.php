<?php
    class Venda {
        private $idVenda;
        private $data;
        private $valor_total;
        private $status;
        private $Usuario_idUsuario;
        
        // Métodos Get
        public function getIdVenda() {
            return $this->idVenda;
        }

        public function getData() {
            return $this->data;
        }

        public function getValorTotal() {
            return $this->valor_total;
        }

        public function getStatus() {
            return $this->status;
        }

        public function getUsuarioIdUsuario() {
            return $this->Usuario_idUsuario;
        }

        // Métodos Set
        public function setIdVenda($idVenda) {
            $this->idVenda = $idVenda;
        }

        public function setData($data) {
            $this->data = $data;
        }

        public function setValorTotal($valor_total) {
            $this->valor_total = $valor_total;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

        public function setUsuarioIdUsuario($Usuario_idUsuario) {
            $this->Usuario_idUsuario = $Usuario_idUsuario;
        }
    }
?>