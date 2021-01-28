<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bowling;

use Bowling\Frame;

/**
 * Description of Game
 *
 * @author thea
 */
class Game implements GameInterface {

    private array $allFrames;

    public function __construct() {
        $this->allFrames = array();
        array_push($this->allFrames, new Frame());
    }

    public function addRoll(int $pins) {
        $previousFrame = $this->getPreviousFrameFromAllFrames();
        $pinsRolledPreviousFrame = $this->getPinsRolledFromFrame($previousFrame);
        $numRolls = count($pinsRolledPreviousFrame);
        if ($numRolls === 2) {
            return $this->createNewFrame($pins);
        } else {
            return $this->updatePreviousFrame($pins);
        }
    }

    public function getFrames() {
        return $this->allFrames;
    }

    public function calculateTotalScore() {
        $totalScore = 0;

        $numFrames = count($this->allFrames);
        for ($i = 0; $i < $numFrames; $i++) {
            $score = $this->allFrames[$i]->getScore();
            $totalScore += $score;
        }

        return $totalScore;
    }

    public function isGameOver() {
        $numFrames = count($this->allFrames);
        if ($numFrames === 10) {
            return true;
        } else {
            return false;
        }
    }
    
    

    private function getPreviousFrameFromAllFrames() {
        return $this->allFrames[array_key_last($this->allFrames)];
    }

    private function getPinsRolledFromFrame(Frame $frame) {
        return $frame->getPinsRolled();
    }

    private function createNewFrame($pins) {
        $currentFrame = new Frame();
        $currentFrame->setPinsRolled([$pins]);
        $currentFrame->setScore($pins);
        array_push($this->allFrames, $currentFrame);

        return $this->allFrames;
    }

    private function updatePreviousFrame($pins) {
        $previousFrame = $this->getPreviousFrameFromAllFrames();

        $pinsRolledPreviousFrame = $this->getPinsRolledFromFrame($previousFrame);
        array_push($pinsRolledPreviousFrame, $pins);
        $previousFrame->setPinsRolled($pinsRolledPreviousFrame);

        $oldScore = $previousFrame->getScore();
        $newScore = $oldScore + $pins;
        $previousFrame->setScore($newScore);

        return $this->allFrames;
    }

}
