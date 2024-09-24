<?php
    class Produto {
        private $idProduto;
        private $nome;
        private $preco;
        private $descricao;
        private $imagem;
        private $oferta;
        private $qtd_estoque;
        private $Categoria_idCategoria;
        private $preco_oferta;

        // Métodos Get
        public function getIdProduto() {
            return $this->idProduto;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getPreco() {
            return $this->preco;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function getImagem() {
            return $this->imagem;
        }

        public function getOferta() {
            return $this->oferta;
        }

        public function getQtdEstoque() {
            return $this->qtd_estoque;
        }

        public function getCategoriaIdCategoria() {
            return $this->Categoria_idCategoria;
        }

        public function getPrecoOferta(){
            return $this->preco_oferta;
        }

        // Métodos Set
        public function setIdProduto($idProduto) {
            $this->idProduto = $idProduto;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setPreco($preco) {
            $this->preco = $preco;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        public function setImagem($imagem) {
            $this->imagem = $imagem;
        }

        public function setOferta($oferta) {
            if($oferta!=null){
                $this->oferta = $oferta;
                $this->preco_oferta = $this->preco-($this->oferta*0.01*$this->preco); 
            }else
                $this->preco_oferta = $this->preco;
        }

        public function setQtdEstoque($qtd_estoque) {
            $this->qtd_estoque = $qtd_estoque;
        }

        public function setCategoriaIdCategoria($Categoria_idCategoria) {
            $this->Categoria_idCategoria = $Categoria_idCategoria;
        }
    }
?>