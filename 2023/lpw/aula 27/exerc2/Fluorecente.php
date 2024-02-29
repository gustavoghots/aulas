<?php
    include_once 'Lampada.php';
    class Fluorecente implements Lampada {
        private $cor;
        private $estado;

        function getCor(){
            return $this->$cor;
        }
        function setCor(){
            $this->cor= 'Cor - Amarela';
        }

        function ligar(){
            $this->estado = 'Lampada Ligada';
        }

        function desligar(){
            $this->estado = 'Lampada Desligada';
        }
    }
?>