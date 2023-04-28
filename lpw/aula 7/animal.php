<?php
abstract class Animal {
  private $nome;
  private $vocal;

  function __construct($nome, $vocal) {
    $this->nome = $nome;
    $this->vocal = $vocal;
  }

  public function GetNome() {
    return $this->nome;
  }

  public function SetNome($nome) {
    $this->nome = $nome;
  }

  public function GetVocal() {
    return $this->vocal;
  }

  public function SetVocal($vocal) {
    $this->vocal = $vocal;
  }
}
?>
