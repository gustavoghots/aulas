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
}
?>
