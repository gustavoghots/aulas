<?php
    @include_once'../produto.class.php';
    class Produto_DAO{
        private $conexao;
        public function __construct(){
            $this->conexao = new PDO("mysql:host=localhost;dbname=padel","root","");
        }
        public function inserir(Produto $produto){
            $sql= $this->conexao->prepare("
            insert into categoria(nome,preco,descricao,imagem,oferta,qtd_estoque,Categoria_idCategoria)
            value(:nome,:preco,:descricao,:imagem,:oferta,:qtd_estoque,:Categoria_idCategoria)");
            $sql->bindValue(":nome",$produto->getNome());
            $sql->bindValue(":preco",$produto->getPreco());
            $sql->bindValue(":descricao",$produto->getDescricao());
            $sql->bindValue(":imagem",$produto->getImagem());
            $sql->bindValue(":oferta",$produto->isOferta());
            $sql->bindValue(":qtd_estoque",$produto->getQtdEstoque());
            $sql->bindValue(":Categoria_idCategoria",$produto->getCategoriaIdCategoria());
            return $sql->execute();
        }
        public function listar(){
            $sql= $this->conexao->prepare("select * from Produto");
            $sql->execute();
            return $sql->fetchAll();
        }
        /*public function excluir($id){
            $sql= $this->conexao->prepare("delete from categoria where idCategoria=:id");
            $sql->bindValue(":id",$id);
            return $sql->execute();
        }
        public function retornarCategoria($idCategoria){
            $sql= $this->conexao->prepare("select * from categoria where  idCategoria = :idCategoria");
            $sql->bindValue(":idCategoria",$idCategoria);
            $sql->execute();
            return $sql->fetch();
        }
        public function editar(Categoria $objCategoria){
            $sql= $this->conexao->prepare("update categoria 
            set descricao = :descricao where idCategoria = :idCategoria");
            $sql->bindValue(":descricao",$objCategoria->getDescricao());
            $sql->bindValue(":idCategoria",$objCategoria->getIdCategoria());
            return $sql->execute();
        }*/
    }
?>