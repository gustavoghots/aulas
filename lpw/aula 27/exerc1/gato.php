<?php
    include_once 'animal.php';
    include_once 'pelo.php';
    class Gato extends Animal implements Pelo {

        private $tamUnha;
        private $corDoPelo;

        public function GetTamUnha(){
            return $this->tamUnha;
        }

        public function SetTamUnha($tamUnha){
            $this->tamUnha=$tamUnha;
        }

        public function GetVocal(){
            return 'O gato faz '.parent::GetVocal();
        }

        public function GetCorDoPelo(){
            return $this->corDoPelo;
        }

        public function SetCorDoPelo($corDoPelo){
            $this->corDoPelo=$corDoPelo;
        }
    }
?>