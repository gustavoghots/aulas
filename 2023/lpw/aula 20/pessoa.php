<?php
  class Pessoa {
    private $nome;
    private $idade;
    private $altura;

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

    public function getAltura() {
        return $this->altura;
      }
  
    public function setAltura($altura) {
        $this->altura = $altura;
    }
}
?>