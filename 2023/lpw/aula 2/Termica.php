<?php
class Termica {
  private $cor;
  private $marca;
  private $modelo;
  private $agua;

  public function __construct($cor, $marca, $modelo, $agua) {
    $this->cor = $cor;
    $this->marca = $marca;
    $this->modelo = $modelo;
    $this->agua = $agua;
  }

  public function getCor() {
    return $this->cor;
  }

  public function setCor($cor) {
    $this->cor = $cor;
  }

  public function getMarca() {
    return $this->marca;
  }

  public function setMarca($marca) {
    $this->marca = $marca;
  }

  public function getModelo() {
    return $this->modelo;
  }

  public function setModelo($modelo) {
    $this->modelo = $modelo;
  }

  public function getAgua() {
    return $this->agua;
  }

  public function setAgua($agua) {
    $this->agua = $agua;
  }
}
?>