<?php
    class Venda {
        private $idVenda;
        private $entrega;
        private $data;
        private $pagamento;
        private $valor_total;
        private $status;
        private $Usuario_idUsuario;
        
        // Métodos Get
        public function getIdVenda() {
            return $this->idVenda;
        }

        public function getEntrega() {
            return $this->entrega;
        }

        public function getData() {
            return $this->data;
        }

        public function getPagamento() {
            return $this->pagamento;
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

        public function setEntrega($entrega) {
            $this->entrega = $entrega;
        }

        public function setData($data) {
            $this->data = $data;
        }

        public function setPagamento($pagamento) {
            $this->pagamento = $pagamento;
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