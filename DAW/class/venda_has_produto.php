<?php
    class Venda_has_produto {
        private $Venda_idVenda;
        private $Produto_idProduto;
        private $quantidade;
        private $valor_unit;

        // Métodos Get
        public function getVendaIdVenda() {
            return $this->Venda_idVenda;
        }

        public function getProdutoIdProduto() {
            return $this->Produto_idProduto;
        }

        public function getQuantidade() {
            return $this->quantidade;
        }

        public function getValorUnit() {
            return $this->valor_unit;
        }

        // Métodos Set
        public function setVendaIdVenda($Venda_idVenda) {
            $this->Venda_idVenda = $Venda_idVenda;
        }

        public function setProdutoIdProduto($Produto_idProduto) {
            $this->Produto_idProduto = $Produto_idProduto;
        }

        public function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }

        public function setValorUnit($valor_unit) {
            $this->valor_unit = $valor_unit;
        }
    }
?>