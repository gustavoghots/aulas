<?php
    include_once 'Lampada.php';
    class Alncandescente implements Lampada {
        private $cor;
        private $estado;

        function getCor(){
            return $this->$cor;
        }
        function setCor(){
            $this->cor= 'Cor - Branca';
        }

        function ligar(){
            $this->estado = True;
        }

        function desligar(){
            $this->estado = False;
        }

        function getEstado(){
            return $this->estado;
        }
    }
?>