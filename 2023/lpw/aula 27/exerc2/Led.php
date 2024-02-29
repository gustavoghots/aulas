<?php
    include_once 'Lampada.php';
    class Led implements Lampada {
        private $cor;
        private $estado;

        function getCor(){
            return $this->$cor;
        }
        function setCor(){
            $this->cor= 'Cor - Azul';
        }

        function ligar(){
            $this->estado = 'Lampada Ligada';
        }

        function desligar(){
            $this->estado = 'Lampada Desligada';
        }
    }
?>