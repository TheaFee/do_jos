<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include('src/Roman/RomanToLatinNumbersConverter.php');
include('src/Happy/HappyNumberCalculator.php');
include('src/RotatingEncryption/RotatingEncryption.php');
include('src/Bowling/GameInterface.php');
include('src/Bowling/Game.php');
include('src/Bowling/Frame.php');
Bowling\Game::addRoll(4);
Bowling\Game::addRoll(3);