<?php
    header("Content-Type: application/json");

    class Robot {

        private $arrayLetter;
        private $arrayNumber;
        public $nameRobot;

        function __construct(){
            $this->arrayLetter = range("A", "Z");
            $this->arrayNumber = range("0", "9");
        }

        public function getName(){
            if(is_string($this->nameRobot)){
                return "hola, soy $this->nameRobot, ya estoy encendidio y listo para lo que desees";
            }else{
                $LetterAleatory = array_rand($this->arrayLetter, 2);
                $NumberAleatory = array_rand($this->arrayNumber, 3);
    
                /* $this->nameRobot = array_merge($LetterAleatory, $NumberAleatory); */
    
                $letterName = $this->arrayLetter[$LetterAleatory[0]]. $this->arrayLetter[$LetterAleatory[1]];
                $numberName = $this->arrayNumber[$NumberAleatory[0]]. $this->arrayNumber[$NumberAleatory[1]]. $this->arrayNumber[$NumberAleatory[2]];
                 $this->nameRobot = $letterName. $numberName;
    
                return "Encendiendo, encantado de conocerte, mi nombre es: $this->nameRobot";          
            }
        }

        public function reset(){
            if(is_string($this->nameRobot)){
                $LetterAleatory = array_rand($this->arrayLetter, 2);
                $NumberAleatory = array_rand($this->arrayNumber, 3);
    
                /* $this->nameRobot = array_merge($LetterAleatory, $NumberAleatory); */
    
                $letterName = $this->arrayLetter[$LetterAleatory[0]]. $this->arrayLetter[$LetterAleatory[1]];
                $numberName = $this->arrayNumber[$NumberAleatory[0]]. $this->arrayNumber[$NumberAleatory[1]]. $this->arrayNumber[$NumberAleatory[2]];
                 $this->nameRobot = $letterName. $numberName;
    
                return "Reseteando, mi nuevo nombre es: $this->nameRobot";
            }else{
                return "ERROR! antes de resetear debes encender el robot"."";
            }
           
        }
    }
    $obj = new Robot();
    echo $obj->reset();
?>