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
            $this->estado = TRUE;
        }

        function desligar(){
            $this->estado = False;
        }
        
        function getEstado(){
            return $this->estado;
        }
    }
?>