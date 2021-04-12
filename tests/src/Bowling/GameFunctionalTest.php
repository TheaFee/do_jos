<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GameFunctionalTest
 *
 * @author thea
 */
class GameFunctionalTest extends TestCase {

        private \Bowling\GameInterface $bowlingGame;
    
    protected function setUp(): void {
        parent::setUp();

       $this->bowlingGame = new \Bowling\Game();
    }
    
    public function testGame(){
        
        $rolls = [1,4,4,5,6,4,5,5,10,0,1,7,3,6,4,10,2,8,6];
        
        $totalScores = [1,5,9,14,20,24,34,39,59,59,61,68,71,83,87,107,111,127,133];
        
        $numRolls = count($rolls);
        
        for($i = 0; $i<$numRolls; $i++){
            
            $pins = $rolls[$i];
            
            $totalScore = $totalScores[$i];
            
            $this->bowlingGame->addRoll($pins);

            $this->assertEquals($totalScore, $this->bowlingGame->getTotalScore());
            $this->assertEquals(($i === 18), $this->bowlingGame->isGameOver());         
        }
        
        print_r($this->bowlingGame->getFrames());
        
    }
    
     public function testGame_OnlyStrikes(){
        
        $rolls = [10,10,10,10,10,10,10,10,10,10,10,10];
        
        $totalScores = [10, 30,60,90,120,150,180,210,240,270,290,300];
        
        $numRolls = count($rolls);
        
        for($i = 0; $i<$numRolls; $i++){
            
            $pins = $rolls[$i];
            
            $totalScore = $totalScores[$i];
            
            $this->bowlingGame->addRoll($pins);

            $this->assertEquals($totalScore, $this->bowlingGame->getTotalScore());
            $this->assertEquals(($i === 11), $this->bowlingGame->isGameOver());         
        }
        
        print_r($this->bowlingGame->getFrames());
        
    }
    
         public function testGame_OnlySpares(){
        
        $rolls = [5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5];
        
        $totalScores = [5, 10, 20, 25, 35, 40, 50, 55, 65, 70, 80, 
                        85, 95, 100,110, 115, 125, 130, 140, 145, 150];
        
        $numRolls = count($rolls);
        
        for($i = 0; $i<$numRolls; $i++){
            
            $pins = $rolls[$i];
            
            $totalScore = $totalScores[$i];
            
            $this->bowlingGame->addRoll($pins);

            $this->assertEquals($totalScore, $this->bowlingGame->getTotalScore());
            $this->assertEquals(($i === 20), $this->bowlingGame->isGameOver());         
        }
        
        print_r($this->bowlingGame->getFrames());
        
    }
    
             public function testGame_WithoutStrikeOrSpare(){
        
        $rolls = [5, 0, 5, 0, 5, 0, 5, 0, 5, 0, 5, 0, 5, 0, 5, 0, 5, 0, 5, 0];
        
        $totalScores = [5, 5, 10, 10, 15, 15, 20, 20, 25, 25, 
                        30, 30, 35, 35, 40, 40, 45, 45, 50, 50];
        
        $numRolls = count($rolls);
        
        for($i = 0; $i<$numRolls; $i++){
            $pins = $rolls[$i];
            
            $totalScore = $totalScores[$i];
            
            $this->bowlingGame->addRoll($pins);

            $this->assertEquals($totalScore, $this->bowlingGame->getTotalScore());
            $this->assertEquals(($i === 19), $this->bowlingGame->isGameOver());         
        }
        
        print_r($this->bowlingGame->getFrames());
        
    }

}
