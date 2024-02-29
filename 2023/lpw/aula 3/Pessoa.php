<?php
class Pessoa {
  public $nome;
  public $idade;
  public $endereco;

  function __construct($nome, $idade, $endereco) {
    $this->nome = $nome;
    $this->idade = $idade;
    $this->endereco = $endereco;
  }
  public function getNome() {
    return $this->nome;
  }

  public function setNome($nome) {
    $this->nome = $nome;
  }

  public function getIdade() {
    return $this->idade;
  }

  public function setIdade($idade) {
    $this->idade = $idade;
  }

  public function getEndereco() {
    return $this->endereco;
  }

  public function setEndereco($endereco) {
    $this->endereco = $endereco;
  }
}
?>
