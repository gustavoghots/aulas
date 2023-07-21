<?php
    include_once 'conta.php';
    class Normal extends Conta {
        function remuneracao(){
            $this->saldo+=$this->saldo*0.5;
        }
    }
?>