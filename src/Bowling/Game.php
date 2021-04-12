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

        $numFrames = count($this->allFrames);
        if ($numFrames === 10) {
            $this->updateFrame($pins);
            $this->updateScoresStrikeAndSpare($pins);
        }
        if ($numFrames < 10) {
            $this->playGame($pins);
        }
        return $this->allFrames;
    }

    public function getFrames() {

        return $this->allFrames;
    }

    public function getTotalScore() {
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
            return $this->isLastFrameComplete();
        } else {
            return false;
        }
    }

    private function playGame($pins) {
        $frame = $this->getFrameInversed(0);
        $pinsRolled = $this->getPinsRolledFromFrame($frame);
        $numRolls = count($pinsRolled);
        $numFrames = count($this->allFrames);

        if ($numRolls === 2 || $pinsRolled === [10]) {
            $this->createNewFrame($pins);
            $this->updateScoresStrikeAndSpare($pins);
        } else {
            $this->updateFrame($pins);
            if ($numFrames >= 2) {
                $this->updateScoresStrikeAndSpare($pins);
            }
        }
    }

    private function getFrameInversed(int $i) {
        return $this->allFrames[count($this->allFrames) - $i - 1];
    }

    private function getPinsRolledFromFrame(Frame $frame) {
        return $frame->getPinsRolled();
    }

    private function createNewFrame($pins) {
        $newFrame = new Frame();
        $newFrame->setPinsRolled([$pins]);
        $newFrame->setScore($pins);
        array_push($this->allFrames, $newFrame);

        return $this->allFrames;
    }

    private function updateFrame($pins) {
        $frame = $this->getFrameInversed(0);

        $pinsRolledLastFrame = $this->getPinsRolledFromFrame($frame);
        array_push($pinsRolledLastFrame, $pins);
        $frame->setPinsRolled($pinsRolledLastFrame);
        $this->updateScore($frame, $pins);

        return $this->allFrames;
    }

    private function updateScore($frame, $pins) {
        $oldScore = $frame->getScore();
        $newScore = $oldScore + $pins;
        $frame->setScore($newScore);
    }

    private function updateScoresStrikeAndSpare($pins) {
        $pinsRolledLastFrame = $this->getPinsRolledFromFrame($this->getFrameInversed(1));

        if ($pinsRolledLastFrame[0] === 10) {

            $this->updateScoreStrike($pins);
        }
        if (array_sum($pinsRolledLastFrame) === 10 &&
                count($pinsRolledLastFrame) === 2) {
            $this->updateScoreSpare($pins);
        }
    }

    private function updateScoreStrike($pins) {
        $pinsRolledCurrentFrame = $this->getPinsRolledFromFrame($this->getFrameInversed(0));
        $lastFrame = $this->getFrameInversed(1);
        $numFrames = count($this->allFrames);

        if (count($pinsRolledCurrentFrame) < 3) {
            $this->updateScore($lastFrame, $pins);
        }
        if ($numFrames >= 3) {
            $this->updateScoreDoubleStrike($pins);
        }
    }

    private function updateScoreDoubleStrike($pins) {
        $pinsRolledCurrentFrame = $this->getPinsRolledFromFrame($this->getFrameInversed(0));
        $pinsRolledSecondLastFrame = $this->getPinsRolledFromFrame($this->getFrameInversed(2));
        $secondLastFrame = $this->getFrameInversed(2);
        if ($pinsRolledSecondLastFrame[0] === 10 &&
                count($pinsRolledCurrentFrame) === 1) {
            $this->updateScore($secondLastFrame, $pins);
        }
    }

    private function updateScoreSpare($pins) {
        $lastFrame = $this->getFrameInversed(1);
        $pinsRolledCurrentFrame = $this->getPinsRolledFromFrame($this->getFrameInversed(0));

        if (count($pinsRolledCurrentFrame) === 1) {
            $this->updateScore($lastFrame, $pins);
        }
    }

    private function isLastFrameComplete() {
        $frame = $this->getFrameInversed(0);
        $pinsRolled = $this->getPinsRolledFromFrame($frame);

        if (count($pinsRolled) < 2) {
            return false;
        } elseif (count($pinsRolled) === 2 &&
                ($pinsRolled[0] === 10 || array_sum($pinsRolled) === 10)) {
            return false;
        }
        return true;
    }

}
