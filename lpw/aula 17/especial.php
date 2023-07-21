<?php
    include_once 'conta.php';
    class Especial extends Conta {
        function remuneracao(){
            $this->saldo+=$this->saldo*1.5;
        }
    }
?>