<?php

namespace App\Test;

use PHPUnit\Framework\TestCase;

class PremierTest extends TestCase{
    

    public function test_1_egale_1(){
        //A Arrange : préparation de tout ce qui est nécessaire pour le test
        $a=1;
        $b=0;
    
        //A Acte : executer SUT = System Under Test
        $sut=$a+$b;

        //A Assert : je m'attend à ce que dans la variable SUT il y est le chiffre 1
        $this->assertEquals($sut, 1);
    }
}