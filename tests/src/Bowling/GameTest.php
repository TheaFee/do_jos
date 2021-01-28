<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

//use \Mockery;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GameTest
 *
 * @author thea
 */
final class GameTest extends TestCase {

    protected function setUp(): void {
        parent::setUp();

        $this->bowlingGame = new \Bowling\Game();
    }

    public function testAddRoll_1Roll() {

        $pins = 4;

        $this->bowlingGame->addRoll($pins);

        $allFrames = $this->bowlingGame->getFrames();
        $pinsRolled = $allFrames[0]->getPinsRolled();
        $this->assertEquals($pins, $pinsRolled[0]);
    }

    public function testAddRoll_2Rolls() {

        $pins1 = 4;
        $pins2 = 5;

        $this->bowlingGame->addRoll($pins1);
        $this->bowlingGame->addRoll($pins2);

        $allFrames = $this->bowlingGame->getFrames();
        $pinsRolled = $allFrames[0]->getPinsRolled();
        $this->assertEquals($pins1, $pinsRolled[0]);
        $this->assertEquals($pins2, $pinsRolled[1]);
    }

    public function testGetFrames_1Roll() {
        $this->bowlingGame->addRoll(4);

        $frame = new \Bowling\Frame();
        $frame->setPinsRolled([4]);
        $frame->setScore(4);

        $this->assertEquals([$frame], $this->bowlingGame->getFrames());
    }

    public function testGetFrames_1Frame() {
        $this->bowlingGame->addRoll(4);
        $this->bowlingGame->addRoll(5);

        $frame = new \Bowling\Frame();
        $frame->setPinsRolled([4, 5]);
        $frame->setScore(9);

        $this->assertEquals([$frame], $this->bowlingGame->getFrames());
    }

    public function testGetFrames2Rounds() {
        $this->bowlingGame->addRoll(4);
        $this->bowlingGame->addRoll(5);
        $this->bowlingGame->addRoll(2);
        $this->bowlingGame->addRoll(3);

        $frame1 = new \Bowling\Frame();
        $frame1->setPinsRolled([4, 5]);
        $frame1->setScore(9);

        $frame2 = new \Bowling\Frame();
        $frame2->setPinsRolled([2, 3]);
        $frame2->setScore(5);

        $this->assertEquals([$frame1, $frame2], $this->bowlingGame->getFrames());
    }

    public function testGetFrames3Rounds() {
        $this->bowlingGame->addRoll(4);
        $this->bowlingGame->addRoll(5);
        $this->bowlingGame->addRoll(2);
        $this->bowlingGame->addRoll(3);
        $this->bowlingGame->addRoll(1);
        $this->bowlingGame->addRoll(7);

        $frame1 = new \Bowling\Frame();
        $frame1->setPinsRolled([4, 5]);
        $frame1->setScore(9);

        $frame2 = new \Bowling\Frame();
        $frame2->setPinsRolled([2, 3]);
        $frame2->setScore(5);

        $frame3 = new \Bowling\Frame();
        $frame3->setPinsRolled([1, 7]);
        $frame3->setScore(8);

        $this->assertEquals([$frame1, $frame2, $frame3], $this->bowlingGame->getFrames());
    }

    public function testCalculateTotalScore() {
        $this->bowlingGame->addRoll(4);
        $this->bowlingGame->addRoll(5);
        $this->bowlingGame->addRoll(2);
        $this->bowlingGame->addRoll(3);
        $this->bowlingGame->addRoll(1);
        $this->bowlingGame->addRoll(7);

        $totalScore = 22;

        $this->assertEquals($totalScore, $this->bowlingGame->calculateTotalScore());
    }

    public function testGetTotalScore_AfterEveryFrame() {
        $this->bowlingGame->addRoll(4);
        $this->bowlingGame->addRoll(5);
        $this->assertEquals(9, $this->bowlingGame->calculateTotalScore());
        $this->bowlingGame->addRoll(2);
        $this->bowlingGame->addRoll(3);
        $this->assertEquals(14, $this->bowlingGame->calculateTotalScore());
        $this->bowlingGame->addRoll(1);
        $this->bowlingGame->addRoll(7);

        $this->assertEquals(22, $this->bowlingGame->calculateTotalScore());
    }

