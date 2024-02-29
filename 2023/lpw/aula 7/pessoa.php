<?php
abstract class Pessoa {
  private $nome;
  private $idade;

  function __construct($nome, $idade) {
    $this->nome = $nome;
    $this->idade = $idade;
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
}
?>
