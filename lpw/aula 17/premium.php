<?php
    include_once 'conta.php';
    class Premium extends Conta {
        function remuneracao(){
            $this->saldo+=$this->saldo*4.5;
        }
    }
?>