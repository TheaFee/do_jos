<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bowling;

/**
 *
 * @author thea
 */
interface GameInterface {

    public function addRoll(int $pints);

    public function getFrames();

    public function getTotalScore();

    public function isGameOver();
}
