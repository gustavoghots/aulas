<?php
    @include_once '../produto.class.php';
    class Produto_DAO{
        private $conexao;
        public function __construct(){
            $this->conexao = new PDO("mysql:host=localhost;dbname=padel","root","");
        }
        public function inserir(Produto $produto){
            $sql= $this->conexao->prepare("
            insert into produto(nome,preco,descricao,imagem,oferta,qtd_estoque,Categoria_idCategoria)
            value(:nome,:preco,:descricao,:imagem,:oferta,:qtd_estoque,:Categoria_idCategoria)");
            $sql->bindValue(":nome",$produto->getNome());
            $sql->bindValue(":preco",$produto->getPreco());
            $sql->bindValue(":descricao",$produto->getDescricao());
            $sql->bindValue(":imagem",$produto->getImagem());
            $sql->bindValue(":oferta",$produto->getOferta());
            $sql->bindValue(":qtd_estoque",$produto->getQtdEstoque());
            $sql->bindValue(":Categoria_idCategoria",$produto->getCategoriaIdCategoria());
            return $sql->execute();
        }
        public function listar($complemento = '1=1') {
            $sql = $this->conexao->prepare("SELECT p.*, c.descricao AS categoria
                                            FROM Produto p
                                            INNER JOIN categoria c ON p.Categoria_idCategoria = c.idCategoria
                                            WHERE $complemento");
            $sql->execute();
            return $sql->fetchAll();
        }
        
        public function excluir($id){
            $sql= $this->conexao->prepare("delete from produto where idProduto=:id");
            $sql->bindValue(":id",$id);
            return $sql->execute();
        }
        public function retornarProduto($idProduto){
            $sql= $this->conexao->prepare("select p.*, c.descricao as categoria 
            from Produto p inner join categoria c on p.Categoria_idCategoria = c.idCategoria
            where p.idProduto = :idProduto");
            $sql->bindValue(":idProduto",$idProduto);
            $sql->execute();
            return $sql->fetch();
        }
        public function editar(Produto $produto){
            $sql= $this->conexao->prepare("update produto 
            set nome = :nome, preco = :preco,descricao = :descricao,imagem = :imagem,
            qtd_estoque = :qtd_estoque,Categoria_idCategoria = :Categoria_idCategoria
            where idProduto = :idProduto");
            $sql->bindValue(":nome",$produto->getNome());
            $sql->bindValue(":preco",$produto->getPreco());
            $sql->bindValue(":descricao",$produto->getDescricao());
            $sql->bindValue(":imagem",$produto->getImagem());
            $sql->bindValue(":qtd_estoque",$produto->getQtdEstoque());
            $sql->bindValue(":Categoria_idCategoria",$produto->getCategoriaIdCategoria());
            $sql->bindValue(":idProduto",$produto->getIdProduto());
            return $sql->execute();
        }
        public function ofertar(Produto $produto){
            $sql= $this->conexao->prepare("update produto set oferta = :oferta
            where idProduto=:idProduto");
            $sql->bindValue(":oferta",$produto->getOferta());
            $sql->bindValue(":idProduto",$produto->getIdProduto());
            return $sql->execute();
        }
    }
?>