<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bowling;

/**
 * Description of Frames
 *
 * @author thea
 */
class Frame {

    private $pinsRolled;
    private $score;

    public function __construct() {
        $this->pinsRolled = array();
        $this->score = 0;
    }

    public function getScore(): int {
        return $this->score;
    }

    public function setScore(int $score): void {
        $this->score = $score;
    }

    public function getPinsRolled(): array {
        return $this->pinsRolled;
    }

    public function setPinsRolled(array $pinsRolled): void {
        $this->pinsRolled = $pinsRolled;
    }
    
    

}
