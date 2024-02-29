<?php
    include_once 'animal.php';
    class Gato extends Animal {

        private $tamUnha;

        public function GetTamUnha(){
            return $this->tamUnha;
        }

        public function SetTamUnha($tamUnha){
            $this->tamUnha=$tamUnha;
        }

        public function GetVocal(){
            return 'O gato faz '.parent::GetVocal();
        }
    }
?>