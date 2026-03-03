<?php

class Zander extends Fish {
    public function school():void{
        echo "Je nage en bancs !!!";
    }
    
    // override d'une méthode
    public function swim():void{
        // echo "Psssssssssssscchhhhh";
        echo "Je nage lentement ...!!";
    }
    
}