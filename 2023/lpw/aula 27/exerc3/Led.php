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
            $this->estado = TRUE;
        }

        function desligar(){
            $this->estado = FALSE;
        }

        function getEstado(){
            return $this->estado;
        }
    }
?>