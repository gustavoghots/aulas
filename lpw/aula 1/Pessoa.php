<?php

class Pessoa {
    private $id;
    private $nome;
    private $endereco;
    private $idade;
    
    public function __construct($id, $nome, $endereco, $idade) {
        $this->id = $id;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->idade = $idade;
    }
    
    // Métodos Getter
    public function getId() {
        return $this->id;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function getEndereco() {
        return $this->endereco;
    }
    
    public function getIdade() {
        return $this->idade;
    }
    
    // Métodos Setter
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }
    
    public function setIdade($idade) {
        $this->idade = $idade;
    }
}

?>