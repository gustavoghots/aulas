<?php
class Hotwheels {
  public $modelo;
  public $cor;
  public $ano;

  function __construct($modelo, $cor, $ano) {
    $this->modelo = $modelo;
    $this->cor = $cor;
    $this->ano = $ano;
  }
}

?>