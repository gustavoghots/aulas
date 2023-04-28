<?php
    include_once 'animal.php';
    class Cachorro extends Animal {

        private $corDoPelo;

        public function GetCorDoPelo(){
            return $this->corDoPelo;
        }

        public function SetCorDoPelo($corDoPelo){
            $this->corDoPelo=$corDoPelo;
        }

        public function GetVocal(){
            return 'O cachorro faz '.parent::GetVocal();
        }
    }
?>