    public function testGetTotalScore_AfterEveryRoll() {
        // when
        $this->bowlingGame->addRoll(4);
        $this->assertEquals(4, $this->bowlingGame->calculateTotalScore());
        $this->bowlingGame->addRoll(5);
        $this->assertEquals(9, $this->bowlingGame->calculateTotalScore());
        $this->bowlingGame->addRoll(2);
        $this->assertEquals(11, $this->bowlingGame->calculateTotalScore());
        $this->bowlingGame->addRoll(3);
        $this->assertEquals(14, $this->bowlingGame->calculateTotalScore());
        $this->bowlingGame->addRoll(1);
        $this->assertEquals(15, $this->bowlingGame->calculateTotalScore());
        $this->bowlingGame->addRoll(7);

        // then
        $this->assertEquals(22, $this->bowlingGame->calculateTotalScore());
    }

    public function testIsGameOver_True() {
        //given
        $frame = new \Bowling\Frame();
        $frame->setPinsRolled([4, 5]);
        $frame->setScore(9);
        $allFrames = [$frame, $frame, $frame, $frame, $frame, $frame, $frame, $frame, $frame, $frame];

        $mock = new \Bowling\Game();
        $allFramesMock = $this->getPrivateProperty($mock, 'allFrames');
        $allFramesMock->setValue($mock, $allFrames);

        //when then
        $this->assertTrue($mock->isGameOver());
    }

    public function testIsGameOver_False() {
        //given
        $frame = new \Bowling\Frame();
        $frame->setPinsRolled([4, 5]);
        $frame->setScore(9);
        $allFrames = [$frame, $frame, $frame, $frame, $frame, $frame];

        $mock = new \Bowling\Game();
        $allFramesMock = $this->getPrivateProperty($mock, 'allFrames');
        $allFramesMock->setValue($mock, $allFrames);

        //when then
        $this->assertFalse($mock->isGameOver());
    }

    public function testCreateNewFrame() {
        //given
        $pins = 4;
        
        $previousFrame = new \Bowling\Frame();
        $previousFrame->setPinsRolled([4, 5]);
        $previousFrame->setScore(9);

        $allFrames = [$previousFrame];
        $mock = new \Bowling\Game();
        $allFramesMock = $this->getPrivateProperty($mock, 'allFrames');
        $allFramesMock->setValue($mock, $allFrames);

        $currentFrame = new \Bowling\Frame();
        $currentFrame->setPinsRolled([4]);
        $currentFrame->setScore(4);

        //when
        $createNewFrameMock = $this->getPrivateMethod($mock, 'createNewFrame');
        $result = $createNewFrameMock->invokeArgs($mock, [$pins]);

        //then
        $expected = [$previousFrame, $currentFrame];
        $this->assertEquals($expected, $result);
    }

    public function testUpdatePreviousFrame_2Roll() {
        //given
        $pins = 5;
        
        $previousFrame = new \Bowling\Frame();
        $previousFrame->setPinsRolled([4]);
        $previousFrame->setScore(4);

        $allFrames = [$previousFrame];
        $mock = new \Bowling\Game();
        $allFramesMock = $this->getPrivateProperty($mock, 'allFrames');
        $allFramesMock->setValue($mock, $allFrames);

        //when
        $updatePreviousFrame = $this->getPrivateMethod($mock, 'updatePreviousFrame');
        $result = $updatePreviousFrame->invokeArgs($mock, [$pins]);

        //then
        $updatedFrame = new \Bowling\Frame();
        $updatedFrame->setPinsRolled([4, 5]);
        $updatedFrame->setScore(9);

        $expected = [$updatedFrame];
        $this->assertEquals($expected, $result);
    }

    public function testUpdatePreviousFrame_1Roll() {
        //given
        $pins = 5;
        
        $previousFrame = new \Bowling\Frame();
        $allFrames = [$previousFrame];
        $mock = new \Bowling\Game();
        $allFramesMock = $this->getPrivateProperty($mock, 'allFrames');
        $allFramesMock->setValue($mock, $allFrames);

        //when
        $updatePreviousFrame = $this->getPrivateMethod($mock, 'updatePreviousFrame');
        $result = $updatePreviousFrame->invokeArgs($mock, [$pins]);

        //then
        $updatedFrame = new \Bowling\Frame();
        $updatedFrame->setPinsRolled([5]);
        $updatedFrame->setScore(5);

        $expected = [$updatedFrame];
        $this->assertEquals($expected, $result);
    }
    
    private function getPrivateMethod($className, $methodName) {
        $reflector = new ReflectionClass($className);
        $method = $reflector->getMethod($methodName);
        $method->setAccessible(true);

        return $method;
    }

    private function getPrivateProperty($className, $propertyName) {
        $reflector = new ReflectionClass($className);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }


}
