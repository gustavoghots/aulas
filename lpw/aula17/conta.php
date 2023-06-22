<?php
    abstract class Conta {
        protected $saldo;

        function __construct(){
            $this->saldo=100;
        }
        
        function getSaldo(){
            return $this->saldo;
        }

        function deposito($deposito){
            $this->saldo+=$deposito;
        }

        function retirada($retirada){
            $this->saldo-=$retirada;
        }

        function remuneracao(){
            $this->$saldo=$saldo;
        }
    }
?>