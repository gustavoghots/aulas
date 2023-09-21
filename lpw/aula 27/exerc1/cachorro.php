<?php
    include_once 'animal.php';
    include_once 'pelo.php';
    class Cachorro extends Animal implements Pelo {

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