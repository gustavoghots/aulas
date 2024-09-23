<?php
    @include_once'../categoria.class.php';
    class Categoria_DAO{
        private $conexao;
        public function __construct(){
            $this->conexao = new PDO("mysql:host=localhost;dbname=padel","root","");
        }
        public function inserir(Categoria $categoria){
            $sql= $this->conexao->prepare("insert into categoria(descricao) value(:descricao)");
            $sql->bindValue(":descricao",$categoria->getDescricao());
            return $sql->execute();
        }
        public function listar(){
            $sql= $this->conexao->prepare("select * from categoria");
            $sql->execute();
            return $sql->fetchAll();
        }
        public function excluir($id){
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
        }
    }
?>